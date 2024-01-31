<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMailStoreRequest;
use App\Http\Requests\UpdateMailStoreRequest;
use App\Http\Resources\Admin\MailStoreResource;
use App\Models\MailStore;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MailStoreApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mail_store_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MailStoreResource(MailStore::with(['product'])->get());
    }

    public function store(StoreMailStoreRequest $request)
    {
        $mailStore = MailStore::create($request->all());

        return (new MailStoreResource($mailStore))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MailStore $mailStore)
    {
        abort_if(Gate::denies('mail_store_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MailStoreResource($mailStore->load(['product']));
    }

    public function update(UpdateMailStoreRequest $request, MailStore $mailStore)
    {
        $mailStore->update($request->all());

        return (new MailStoreResource($mailStore))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MailStore $mailStore)
    {
        abort_if(Gate::denies('mail_store_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mailStore->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
