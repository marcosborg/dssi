<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTitanHqRequest;
use App\Http\Requests\StoreTitanHqRequest;
use App\Http\Requests\UpdateTitanHqRequest;
use App\Models\Product;
use App\Models\TitanHq;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TitanHqController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('titan_hq_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TitanHq::with(['product'])->select(sprintf('%s.*', (new TitanHq)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'titan_hq_show';
                $editGate      = 'titan_hq_edit';
                $deleteGate    = 'titan_hq_delete';
                $crudRoutePart = 'titan-hqs';

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
            $table->editColumn('term', function ($row) {
                return $row->term ? $row->term : '';
            });
            $table->editColumn('from', function ($row) {
                return $row->from ? $row->from : '';
            });
            $table->editColumn('to', function ($row) {
                return $row->to ? $row->to : '';
            });
            $table->editColumn('product_number', function ($row) {
                return $row->product_number ? $row->product_number : '';
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

        return view('admin.titanHqs.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('titan_hq_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.titanHqs.create', compact('products'));
    }

    public function store(StoreTitanHqRequest $request)
    {
        $titanHq = TitanHq::create($request->all());

        return redirect()->route('admin.titan-hqs.index');
    }

    public function edit(TitanHq $titanHq)
    {
        abort_if(Gate::denies('titan_hq_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $titanHq->load('product');

        return view('admin.titanHqs.edit', compact('products', 'titanHq'));
    }

    public function update(UpdateTitanHqRequest $request, TitanHq $titanHq)
    {
        $titanHq->update($request->all());

        return redirect()->route('admin.titan-hqs.index');
    }

    public function show(TitanHq $titanHq)
    {
        abort_if(Gate::denies('titan_hq_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $titanHq->load('product');

        return view('admin.titanHqs.show', compact('titanHq'));
    }

    public function destroy(TitanHq $titanHq)
    {
        abort_if(Gate::denies('titan_hq_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $titanHq->delete();

        return back();
    }

    public function massDestroy(MassDestroyTitanHqRequest $request)
    {
        $titanHqs = TitanHq::find(request('ids'));

        foreach ($titanHqs as $titanHq) {
            $titanHq->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
