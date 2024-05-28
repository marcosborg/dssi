<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyQuoteRequestRequest;
use App\Http\Requests\StoreQuoteRequestRequest;
use App\Http\Requests\UpdateQuoteRequestRequest;
use App\Models\Product;
use App\Models\QuoteRequest;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class QuoteRequestsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('quote_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = QuoteRequest::with(['user', 'product'])->select(sprintf('%s.*', (new QuoteRequest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'quote_request_show';
                $editGate      = 'quote_request_edit';
                $deleteGate    = 'quote_request_delete';
                $crudRoutePart = 'quote-requests';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('quote', function ($row) {
                return $row->quote ? $row->quote : '';
            });
            $table->editColumn('data', function ($row) {
                return $row->data ? $row->data : '';
            });
            $table->editColumn('checked', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->checked ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'product', 'checked']);

            return $table->make(true);
        }

        $users    = User::get();
        $products = Product::get();

        return view('admin.quoteRequests.index', compact('users', 'products'));
    }

    public function create()
    {
        abort_if(Gate::denies('quote_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.quoteRequests.create', compact('products', 'users'));
    }

    public function store(StoreQuoteRequestRequest $request)
    {
        $quoteRequest = QuoteRequest::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $quoteRequest->id]);
        }

        return redirect()->route('admin.quote-requests.index');
    }

    public function edit(QuoteRequest $quoteRequest)
    {
        abort_if(Gate::denies('quote_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quoteRequest->load('user', 'product');

        return view('admin.quoteRequests.edit', compact('products', 'quoteRequest', 'users'));
    }

    public function update(UpdateQuoteRequestRequest $request, QuoteRequest $quoteRequest)
    {
        $quoteRequest->update($request->all());

        return redirect()->route('admin.quote-requests.index');
    }

    public function show(QuoteRequest $quoteRequest)
    {
        abort_if(Gate::denies('quote_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quoteRequest->load('user', 'product');

        return view('admin.quoteRequests.show', compact('quoteRequest'));
    }

    public function destroy(QuoteRequest $quoteRequest)
    {
        abort_if(Gate::denies('quote_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quoteRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyQuoteRequestRequest $request)
    {
        $quoteRequests = QuoteRequest::find(request('ids'));

        foreach ($quoteRequests as $quoteRequest) {
            $quoteRequest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('quote_request_create') && Gate::denies('quote_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new QuoteRequest();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}