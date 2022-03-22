<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAutherRequest;
use App\Http\Requests\StoreAutherRequest;
use App\Http\Requests\UpdateAutherRequest;
use App\Models\Auther;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AutherController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('auther_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authers = Auther::with(['user', 'media'])->get();

        return view('admin.authers.index', compact('authers'));
    }

    public function create()
    {
        abort_if(Gate::denies('auther_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.authers.create', compact('users'));
    }

    public function store(StoreAutherRequest $request)
    {
        $auther = Auther::create($request->all());

        if ($request->input('image', false)) {
            $auther->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $auther->id]);
        }

        return redirect()->route('admin.authers.index');
    }

    public function edit(Auther $auther)
    {
        abort_if(Gate::denies('auther_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auther->load('user');

        return view('admin.authers.edit', compact('auther', 'users'));
    }

    public function update(UpdateAutherRequest $request, Auther $auther)
    {
        $auther->update($request->all());

        if ($request->input('image', false)) {
            if (!$auther->image || $request->input('image') !== $auther->image->file_name) {
                if ($auther->image) {
                    $auther->image->delete();
                }
                $auther->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($auther->image) {
            $auther->image->delete();
        }

        return redirect()->route('admin.authers.index');
    }

    public function show(Auther $auther)
    {
        abort_if(Gate::denies('auther_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auther->load('user', 'autherArticles');

        return view('admin.authers.show', compact('auther'));
    }

    public function destroy(Auther $auther)
    {
        abort_if(Gate::denies('auther_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auther->delete();

        return back();
    }

    public function massDestroy(MassDestroyAutherRequest $request)
    {
        Auther::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('auther_create') && Gate::denies('auther_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Auther();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
