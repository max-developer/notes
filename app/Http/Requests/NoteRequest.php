<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Link;
use App\Models\Question;
use App\Support\Data\Normalizer;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => 'required|numeric',
            'content' => 'required',
            'questions' => 'nullable|array',
            'questions.*' => 'numeric',
            'links' => 'nullable|array',
            'links.*' => 'numeric',
        ];
    }

    public function validated(): array
    {
        return Normalizer::make(parent::validated())
            ->belongTo(Category::query(), 'category_id')
            ->belongToMany(Question::query(), 'questions')
            ->belongToMany(Link::query(), 'links')
            ->all();
    }

}
