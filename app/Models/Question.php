<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
    ];

    public function answer(): HasOne
    {
        return $this->hasOne(Answer::class);
    }

    public function memories(): BelongsToMany
    {
        return $this->belongsToMany(Memory::class);
    }
}
