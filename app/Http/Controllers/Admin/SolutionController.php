<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySolutionRequest;
use App\Http\Requests\StoreSolutionRequest;
use App\Http\Requests\UpdateSolutionRequest;
use App\Models\Solution;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SolutionController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('solution_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Solution::query()->select(sprintf('%s.*', (new Solution)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'solution_show';
                $editGate      = 'solution_edit';
                $deleteGate    = 'solution_delete';
                $crudRoutePart = 'solutions';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image']);

            return $table->make(true);
        }

        return view('admin.solutions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('solution_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.solutions.create');
    }

    public function store(StoreSolutionRequest $request)
    {
        $solution = Solution::create($request->all());

        if ($request->input('image', false)) {
            $solution->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $solution->id]);
        }

        return redirect()->route('admin.solutions.index');
    }

    public function edit(Solution $solution)
    {
        abort_if(Gate::denies('solution_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.solutions.edit', compact('solution'));
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

        return redirect()->route('admin.solutions.index');
    }

    public function show(Solution $solution)
    {
        abort_if(Gate::denies('solution_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.solutions.show', compact('solution'));
    }

    public function destroy(Solution $solution)
    {
        abort_if(Gate::denies('solution_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $solution->delete();

        return back();
    }

    public function massDestroy(MassDestroySolutionRequest $request)
    {
        $solutions = Solution::find(request('ids'));

        foreach ($solutions as $solution) {
            $solution->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('solution_create') && Gate::denies('solution_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Solution();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
