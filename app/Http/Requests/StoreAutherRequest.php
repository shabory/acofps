<?php

namespace App\Http\Requests;

use App\Models\Auther;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAutherRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('auther_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
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
