<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'content'];

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'node_questions');
    }

}
