<?php

namespace App\Http\Requests;

use App\Models\Specialization;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSpecializationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('specialization_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
