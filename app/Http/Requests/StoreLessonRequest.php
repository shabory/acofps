<?php

namespace App\Http\Requests;

use App\Models\Lesson;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLessonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'video_url' => [
                'string',
                'nullable',
            ],
            'media' => [
                'array',
            ],
            'attchments' => [
                'array',
                'required',
            ],
            'attchments.*' => [
                'required',
            ],
            'course_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
