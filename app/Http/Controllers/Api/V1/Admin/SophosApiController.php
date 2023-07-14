<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSophoRequest;
use App\Http\Requests\UpdateSophoRequest;
use App\Http\Resources\Admin\SophoResource;
use App\Models\Sopho;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SophosApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sopho_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SophoResource(Sopho::with(['product'])->get());
    }

    public function store(StoreSophoRequest $request)
    {
        $sopho = Sopho::create($request->all());

        return (new SophoResource($sopho))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Sopho $sopho)
    {
        abort_if(Gate::denies('sopho_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SophoResource($sopho->load(['product']));
    }

    public function update(UpdateSophoRequest $request, Sopho $sopho)
    {
        $sopho->update($request->all());

        return (new SophoResource($sopho))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Sopho $sopho)
    {
        abort_if(Gate::denies('sopho_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sopho->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
