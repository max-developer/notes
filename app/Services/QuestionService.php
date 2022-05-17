<?php

namespace App\Services;

use App\Models\Question;
use App\Support\Data\Filter;
use Illuminate\Database\Eloquent\Builder;

class QuestionService
{
    /** @return Question[] */
    public function search(array $filter = []): iterable
    {
        $query = Question::query()
            ->withCount('notes');

        return Filter::make($query, $filter)
            ->in('id')
            ->search('search', 'name')
            ->custom('notes_count', fn(Builder $q, string $v) => $q->byNotesCount($v))
            ->order('created_at', 'asc')
            ->getQuery()
            ->paginate();
    }

    public function create(array $data): Question
    {
        $question = new Question($data);
        $question->save();

        return $question;
    }

    public function update(Question $question, array $data): Question
    {
        $question->fill($data);
        $question->save();

        return $question;
    }

    public function destroy(Question $question): bool
    {
        return $question->delete();
    }
}
