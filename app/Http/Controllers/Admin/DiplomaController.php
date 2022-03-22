<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDiplomaRequest;
use App\Http\Requests\StoreDiplomaRequest;
use App\Http\Requests\UpdateDiplomaRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Diploma;
use App\Models\Specialization;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DiplomaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('diploma_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diplomas = Diploma::with(['trainer', 'country', 'city', 'speclization', 'media'])->get();

        return view('admin.diplomas.index', compact('diplomas'));
    }

    public function create()
    {
        abort_if(Gate::denies('diploma_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $speclizations = Specialization::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.diplomas.create', compact('cities', 'countries', 'speclizations', 'trainers'));
    }

    public function store(StoreDiplomaRequest $request)
    {
        $diploma = Diploma::create($request->all());

        if ($request->input('logo', false)) {
            $diploma->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($request->input('featured_image', false)) {
            $diploma->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        foreach ($request->input('media', []) as $file) {
            $diploma->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('media');
        }

        foreach ($request->input('attachments', []) as $file) {
            $diploma->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachments');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $diploma->id]);
        }

        return redirect()->route('admin.diplomas.index');
    }

    public function edit(Diploma $diploma)
    {
        abort_if(Gate::denies('diploma_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $speclizations = Specialization::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $diploma->load('trainer', 'country', 'city', 'speclization');

        return view('admin.diplomas.edit', compact('cities', 'countries', 'diploma', 'speclizations', 'trainers'));
    }

    public function update(UpdateDiplomaRequest $request, Diploma $diploma)
    {
        $diploma->update($request->all());

        if ($request->input('logo', false)) {
            if (!$diploma->logo || $request->input('logo') !== $diploma->logo->file_name) {
                if ($diploma->logo) {
                    $diploma->logo->delete();
                }
                $diploma->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($diploma->logo) {
            $diploma->logo->delete();
        }

        if ($request->input('featured_image', false)) {
            if (!$diploma->featured_image || $request->input('featured_image') !== $diploma->featured_image->file_name) {
                if ($diploma->featured_image) {
                    $diploma->featured_image->delete();
                }
                $diploma->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($diploma->featured_image) {
            $diploma->featured_image->delete();
        }

        if (count($diploma->media) > 0) {
            foreach ($diploma->media as $media) {
                if (!in_array($media->file_name, $request->input('media', []))) {
                    $media->delete();
                }
            }
        }
        $media = $diploma->media->pluck('file_name')->toArray();
        foreach ($request->input('media', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $diploma->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('media');
            }
        }

        if (count($diploma->attachments) > 0) {
            foreach ($diploma->attachments as $media) {
                if (!in_array($media->file_name, $request->input('attachments', []))) {
                    $media->delete();
                }
            }
        }
        $media = $diploma->attachments->pluck('file_name')->toArray();
        foreach ($request->input('attachments', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $diploma->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachments');
            }
        }

        return redirect()->route('admin.diplomas.index');
    }

    public function show(Diploma $diploma)
    {
        abort_if(Gate::denies('diploma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diploma->load('trainer', 'country', 'city', 'speclization', 'diplomaOrders', 'diplomaCourses');

        return view('admin.diplomas.show', compact('diploma'));
    }

    public function destroy(Diploma $diploma)
    {
        abort_if(Gate::denies('diploma_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diploma->delete();

        return back();
    }

    public function massDestroy(MassDestroyDiplomaRequest $request)
    {
        Diploma::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('diploma_create') && Gate::denies('diploma_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Diploma();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
