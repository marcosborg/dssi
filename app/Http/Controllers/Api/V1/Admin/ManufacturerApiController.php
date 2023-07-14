<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;
use App\Http\Resources\Admin\ManufacturerResource;
use App\Models\Manufacturer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManufacturerApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('manufacturer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManufacturerResource(Manufacturer::all());
    }

    public function store(StoreManufacturerRequest $request)
    {
        $manufacturer = Manufacturer::create($request->all());

        if ($request->input('logo', false)) {
            $manufacturer->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        return (new ManufacturerResource($manufacturer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Manufacturer $manufacturer)
    {
        abort_if(Gate::denies('manufacturer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManufacturerResource($manufacturer);
    }

    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $manufacturer->update($request->all());

        if ($request->input('logo', false)) {
            if (! $manufacturer->logo || $request->input('logo') !== $manufacturer->logo->file_name) {
                if ($manufacturer->logo) {
                    $manufacturer->logo->delete();
                }
                $manufacturer->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($manufacturer->logo) {
            $manufacturer->logo->delete();
        }

        return (new ManufacturerResource($manufacturer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Manufacturer $manufacturer)
    {
        abort_if(Gate::denies('manufacturer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
