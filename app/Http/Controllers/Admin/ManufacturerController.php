<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyManufacturerRequest;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;
use App\Models\Manufacturer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ManufacturerController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('manufacturer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Manufacturer::query()->select(sprintf('%s.*', (new Manufacturer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'manufacturer_show';
                $editGate      = 'manufacturer_edit';
                $deleteGate    = 'manufacturer_delete';
                $crudRoutePart = 'manufacturers';

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
            $table->editColumn('url', function ($row) {
                return $row->url ? $row->url : '';
            });
            $table->editColumn('logo', function ($row) {
                if ($photo = $row->logo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('files', function ($row) {
                if (! $row->files) {
                    return '';
                }
                $links = [];
                foreach ($row->files as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('pt', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->pt ? 'checked' : null) . '>';
            });
            $table->editColumn('mz', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->mz ? 'checked' : null) . '>';
            });
            $table->editColumn('ao', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->ao ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'logo', 'files', 'pt', 'mz', 'ao']);

            return $table->make(true);
        }

        return view('admin.manufacturers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('manufacturer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.manufacturers.create');
    }

    public function store(StoreManufacturerRequest $request)
    {
        $manufacturer = Manufacturer::create($request->all());

        if ($request->input('logo', false)) {
            $manufacturer->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        foreach ($request->input('files', []) as $file) {
            $manufacturer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $manufacturer->id]);
        }

        return redirect()->route('admin.manufacturers.index');
    }

    public function edit(Manufacturer $manufacturer)
    {
        abort_if(Gate::denies('manufacturer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.manufacturers.edit', compact('manufacturer'));
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

        if (count($manufacturer->files) > 0) {
            foreach ($manufacturer->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $manufacturer->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $manufacturer->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.manufacturers.index');
    }

    public function show(Manufacturer $manufacturer)
    {
        abort_if(Gate::denies('manufacturer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.manufacturers.show', compact('manufacturer'));
    }

    public function destroy(Manufacturer $manufacturer)
    {
        abort_if(Gate::denies('manufacturer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturer->delete();

        return back();
    }

    public function massDestroy(MassDestroyManufacturerRequest $request)
    {
        $manufacturers = Manufacturer::find(request('ids'));

        foreach ($manufacturers as $manufacturer) {
            $manufacturer->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('manufacturer_create') && Gate::denies('manufacturer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Manufacturer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
