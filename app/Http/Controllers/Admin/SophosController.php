<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySophoRequest;
use App\Http\Requests\StoreSophoRequest;
use App\Http\Requests\UpdateSophoRequest;
use App\Models\Product;
use App\Models\Sopho;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SophosController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sopho_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Sopho::with(['product'])->select(sprintf('%s.*', (new Sopho)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sopho_show';
                $editGate      = 'sopho_edit';
                $deleteGate    = 'sopho_delete';
                $crudRoutePart = 'sophos';

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
            $table->addColumn('product_name_pt', function ($row) {
                return $row->product ? $row->product->name_pt : '';
            });

            $table->editColumn('family', function ($row) {
                return $row->family ? $row->family : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('term', function ($row) {
                return $row->term ? $row->term : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('min', function ($row) {
                return $row->min ? $row->min : '';
            });
            $table->editColumn('max', function ($row) {
                return $row->max ? $row->max : '';
            });
            $table->editColumn('price_partner_met', function ($row) {
                return $row->price_partner_met ? $row->price_partner_met : '';
            });
            $table->editColumn('pvp_met', function ($row) {
                return $row->pvp_met ? $row->pvp_met : '';
            });
            $table->editColumn('price_partner_kwa', function ($row) {
                return $row->price_partner_kwa ? $row->price_partner_kwa : '';
            });
            $table->editColumn('pvp_kwa', function ($row) {
                return $row->pvp_kwa ? $row->pvp_kwa : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product']);

            return $table->make(true);
        }

        return view('admin.sophos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sopho_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name_pt', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sophos.create', compact('products'));
    }

    public function store(StoreSophoRequest $request)
    {
        $sopho = Sopho::create($request->all());

        return redirect()->route('admin.sophos.index');
    }

    public function edit(Sopho $sopho)
    {
        abort_if(Gate::denies('sopho_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name_pt', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sopho->load('product');

        return view('admin.sophos.edit', compact('products', 'sopho'));
    }

    public function update(UpdateSophoRequest $request, Sopho $sopho)
    {
        $sopho->update($request->all());

        return redirect()->route('admin.sophos.index');
    }

    public function show(Sopho $sopho)
    {
        abort_if(Gate::denies('sopho_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sopho->load('product');

        return view('admin.sophos.show', compact('sopho'));
    }

    public function destroy(Sopho $sopho)
    {
        abort_if(Gate::denies('sopho_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sopho->delete();

        return back();
    }

    public function massDestroy(MassDestroySophoRequest $request)
    {
        $sophos = Sopho::find(request('ids'));

        foreach ($sophos as $sopho) {
            $sopho->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
