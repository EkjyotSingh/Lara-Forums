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

    public function scopeChannel_based($query){
        if(request()->query('channel')){
            $channel = Channel::where('slug',request()->query('channel'))->first();

            if($channel){
                $query->where('channel_id',$channel->id);
            }
        }
        return $query;
    }


    //public function user_liked_disliked($id){
    //    $status=Like::where('user_id',Auth::id())->where('reply_id',$id)->first();
    //    if($status==null){
    //        return null;
    //    }else{
    //        if($status['like']==1){
    //            return 'liked';
    //        }else{
    //            return 'disliked';
    //        }
    //    }
    //}
    public function is_best_answer(){
        //dd($this->replies()->where('best',1)->first());
        if($this->best_answer != 0){
            return false;
        }
        return true;
    }

    public function is_being_watched($did){
        //dump($this->watchers->pluck('user_id'));
        if(in_array(Auth::id(),$this->watchers->pluck('user_id')->toarray())){
            return false;
        }
        return true;
    }
}
