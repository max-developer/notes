<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $questions = Link::query()
            ->where('name', 'like', "%{$request->term}%")
            ->limit(5)
            ->orderBy('name')
            ->get();
        return QuestionResource::collection($questions);
    }
}
