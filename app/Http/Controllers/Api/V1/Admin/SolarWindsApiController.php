<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSolarWindRequest;
use App\Http\Requests\UpdateSolarWindRequest;
use App\Http\Resources\Admin\SolarWindResource;
use App\Models\SolarWind;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SolarWindsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('solar_wind_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SolarWindResource(SolarWind::with(['product'])->get());
    }

    public function store(StoreSolarWindRequest $request)
    {
        $solarWind = SolarWind::create($request->all());

        return (new SolarWindResource($solarWind))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SolarWind $solarWind)
    {
        abort_if(Gate::denies('solar_wind_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SolarWindResource($solarWind->load(['product']));
    }

    public function update(UpdateSolarWindRequest $request, SolarWind $solarWind)
    {
        $solarWind->update($request->all());

        return (new SolarWindResource($solarWind))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SolarWind $solarWind)
    {
        abort_if(Gate::denies('solar_wind_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $solarWind->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
