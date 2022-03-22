<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyThreadRequest;
use App\Http\Requests\StoreThreadRequest;
use App\Http\Requests\UpdateThreadRequest;
use App\Models\ForumCategory;
use App\Models\Thread;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ThreadController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('thread_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $threads = Thread::with(['fourm_category', 'user'])->get();

        return view('admin.threads.index', compact('threads'));
    }

    public function create()
    {
        abort_if(Gate::denies('thread_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fourm_categories = ForumCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.threads.create', compact('fourm_categories', 'users'));
    }

    public function store(StoreThreadRequest $request)
    {
        $thread = Thread::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $thread->id]);
        }

        return redirect()->route('admin.threads.index');
    }

    public function edit(Thread $thread)
    {
        abort_if(Gate::denies('thread_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fourm_categories = ForumCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $thread->load('fourm_category', 'user');

        return view('admin.threads.edit', compact('fourm_categories', 'thread', 'users'));
    }

    public function update(UpdateThreadRequest $request, Thread $thread)
    {
        $thread->update($request->all());

        return redirect()->route('admin.threads.index');
    }

    public function show(Thread $thread)
    {
        abort_if(Gate::denies('thread_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $thread->load('fourm_category', 'user', 'threadForumComments');

        return view('admin.threads.show', compact('thread'));
    }

    public function destroy(Thread $thread)
    {
        abort_if(Gate::denies('thread_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $thread->delete();

        return back();
    }

    public function massDestroy(MassDestroyThreadRequest $request)
    {
        Thread::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('thread_create') && Gate::denies('thread_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Thread();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
