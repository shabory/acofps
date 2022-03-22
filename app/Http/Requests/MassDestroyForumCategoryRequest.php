<?php

namespace App\Http\Requests;

use App\Models\ForumCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyForumCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('forum_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:forum_categories,id',
        ];
    }
}
