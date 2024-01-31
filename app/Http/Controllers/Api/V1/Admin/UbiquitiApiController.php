<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUbiquitiRequest;
use App\Http\Requests\UpdateUbiquitiRequest;
use App\Http\Resources\Admin\UbiquitiResource;
use App\Models\Ubiquiti;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UbiquitiApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ubiquiti_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UbiquitiResource(Ubiquiti::with(['product', 'stock_mz', 'stock_ao'])->get());
    }

    public function store(StoreUbiquitiRequest $request)
    {
        $ubiquiti = Ubiquiti::create($request->all());

        return (new UbiquitiResource($ubiquiti))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ubiquiti $ubiquiti)
    {
        abort_if(Gate::denies('ubiquiti_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UbiquitiResource($ubiquiti->load(['product', 'stock_mz', 'stock_ao']));
    }

    public function update(UpdateUbiquitiRequest $request, Ubiquiti $ubiquiti)
    {
        $ubiquiti->update($request->all());

        return (new UbiquitiResource($ubiquiti))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ubiquiti $ubiquiti)
    {
        abort_if(Gate::denies('ubiquiti_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ubiquiti->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
