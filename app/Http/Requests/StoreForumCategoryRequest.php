<?php

namespace App\Http\Requests;

use App\Models\ForumCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreForumCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('forum_category_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'seo_title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
