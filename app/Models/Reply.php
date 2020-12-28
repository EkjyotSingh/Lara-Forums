<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Discussion;
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
}
