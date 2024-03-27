<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNakivoRequest;
use App\Http\Requests\UpdateNakivoRequest;
use App\Http\Resources\Admin\NakivoResource;
use App\Models\Nakivo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NakivoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('nakivo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NakivoResource(Nakivo::with(['product'])->get());
    }

    public function store(StoreNakivoRequest $request)
    {
        $nakivo = Nakivo::create($request->all());

        return (new NakivoResource($nakivo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Nakivo $nakivo)
    {
        abort_if(Gate::denies('nakivo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NakivoResource($nakivo->load(['product']));
    }

    public function update(UpdateNakivoRequest $request, Nakivo $nakivo)
    {
        $nakivo->update($request->all());

        return (new NakivoResource($nakivo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Nakivo $nakivo)
    {
        abort_if(Gate::denies('nakivo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nakivo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
