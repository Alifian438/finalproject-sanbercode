<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';
    protected $fillable = ['umur', 'bio', 'alamat', 'foto', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function forum()
    {
        return $this->hasOne(Forum::class);
    }
}

