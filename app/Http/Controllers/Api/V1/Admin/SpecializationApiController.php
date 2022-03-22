<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSpecializationRequest;
use App\Http\Requests\UpdateSpecializationRequest;
use App\Http\Resources\Admin\SpecializationResource;
use App\Models\Specialization;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecializationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('specialization_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SpecializationResource(Specialization::all());
    }

    public function store(StoreSpecializationRequest $request)
    {
        $specialization = Specialization::create($request->all());

        if ($request->input('image', false)) {
            $specialization->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new SpecializationResource($specialization))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Specialization $specialization)
    {
        abort_if(Gate::denies('specialization_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SpecializationResource($specialization);
    }

    public function update(UpdateSpecializationRequest $request, Specialization $specialization)
    {
        $specialization->update($request->all());

        if ($request->input('image', false)) {
            if (!$specialization->image || $request->input('image') !== $specialization->image->file_name) {
                if ($specialization->image) {
                    $specialization->image->delete();
                }
                $specialization->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($specialization->image) {
            $specialization->image->delete();
        }

        return (new SpecializationResource($specialization))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Specialization $specialization)
    {
        abort_if(Gate::denies('specialization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialization->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
