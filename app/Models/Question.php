<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
    ];

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    public function memories()
    {
        return $this->belongsToMany(Memory::class);
    }
}
