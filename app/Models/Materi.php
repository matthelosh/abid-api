<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'bab_id',
        'title',
        'slug',
        'content',
        'cover',
        'user_id'
    ];

    public function bab()
    {
        return $this->belongsTo(Bab::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
