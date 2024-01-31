<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWasabiRequest;
use App\Http\Requests\UpdateWasabiRequest;
use App\Http\Resources\Admin\WasabiResource;
use App\Models\Wasabi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WasabiApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('wasabi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WasabiResource(Wasabi::with(['product'])->get());
    }

    public function store(StoreWasabiRequest $request)
    {
        $wasabi = Wasabi::create($request->all());

        return (new WasabiResource($wasabi))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Wasabi $wasabi)
    {
        abort_if(Gate::denies('wasabi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WasabiResource($wasabi->load(['product']));
    }

    public function update(UpdateWasabiRequest $request, Wasabi $wasabi)
    {
        $wasabi->update($request->all());

        return (new WasabiResource($wasabi))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Wasabi $wasabi)
    {
        abort_if(Gate::denies('wasabi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wasabi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
