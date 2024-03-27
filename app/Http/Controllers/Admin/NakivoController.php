<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyNakivoRequest;
use App\Http\Requests\StoreNakivoRequest;
use App\Http\Requests\UpdateNakivoRequest;
use App\Models\Nakivo;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NakivoController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('nakivo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Nakivo::with(['product'])->select(sprintf('%s.*', (new Nakivo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'nakivo_show';
                $editGate      = 'nakivo_edit';
                $deleteGate    = 'nakivo_delete';
                $crudRoutePart = 'nakivos';

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
            $table->editColumn('option_1', function ($row) {
                return $row->option_1 ? $row->option_1 : '';
            });
            $table->editColumn('option_2', function ($row) {
                return $row->option_2 ? $row->option_2 : '';
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

        return view('admin.nakivos.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('nakivo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.nakivos.create', compact('products'));
    }

    public function store(StoreNakivoRequest $request)
    {
        $nakivo = Nakivo::create($request->all());

        return redirect()->route('admin.nakivos.index');
    }

    public function edit(Nakivo $nakivo)
    {
        abort_if(Gate::denies('nakivo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nakivo->load('product');

        return view('admin.nakivos.edit', compact('nakivo', 'products'));
    }

    public function update(UpdateNakivoRequest $request, Nakivo $nakivo)
    {
        $nakivo->update($request->all());

        return redirect()->route('admin.nakivos.index');
    }

    public function show(Nakivo $nakivo)
    {
        abort_if(Gate::denies('nakivo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nakivo->load('product');

        return view('admin.nakivos.show', compact('nakivo'));
    }

    public function destroy(Nakivo $nakivo)
    {
        abort_if(Gate::denies('nakivo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nakivo->delete();

        return back();
    }

    public function massDestroy(MassDestroyNakivoRequest $request)
    {
        $nakivos = Nakivo::find(request('ids'));

        foreach ($nakivos as $nakivo) {
            $nakivo->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
