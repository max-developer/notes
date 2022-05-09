<?php

namespace App\Services;

use App\Models\Question;

class QuestionService
{
    /** @return Question[] */
    public function search(array $filter = [])
    {
        $query = Question::query()->orderByDesc('created_at');
        return $query->paginate();
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
