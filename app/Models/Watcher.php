<?php

namespace App\Models;

use App\Models\User;
use App\Models\Discussion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Watcher extends Model
{
    use HasFactory;

    protected $fillable=['discussion_id','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function discussion(){
        return $this->belongsTo(Discussion::class);
    }
}
