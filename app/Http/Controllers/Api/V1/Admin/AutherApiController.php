<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAutherRequest;
use App\Http\Requests\UpdateAutherRequest;
use App\Http\Resources\Admin\AutherResource;
use App\Models\Auther;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutherApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('auther_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AutherResource(Auther::with(['user'])->get());
    }

    public function store(StoreAutherRequest $request)
    {
        $auther = Auther::create($request->all());

        if ($request->input('image', false)) {
            $auther->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new AutherResource($auther))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Auther $auther)
    {
        abort_if(Gate::denies('auther_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AutherResource($auther->load(['user']));
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

        return (new AutherResource($auther))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Auther $auther)
    {
        abort_if(Gate::denies('auther_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auther->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
