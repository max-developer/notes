<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'note_questions');
    }

}
