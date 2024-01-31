<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWasabiRequest;
use App\Http\Requests\StoreWasabiRequest;
use App\Http\Requests\UpdateWasabiRequest;
use App\Models\Product;
use App\Models\Wasabi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WasabiController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('wasabi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Wasabi::with(['product'])->select(sprintf('%s.*', (new Wasabi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'wasabi_show';
                $editGate      = 'wasabi_edit';
                $deleteGate    = 'wasabi_delete';
                $crudRoutePart = 'wasabis';

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
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('tb', function ($row) {
                return $row->tb ? $row->tb : '';
            });
            $table->editColumn('term', function ($row) {
                return $row->term ? $row->term : '';
            });
            $table->editColumn('part_number', function ($row) {
                return $row->part_number ? $row->part_number : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('partner_eur', function ($row) {
                return $row->partner_eur ? $row->partner_eur : '';
            });
            $table->editColumn('pvp_eur', function ($row) {
                return $row->pvp_eur ? $row->pvp_eur : '';
            });
            $table->editColumn('partner_mt', function ($row) {
                return $row->partner_mt ? $row->partner_mt : '';
            });
            $table->editColumn('pvp_mt', function ($row) {
                return $row->pvp_mt ? $row->pvp_mt : '';
            });
            $table->editColumn('partner_kz', function ($row) {
                return $row->partner_kz ? $row->partner_kz : '';
            });
            $table->editColumn('pvp_kz', function ($row) {
                return $row->pvp_kz ? $row->pvp_kz : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product']);

            return $table->make(true);
        }

        $products = Product::get();

        return view('admin.wasabis.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('wasabi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.wasabis.create', compact('products'));
    }

    public function store(StoreWasabiRequest $request)
    {
        $wasabi = Wasabi::create($request->all());

        return redirect()->route('admin.wasabis.index');
    }

    public function edit(Wasabi $wasabi)
    {
        abort_if(Gate::denies('wasabi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wasabi->load('product');

        return view('admin.wasabis.edit', compact('products', 'wasabi'));
    }

    public function update(UpdateWasabiRequest $request, Wasabi $wasabi)
    {
        $wasabi->update($request->all());

        return redirect()->route('admin.wasabis.index');
    }

    public function show(Wasabi $wasabi)
    {
        abort_if(Gate::denies('wasabi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wasabi->load('product');

        return view('admin.wasabis.show', compact('wasabi'));
    }

    public function destroy(Wasabi $wasabi)
    {
        abort_if(Gate::denies('wasabi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wasabi->delete();

        return back();
    }

    public function massDestroy(MassDestroyWasabiRequest $request)
    {
        $wasabis = Wasabi::find(request('ids'));

        foreach ($wasabis as $wasabi) {
            $wasabi->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
