<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Reply;
use App\Models\Channel;
use App\Models\Watcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable=['title','content','user_id','channel_id','slug'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function channel(){
        return $this->belongsTo(Channel::class);
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    public function watchers(){
        return $this->hasMany(Watcher::class);
    }

    public static function is_user_admin(){
        if(auth()->user()->role=='admin'){
            return true;
        }
        return false;
    }

    public function scopeChannel_based($query){
        if(request()->query('channel')){
            $channel = Channel::where('slug',request()->query('channel'))->first();

            if($channel){
                $query->where('channel_id',$channel->id);
            }
        }
        return $query;
    }

    public function scopeMy_disussions($query){
        if(request()->query('mydiscussions')){
            $query->where('user_id',Auth::id());
        }
        return $query;
    }


   
    public function is_best_answer(){
        if($this->best_answer != 0){
            return false;
        }
        return true;
    }

    public function is_being_watched($did){
        if(in_array(Auth::id(),$this->watchers->pluck('user_id')->toarray())){
            return false;
        }
        return true;
    }
}
