<?php

namespace App\Models;

use App\Models\User;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;
    protected $fillable=['dislike','like','reply_id','user_id'];

    public function reply(){
        return $this->belongsTo(Reply::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
