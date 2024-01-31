<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUbiquitiRequest;
use App\Http\Requests\StoreUbiquitiRequest;
use App\Http\Requests\UpdateUbiquitiRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Ubiquiti;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UbiquitiController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('ubiquiti_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ubiquiti::with(['stock_mz', 'stock_ao', 'product'])->select(sprintf('%s.*', (new Ubiquiti)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'ubiquiti_show';
                $editGate      = 'ubiquiti_edit';
                $deleteGate    = 'ubiquiti_delete';
                $crudRoutePart = 'ubiquitis';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('product_information', function ($row) {
                return $row->product_information ? $row->product_information : '';
            });
            $table->editColumn('product_number', function ($row) {
                return $row->product_number ? $row->product_number : '';
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
            $table->addColumn('stock_mz_name', function ($row) {
                return $row->stock_mz ? $row->stock_mz->name : '';
            });

            $table->addColumn('stock_ao_name', function ($row) {
                return $row->stock_ao ? $row->stock_ao->name : '';
            });

            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'stock_mz', 'stock_ao', 'product']);

            return $table->make(true);
        }

        $stocks   = Stock::get();
        $products = Product::get();

        return view('admin.ubiquitis.index', compact('stocks', 'products'));
    }

    public function create()
    {
        abort_if(Gate::denies('ubiquiti_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stock_mzs = Stock::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stock_aos = Stock::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ubiquitis.create', compact('products', 'stock_aos', 'stock_mzs'));
    }

    public function store(StoreUbiquitiRequest $request)
    {
        $ubiquiti = Ubiquiti::create($request->all());

        return redirect()->route('admin.ubiquitis.index');
    }

    public function edit(Ubiquiti $ubiquiti)
    {
        abort_if(Gate::denies('ubiquiti_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stock_mzs = Stock::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stock_aos = Stock::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ubiquiti->load('stock_mz', 'stock_ao', 'product');

        return view('admin.ubiquitis.edit', compact('products', 'stock_aos', 'stock_mzs', 'ubiquiti'));
    }

    public function update(UpdateUbiquitiRequest $request, Ubiquiti $ubiquiti)
    {
        $ubiquiti->update($request->all());

        return redirect()->route('admin.ubiquitis.index');
    }

    public function show(Ubiquiti $ubiquiti)
    {
        abort_if(Gate::denies('ubiquiti_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ubiquiti->load('stock_mz', 'stock_ao', 'product');

        return view('admin.ubiquitis.show', compact('ubiquiti'));
    }

    public function destroy(Ubiquiti $ubiquiti)
    {
        abort_if(Gate::denies('ubiquiti_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ubiquiti->delete();

        return back();
    }

    public function massDestroy(MassDestroyUbiquitiRequest $request)
    {
        $ubiquitis = Ubiquiti::find(request('ids'));

        foreach ($ubiquitis as $ubiquiti) {
            $ubiquiti->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
