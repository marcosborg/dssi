<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Solution;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Product::with(['manufacturer', 'solution'])->select(sprintf('%s.*', (new Product)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'product_show';
                $editGate      = 'product_edit';
                $deleteGate    = 'product_delete';
                $crudRoutePart = 'products';

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
            $table->addColumn('manufacturer_name', function ($row) {
                return $row->manufacturer ? $row->manufacturer->name : '';
            });

            $table->addColumn('solution_name', function ($row) {
                return $row->solution ? $row->solution->name : '';
            });

            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('questions', function ($row) {
                return $row->questions ? $row->questions : '';
            });
            $table->editColumn('question_1_pt', function ($row) {
                return $row->question_1_pt ? $row->question_1_pt : '';
            });
            $table->editColumn('question_1_en', function ($row) {
                return $row->question_1_en ? $row->question_1_en : '';
            });
            $table->editColumn('question_2_pt', function ($row) {
                return $row->question_2_pt ? $row->question_2_pt : '';
            });
            $table->editColumn('question_2_en', function ($row) {
                return $row->question_2_en ? $row->question_2_en : '';
            });
            $table->editColumn('question_3_pt', function ($row) {
                return $row->question_3_pt ? $row->question_3_pt : '';
            });
            $table->editColumn('question_3_en', function ($row) {
                return $row->question_3_en ? $row->question_3_en : '';
            });
            $table->editColumn('question_4_pt', function ($row) {
                return $row->question_4_pt ? $row->question_4_pt : '';
            });
            $table->editColumn('question_4_en', function ($row) {
                return $row->question_4_en ? $row->question_4_en : '';
            });
            $table->editColumn('question_5_pt', function ($row) {
                return $row->question_5_pt ? $row->question_5_pt : '';
            });
            $table->editColumn('question_5_en', function ($row) {
                return $row->question_5_en ? $row->question_5_en : '';
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

            $table->rawColumns(['actions', 'placeholder', 'manufacturer', 'solution', 'files']);

            return $table->make(true);
        }

        $manufacturers = Manufacturer::get();
        $solutions     = Solution::get();

        return view('admin.products.index', compact('manufacturers', 'solutions'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturers = Manufacturer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $solutions = Solution::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.products.create', compact('manufacturers', 'solutions'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manufacturers = Manufacturer::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $solutions = Solution::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product->load('manufacturer', 'solution');

        return view('admin.products.edit', compact('manufacturers', 'product', 'solutions'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        if (count($product->files) > 0) {
            foreach ($product->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $product->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('manufacturer', 'solution');

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        $products = Product::find(request('ids'));

        foreach ($products as $product) {
            $product->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
