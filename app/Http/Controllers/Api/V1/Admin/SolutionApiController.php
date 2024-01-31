<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSolutionRequest;
use App\Http\Requests\UpdateSolutionRequest;
use App\Http\Resources\Admin\SolutionResource;
use App\Models\Solution;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SolutionApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('solution_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SolutionResource(Solution::all());
    }

    public function store(StoreSolutionRequest $request)
    {
        $solution = Solution::create($request->all());

        if ($request->input('image', false)) {
            $solution->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new SolutionResource($solution))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Solution $solution)
    {
        abort_if(Gate::denies('solution_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SolutionResource($solution);
    }

    public function update(UpdateSolutionRequest $request, Solution $solution)
    {
        $solution->update($request->all());

        if ($request->input('image', false)) {
            if (! $solution->image || $request->input('image') !== $solution->image->file_name) {
                if ($solution->image) {
                    $solution->image->delete();
                }
                $solution->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($solution->image) {
            $solution->image->delete();
        }

        return (new SolutionResource($solution))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Solution $solution)
    {
        abort_if(Gate::denies('solution_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $solution->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
