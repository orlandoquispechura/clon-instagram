<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruta_imagen', 'descripcion', 'user_id'
    ];

    // Relación uno a muchos 

    public function comments()
    {
        return $this->hasMany(Comment::class)->OrderBy('id', 'desc');
    }
    // Relación uno a muchos 

    public function likes(){
        return $this->hasMany(Like::class);
    }

     // Relación muchos  a uno

     public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
