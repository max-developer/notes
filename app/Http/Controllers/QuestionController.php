<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public const ROUTE_INDEX = 'questions.index';

    private QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function index()
    {
        $questions = $this->questionService->search();
        return view('question.index', compact('questions'));
    }

    public function create()
    {
        $question = new Question();
        return view('question.create', compact('question'));
    }

    public function store(QuestionRequest $request)
    {
        $data = $request->validated();
        $this->questionService->create($data);

        return redirect()
            ->route(self::ROUTE_INDEX)
            ->with('success', 'Question created');
    }

    public function show(Question $question)
    {
        return view('question.show', compact('question'));
    }

    public function edit(Question $question)
    {
        return view('question.edit', compact('question'));
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $data = $request->validated();
        $this->questionService->update($question, $data);

        return redirect()
            ->route(self::ROUTE_INDEX)
            ->with('success', 'Question updated');
    }

    public function destroy(Request $request, Question $question)
    {
        $this->questionService->destroy($question);

        return redirect()
            ->route(self::ROUTE_INDEX)
            ->with('success', 'Question deleted');
    }
}
