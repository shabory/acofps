<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyForumCommentRequest;
use App\Http\Requests\StoreForumCommentRequest;
use App\Http\Requests\UpdateForumCommentRequest;
use App\Models\ForumComment;
use App\Models\Thread;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ForumCommentsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('forum_comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $forumComments = ForumComment::with(['user', 'thread'])->get();

        return view('admin.forumComments.index', compact('forumComments'));
    }

    public function create()
    {
        abort_if(Gate::denies('forum_comment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $threads = Thread::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.forumComments.create', compact('threads', 'users'));
    }

    public function store(StoreForumCommentRequest $request)
    {
        $forumComment = ForumComment::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $forumComment->id]);
        }

        return redirect()->route('admin.forum-comments.index');
    }

    public function edit(ForumComment $forumComment)
    {
        abort_if(Gate::denies('forum_comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $threads = Thread::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $forumComment->load('user', 'thread');

        return view('admin.forumComments.edit', compact('forumComment', 'threads', 'users'));
    }

    public function update(UpdateForumCommentRequest $request, ForumComment $forumComment)
    {
        $forumComment->update($request->all());

        return redirect()->route('admin.forum-comments.index');
    }

    public function show(ForumComment $forumComment)
    {
        abort_if(Gate::denies('forum_comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $forumComment->load('user', 'thread');

        return view('admin.forumComments.show', compact('forumComment'));
    }

    public function destroy(ForumComment $forumComment)
    {
        abort_if(Gate::denies('forum_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $forumComment->delete();

        return back();
    }

    public function massDestroy(MassDestroyForumCommentRequest $request)
    {
        ForumComment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('forum_comment_create') && Gate::denies('forum_comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ForumComment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
