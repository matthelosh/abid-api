<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'pertanyaan',
        'a',
        'b',
        'c',
        'd',
        'kunci'
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
