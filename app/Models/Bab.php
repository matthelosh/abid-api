<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    use HasFactory;

    protected $fillable = [
        'tingkat',
        'label',
        'deskripsi',
        'user_id'
    ];

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
