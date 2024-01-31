<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKSevenSecurityRequest;
use App\Http\Requests\UpdateKSevenSecurityRequest;
use App\Http\Resources\Admin\KSevenSecurityResource;
use App\Models\KSevenSecurity;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KSevenSecurityApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('k_seven_security_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KSevenSecurityResource(KSevenSecurity::with(['product'])->get());
    }

    public function store(StoreKSevenSecurityRequest $request)
    {
        $kSevenSecurity = KSevenSecurity::create($request->all());

        return (new KSevenSecurityResource($kSevenSecurity))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(KSevenSecurity $kSevenSecurity)
    {
        abort_if(Gate::denies('k_seven_security_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KSevenSecurityResource($kSevenSecurity->load(['product']));
    }

    public function update(UpdateKSevenSecurityRequest $request, KSevenSecurity $kSevenSecurity)
    {
        $kSevenSecurity->update($request->all());

        return (new KSevenSecurityResource($kSevenSecurity))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(KSevenSecurity $kSevenSecurity)
    {
        abort_if(Gate::denies('k_seven_security_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kSevenSecurity->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
