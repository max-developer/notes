<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function index(Request $request)
    {
        $questions = Question::query()
            ->where('name', 'like', "%{$request->term}%")
            ->limit(5)
            ->orderBy('name')
            ->get();
        return QuestionResource::collection($questions);
    }
}
