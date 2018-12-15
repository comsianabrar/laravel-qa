<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AskQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'body' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter a question title',
            'title.max' => 'Question Title cannot be too big',
            'body.required' => 'Please explain your question'
        ];
    }
}
