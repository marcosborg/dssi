<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCrashPlanRequest;
use App\Http\Requests\StoreCrashPlanRequest;
use App\Http\Requests\UpdateCrashPlanRequest;
use App\Models\CrashPlan;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CrashPlanController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('crash_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CrashPlan::with(['product'])->select(sprintf('%s.*', (new CrashPlan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'crash_plan_show';
                $editGate      = 'crash_plan_edit';
                $deleteGate    = 'crash_plan_delete';
                $crudRoutePart = 'crash-plans';

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
            $table->editColumn('from', function ($row) {
                return $row->from ? $row->from : '';
            });
            $table->editColumn('to', function ($row) {
                return $row->to ? $row->to : '';
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

        return view('admin.crashPlans.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('crash_plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.crashPlans.create', compact('products'));
    }

    public function store(StoreCrashPlanRequest $request)
    {
        $crashPlan = CrashPlan::create($request->all());

        return redirect()->route('admin.crash-plans.index');
    }

    public function edit(CrashPlan $crashPlan)
    {
        abort_if(Gate::denies('crash_plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $crashPlan->load('product');

        return view('admin.crashPlans.edit', compact('crashPlan', 'products'));
    }

    public function update(UpdateCrashPlanRequest $request, CrashPlan $crashPlan)
    {
        $crashPlan->update($request->all());

        return redirect()->route('admin.crash-plans.index');
    }

    public function show(CrashPlan $crashPlan)
    {
        abort_if(Gate::denies('crash_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crashPlan->load('product');

        return view('admin.crashPlans.show', compact('crashPlan'));
    }

    public function destroy(CrashPlan $crashPlan)
    {
        abort_if(Gate::denies('crash_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $crashPlan->delete();

        return back();
    }

    public function massDestroy(MassDestroyCrashPlanRequest $request)
    {
        $crashPlans = CrashPlan::find(request('ids'));

        foreach ($crashPlans as $crashPlan) {
            $crashPlan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
