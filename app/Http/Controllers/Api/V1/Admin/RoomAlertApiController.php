<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomAlertRequest;
use App\Http\Requests\UpdateRoomAlertRequest;
use App\Http\Resources\Admin\RoomAlertResource;
use App\Models\RoomAlert;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomAlertApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('room_alert_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoomAlertResource(RoomAlert::with(['product', 'stock_mz', 'stock_ao'])->get());
    }

    public function store(StoreRoomAlertRequest $request)
    {
        $roomAlert = RoomAlert::create($request->all());

        return (new RoomAlertResource($roomAlert))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RoomAlert $roomAlert)
    {
        abort_if(Gate::denies('room_alert_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RoomAlertResource($roomAlert->load(['product', 'stock_mz', 'stock_ao']));
    }

    public function update(UpdateRoomAlertRequest $request, RoomAlert $roomAlert)
    {
        $roomAlert->update($request->all());

        return (new RoomAlertResource($roomAlert))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RoomAlert $roomAlert)
    {
        abort_if(Gate::denies('room_alert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roomAlert->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
