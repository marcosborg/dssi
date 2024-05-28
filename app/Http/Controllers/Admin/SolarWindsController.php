<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySolarWindRequest;
use App\Http\Requests\StoreSolarWindRequest;
use App\Http\Requests\UpdateSolarWindRequest;
use App\Models\Product;
use App\Models\SolarWind;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SolarWindsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('solar_wind_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SolarWind::with(['product'])->select(sprintf('%s.*', (new SolarWind)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'solar_wind_show';
                $editGate      = 'solar_wind_edit';
                $deleteGate    = 'solar_wind_delete';
                $crudRoutePart = 'solar-winds';

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

        return view('admin.solarWinds.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('solar_wind_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.solarWinds.create', compact('products'));
    }

    public function store(StoreSolarWindRequest $request)
    {
        $solarWind = SolarWind::create($request->all());

        return redirect()->route('admin.solar-winds.index');
    }

    public function edit(SolarWind $solarWind)
    {
        abort_if(Gate::denies('solar_wind_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $solarWind->load('product');

        return view('admin.solarWinds.edit', compact('products', 'solarWind'));
    }

    public function update(UpdateSolarWindRequest $request, SolarWind $solarWind)
    {
        $solarWind->update($request->all());

        return redirect()->route('admin.solar-winds.index');
    }

    public function show(SolarWind $solarWind)
    {
        abort_if(Gate::denies('solar_wind_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $solarWind->load('product');

        return view('admin.solarWinds.show', compact('solarWind'));
    }

    public function destroy(SolarWind $solarWind)
    {
        abort_if(Gate::denies('solar_wind_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $solarWind->delete();

        return back();
    }

    public function massDestroy(MassDestroySolarWindRequest $request)
    {
        $solarWinds = SolarWind::find(request('ids'));

        foreach ($solarWinds as $solarWind) {
            $solarWind->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
