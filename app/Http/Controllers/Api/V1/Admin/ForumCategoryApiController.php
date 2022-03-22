<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreForumCategoryRequest;
use App\Http\Requests\UpdateForumCategoryRequest;
use App\Http\Resources\Admin\ForumCategoryResource;
use App\Models\ForumCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForumCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('forum_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ForumCategoryResource(ForumCategory::all());
    }

    public function store(StoreForumCategoryRequest $request)
    {
        $forumCategory = ForumCategory::create($request->all());

        return (new ForumCategoryResource($forumCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ForumCategory $forumCategory)
    {
        abort_if(Gate::denies('forum_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ForumCategoryResource($forumCategory);
    }

    public function update(UpdateForumCategoryRequest $request, ForumCategory $forumCategory)
    {
        $forumCategory->update($request->all());

        return (new ForumCategoryResource($forumCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ForumCategory $forumCategory)
    {
        abort_if(Gate::denies('forum_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $forumCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
