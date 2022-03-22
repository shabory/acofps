<?php

namespace App\Http\Requests;

use App\Models\Auther;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAutherRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('auther_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:authers,id',
        ];
    }
}
