<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMailStoreRequest;
use App\Http\Requests\StoreMailStoreRequest;
use App\Http\Requests\UpdateMailStoreRequest;
use App\Models\MailStore;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MailStoreController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mail_store_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MailStore::with(['product'])->select(sprintf('%s.*', (new MailStore)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mail_store_show';
                $editGate      = 'mail_store_edit';
                $deleteGate    = 'mail_store_delete';
                $crudRoutePart = 'mail-stores';

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

        return view('admin.mailStores.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('mail_store_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mailStores.create', compact('products'));
    }

    public function store(StoreMailStoreRequest $request)
    {
        $mailStore = MailStore::create($request->all());

        return redirect()->route('admin.mail-stores.index');
    }

    public function edit(MailStore $mailStore)
    {
        abort_if(Gate::denies('mail_store_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mailStore->load('product');

        return view('admin.mailStores.edit', compact('mailStore', 'products'));
    }

    public function update(UpdateMailStoreRequest $request, MailStore $mailStore)
    {
        $mailStore->update($request->all());

        return redirect()->route('admin.mail-stores.index');
    }

    public function show(MailStore $mailStore)
    {
        abort_if(Gate::denies('mail_store_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mailStore->load('product');

        return view('admin.mailStores.show', compact('mailStore'));
    }

    public function destroy(MailStore $mailStore)
    {
        abort_if(Gate::denies('mail_store_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mailStore->delete();

        return back();
    }

    public function massDestroy(MassDestroyMailStoreRequest $request)
    {
        $mailStores = MailStore::find(request('ids'));

        foreach ($mailStores as $mailStore) {
            $mailStore->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
