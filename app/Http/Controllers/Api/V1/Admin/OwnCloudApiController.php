<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOwnCloudRequest;
use App\Http\Requests\UpdateOwnCloudRequest;
use App\Http\Resources\Admin\OwnCloudResource;
use App\Models\OwnCloud;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnCloudApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('own_cloud_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OwnCloudResource(OwnCloud::with(['product'])->get());
    }

    public function store(StoreOwnCloudRequest $request)
    {
        $ownCloud = OwnCloud::create($request->all());

        return (new OwnCloudResource($ownCloud))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OwnCloud $ownCloud)
    {
        abort_if(Gate::denies('own_cloud_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OwnCloudResource($ownCloud->load(['product']));
    }

    public function update(UpdateOwnCloudRequest $request, OwnCloud $ownCloud)
    {
        $ownCloud->update($request->all());

        return (new OwnCloudResource($ownCloud))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OwnCloud $ownCloud)
    {
        abort_if(Gate::denies('own_cloud_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownCloud->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
