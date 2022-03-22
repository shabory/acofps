<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreForumCommentRequest;
use App\Http\Requests\UpdateForumCommentRequest;
use App\Http\Resources\Admin\ForumCommentResource;
use App\Models\ForumComment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForumCommentsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('forum_comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ForumCommentResource(ForumComment::with(['user', 'thread'])->get());
    }

    public function store(StoreForumCommentRequest $request)
    {
        $forumComment = ForumComment::create($request->all());

        return (new ForumCommentResource($forumComment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ForumComment $forumComment)
    {
        abort_if(Gate::denies('forum_comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ForumCommentResource($forumComment->load(['user', 'thread']));
    }

    public function update(UpdateForumCommentRequest $request, ForumComment $forumComment)
    {
        $forumComment->update($request->all());

        return (new ForumCommentResource($forumComment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ForumComment $forumComment)
    {
        abort_if(Gate::denies('forum_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $forumComment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
