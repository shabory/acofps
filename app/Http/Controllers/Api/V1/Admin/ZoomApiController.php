<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreZoomRequest;
use App\Http\Requests\UpdateZoomRequest;
use App\Http\Resources\Admin\ZoomResource;
use App\Models\Zoom;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ZoomApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('zoom_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ZoomResource(Zoom::with(['lesson'])->get());
    }

    public function store(StoreZoomRequest $request)
    {
        $zoom = Zoom::create($request->all());

        return (new ZoomResource($zoom))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Zoom $zoom)
    {
        abort_if(Gate::denies('zoom_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ZoomResource($zoom->load(['lesson']));
    }

    public function update(UpdateZoomRequest $request, Zoom $zoom)
    {
        $zoom->update($request->all());

        return (new ZoomResource($zoom))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Zoom $zoom)
    {
        abort_if(Gate::denies('zoom_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zoom->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
