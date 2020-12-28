<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Reply;
use App\Models\Watcher;
use App\Models\Discussion;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'provider_id',
        'provider'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function discussions(){
        return $this->hasMany(Discussion::class);
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    public function watchers(){
        return $this->hasMany(Watcher::class);
    }
    //public function likes(){
    //    return $this->hasMany(Like::class);
    //}
    public function is_user_admin(){
        if(auth()->user()->role=='admin'){
            return true;
        }
        return false;
    }
}
