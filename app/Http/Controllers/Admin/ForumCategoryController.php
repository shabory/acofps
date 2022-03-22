<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyForumCategoryRequest;
use App\Http\Requests\StoreForumCategoryRequest;
use App\Http\Requests\UpdateForumCategoryRequest;
use App\Models\ForumCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForumCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('forum_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $forumCategories = ForumCategory::all();

        return view('admin.forumCategories.index', compact('forumCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('forum_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.forumCategories.create');
    }

    public function store(StoreForumCategoryRequest $request)
    {
        $forumCategory = ForumCategory::create($request->all());

        return redirect()->route('admin.forum-categories.index');
    }

    public function edit(ForumCategory $forumCategory)
    {
        abort_if(Gate::denies('forum_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.forumCategories.edit', compact('forumCategory'));
    }

    public function update(UpdateForumCategoryRequest $request, ForumCategory $forumCategory)
    {
        $forumCategory->update($request->all());

        return redirect()->route('admin.forum-categories.index');
    }

    public function show(ForumCategory $forumCategory)
    {
        abort_if(Gate::denies('forum_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $forumCategory->load('fourmCategoryThreads');

        return view('admin.forumCategories.show', compact('forumCategory'));
    }

    public function destroy(ForumCategory $forumCategory)
    {
        abort_if(Gate::denies('forum_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $forumCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyForumCategoryRequest $request)
    {
        ForumCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
