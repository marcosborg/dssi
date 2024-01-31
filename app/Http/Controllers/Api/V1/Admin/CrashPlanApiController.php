<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCrashPlanRequest;
use App\Http\Requests\UpdateCrashPlanRequest;
use App\Http\Resources\Admin\CrashPlanResource;
use App\Models\CrashPlan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CrashPlanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('crash_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CrashPlanResource(CrashPlan::with(['product'])->get());
    }

    public function store(StoreCrashPlanRequest $request)
    {
        $crashPlan = CrashPlan::create($request->all());

        return (new CrashPlanResource($crashPlan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CrashPlan $crashPlan)
    {
        abort_if(Gate::denies('crash_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CrashPlanResource($crashPlan->load(['product']));
    }

    public function update(UpdateCrashPlanRequest $request, CrashPlan $crashPlan)
    {
        $crashPlan->update($request->all());

        return (new CrashPlanResource($crashPlan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CrashPlan $crashPlan)
    {
        abort_if(Gate::denies('crash_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crashPlan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
