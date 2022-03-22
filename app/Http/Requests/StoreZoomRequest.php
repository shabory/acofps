<?php

namespace App\Http\Requests;

use App\Models\Zoom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreZoomRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('zoom_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'lesson_id' => [
                'required',
                'integer',
            ],
            'zoomlink' => [
                'string',
                'required',
            ],
            'zoomtime' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
        ];
    }
}
