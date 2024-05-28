<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRoomAlertRequest;
use App\Http\Requests\StoreRoomAlertRequest;
use App\Http\Requests\UpdateRoomAlertRequest;
use App\Models\Product;
use App\Models\RoomAlert;
use App\Models\Stock;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RoomAlertController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('room_alert_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RoomAlert::with(['product', 'stock_mz', 'stock_ao'])->select(sprintf('%s.*', (new RoomAlert)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'room_alert_show';
                $editGate      = 'room_alert_edit';
                $deleteGate    = 'room_alert_delete';
                $crudRoutePart = 'room-alerts';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('product_information', function ($row) {
                return $row->product_information ? $row->product_information : '';
            });
            $table->editColumn('part_number', function ($row) {
                return $row->part_number ? $row->part_number : '';
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

            $table->rawColumns(['actions', 'placeholder', 'product', 'stock_mz', 'stock_ao']);

            return $table->make(true);
        }

        $products = Product::get();
        $stocks   = Stock::get();

        return view('admin.roomAlerts.index', compact('products', 'stocks'));
    }

    public function create()
    {
        abort_if(Gate::denies('room_alert_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stock_mzs = Stock::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stock_aos = Stock::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.roomAlerts.create', compact('products', 'stock_aos', 'stock_mzs'));
    }

    public function store(StoreRoomAlertRequest $request)
    {
        $roomAlert = RoomAlert::create($request->all());

        return redirect()->route('admin.room-alerts.index');
    }

    public function edit(RoomAlert $roomAlert)
    {
        abort_if(Gate::denies('room_alert_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stock_mzs = Stock::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stock_aos = Stock::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $roomAlert->load('product', 'stock_mz', 'stock_ao');

        return view('admin.roomAlerts.edit', compact('products', 'roomAlert', 'stock_aos', 'stock_mzs'));
    }

    public function update(UpdateRoomAlertRequest $request, RoomAlert $roomAlert)
    {
        $roomAlert->update($request->all());

        return redirect()->route('admin.room-alerts.index');
    }

    public function show(RoomAlert $roomAlert)
    {
        abort_if(Gate::denies('room_alert_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roomAlert->load('product', 'stock_mz', 'stock_ao');

        return view('admin.roomAlerts.show', compact('roomAlert'));
    }

    public function destroy(RoomAlert $roomAlert)
    {
        abort_if(Gate::denies('room_alert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roomAlert->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoomAlertRequest $request)
    {
        $roomAlerts = RoomAlert::find(request('ids'));

        foreach ($roomAlerts as $roomAlert) {
            $roomAlert->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
