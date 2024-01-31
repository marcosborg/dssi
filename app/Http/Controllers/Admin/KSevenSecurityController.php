<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyKSevenSecurityRequest;
use App\Http\Requests\StoreKSevenSecurityRequest;
use App\Http\Requests\UpdateKSevenSecurityRequest;
use App\Models\KSevenSecurity;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KSevenSecurityController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('k_seven_security_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = KSevenSecurity::with(['product'])->select(sprintf('%s.*', (new KSevenSecurity)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'k_seven_security_show';
                $editGate      = 'k_seven_security_edit';
                $deleteGate    = 'k_seven_security_delete';
                $crudRoutePart = 'k-seven-securities';

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

        return view('admin.kSevenSecurities.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('k_seven_security_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.kSevenSecurities.create', compact('products'));
    }

    public function store(StoreKSevenSecurityRequest $request)
    {
        $kSevenSecurity = KSevenSecurity::create($request->all());

        return redirect()->route('admin.k-seven-securities.index');
    }

    public function edit(KSevenSecurity $kSevenSecurity)
    {
        abort_if(Gate::denies('k_seven_security_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kSevenSecurity->load('product');

        return view('admin.kSevenSecurities.edit', compact('kSevenSecurity', 'products'));
    }

    public function update(UpdateKSevenSecurityRequest $request, KSevenSecurity $kSevenSecurity)
    {
        $kSevenSecurity->update($request->all());

        return redirect()->route('admin.k-seven-securities.index');
    }

    public function show(KSevenSecurity $kSevenSecurity)
    {
        abort_if(Gate::denies('k_seven_security_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kSevenSecurity->load('product');

        return view('admin.kSevenSecurities.show', compact('kSevenSecurity'));
    }

    public function destroy(KSevenSecurity $kSevenSecurity)
    {
        abort_if(Gate::denies('k_seven_security_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kSevenSecurity->delete();

        return back();
    }

    public function massDestroy(MassDestroyKSevenSecurityRequest $request)
    {
        $kSevenSecurities = KSevenSecurity::find(request('ids'));

        foreach ($kSevenSecurities as $kSevenSecurity) {
            $kSevenSecurity->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
