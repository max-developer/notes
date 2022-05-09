<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'required',
            'content' => 'required',
            'questions' => 'nullable|array',
            'questions.*' => 'numeric',
        ];
    }
}
