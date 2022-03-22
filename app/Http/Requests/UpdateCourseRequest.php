<?php

namespace App\Http\Requests;

use App\Models\Course;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'type' => [
                'required',
            ],
            'media' => [
                'array',
            ],
            'attachments' => [
                'array',
            ],
            'trainer_id' => [
                'required',
                'integer',
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'discount_price' => [
                'numeric',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'country_id' => [
                'required',
                'integer',
            ],
            'seo_title' => [
                'string',
                'nullable',
            ],
            'speclization_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
