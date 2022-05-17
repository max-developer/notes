<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'content'];

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'note_questions');
    }

    public static function scopeByNotesCount(Builder $query, string $value): Builder
    {
        $operators = ['n' => '=', 'y' => '>'];
        if (array_key_exists($value, $operators)) {
            return $query->having('notes_count', $operators[$value], 0);
        }
        return $query;
    }

}
