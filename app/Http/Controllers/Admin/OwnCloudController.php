<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOwnCloudRequest;
use App\Http\Requests\StoreOwnCloudRequest;
use App\Http\Requests\UpdateOwnCloudRequest;
use App\Models\OwnCloud;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OwnCloudController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('own_cloud_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OwnCloud::with(['product'])->select(sprintf('%s.*', (new OwnCloud)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'own_cloud_show';
                $editGate      = 'own_cloud_edit';
                $deleteGate    = 'own_cloud_delete';
                $crudRoutePart = 'own-clouds';

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

        return view('admin.ownClouds.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('own_cloud_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ownClouds.create', compact('products'));
    }

    public function store(StoreOwnCloudRequest $request)
    {
        $ownCloud = OwnCloud::create($request->all());

        return redirect()->route('admin.own-clouds.index');
    }

    public function edit(OwnCloud $ownCloud)
    {
        abort_if(Gate::denies('own_cloud_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ownCloud->load('product');

        return view('admin.ownClouds.edit', compact('ownCloud', 'products'));
    }

    public function update(UpdateOwnCloudRequest $request, OwnCloud $ownCloud)
    {
        $ownCloud->update($request->all());

        return redirect()->route('admin.own-clouds.index');
    }

    public function show(OwnCloud $ownCloud)
    {
        abort_if(Gate::denies('own_cloud_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownCloud->load('product');

        return view('admin.ownClouds.show', compact('ownCloud'));
    }

    public function destroy(OwnCloud $ownCloud)
    {
        abort_if(Gate::denies('own_cloud_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ownCloud->delete();

        return back();
    }

    public function massDestroy(MassDestroyOwnCloudRequest $request)
    {
        $ownClouds = OwnCloud::find(request('ids'));

        foreach ($ownClouds as $ownCloud) {
            $ownCloud->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
