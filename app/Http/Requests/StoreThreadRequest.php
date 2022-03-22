<?php

namespace App\Http\Requests;

use App\Models\Thread;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreThreadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('thread_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'fourm_category_id' => [
                'required',
                'integer',
            ],
            'content' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'seo_title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
