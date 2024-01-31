<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTitanHqRequest;
use App\Http\Requests\UpdateTitanHqRequest;
use App\Http\Resources\Admin\TitanHqResource;
use App\Models\TitanHq;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TitanHqApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('titan_hq_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TitanHqResource(TitanHq::with(['product'])->get());
    }

    public function store(StoreTitanHqRequest $request)
    {
        $titanHq = TitanHq::create($request->all());

        return (new TitanHqResource($titanHq))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TitanHq $titanHq)
    {
        abort_if(Gate::denies('titan_hq_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TitanHqResource($titanHq->load(['product']));
    }

    public function update(UpdateTitanHqRequest $request, TitanHq $titanHq)
    {
        $titanHq->update($request->all());

        return (new TitanHqResource($titanHq))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TitanHq $titanHq)
    {
        abort_if(Gate::denies('titan_hq_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $titanHq->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
