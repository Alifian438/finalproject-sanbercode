<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = 'forum';
    protected $fillable = ['judul', 'isi', 'gambar','kategori_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function komentar()
    {
        return $this->hasMany(komentar::class);
    }
}
