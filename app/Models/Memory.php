<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'current_question',
        'score',
        'is_active',
        'order',
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
