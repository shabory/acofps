<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDiplomaRequest;
use App\Http\Requests\UpdateDiplomaRequest;
use App\Http\Resources\Admin\DiplomaResource;
use App\Models\Diploma;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DiplomaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('diploma_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DiplomaResource(Diploma::with(['trainer', 'country', 'city', 'speclization'])->get());
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

        return (new DiplomaResource($diploma))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Diploma $diploma)
    {
        abort_if(Gate::denies('diploma_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DiplomaResource($diploma->load(['trainer', 'country', 'city', 'speclization']));
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

        return (new DiplomaResource($diploma))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Diploma $diploma)
    {
        abort_if(Gate::denies('diploma_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $diploma->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
