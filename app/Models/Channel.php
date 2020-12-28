<?php

namespace App\Models;

use App\Models\Discussion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;
    protected $fillable=['name','slug'];

    public function discussions(){
        return $this->hasMany(Discussion::class);
    }
    
}
