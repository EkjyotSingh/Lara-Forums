<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;
    
    protected $fillable=['user_id','content','discussion_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function discussion(){
        return $this->belongsTo(Discussion::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function liked(){
        $likes=Auth::user()->likes;
        if($likes){
            $li=array();
            $di=array();
            foreach($likes->where('like','1') as $like){
                array_push($li,$like->reply_id);
            }
            foreach($likes->where('dislike','1') as $like){
                array_push($di,$like->reply_id);
    
            }
            if(in_array($this->id,$li)){
                return  'liked';
            }
            if(in_array($this->id,$di)){
               return  'disliked';
            }
        }
        return;

    }
}
