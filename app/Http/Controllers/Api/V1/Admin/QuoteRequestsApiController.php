<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreQuoteRequestRequest;
use App\Http\Requests\UpdateQuoteRequestRequest;
use App\Http\Resources\Admin\QuoteRequestResource;
use App\Models\Country;
use App\Models\QuoteRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Notification;
use App\Notifications\sendQuoteNotification;

class QuoteRequestsApiController extends Controller
{
    use MediaUploadingTrait;

    public function sendQuoteRequest(Request $request)
    {

        $data = json_decode($request->data);

        $user_id = $data->user->id;
        $product_id = $data->product->id;
        $quote = $data->calculatedPrice;

        $quote_request = new QuoteRequest;
        $quote_request->user_id = $user_id;
        $quote_request->product_id = $product_id;
        $quote_request->quote = $quote;
        $quote_request->data = json_encode($data);
        $quote_request->save();

        $user_name = $data->user->name;
        $user_email = $data->user->email;
        $company_name = $data->user->company->name;
        $company_type = $data->user->company->type;

        $country = Country::find($data->user->company->id)->first();

        $country_name = $country->name;
        $country_code = $country->code;

        $product_name = $data->product->name;
        $selection_name = $data->selection->name;
        $selection_part_number = $data->selection->part_number;
        $selection_description = $data->selection->description;

        $price = 0;

        if ($company_type == 'partner') {
            if ($country_code == 'mz') {
                $price = $data->selection->partner_mt;
            } else if ($country_code == 'ao') {
                $price = $data->selection->partner_kz;
            } else {
                $price = $data->selection->partner_eur;
            }
        } else {
            if ($country_code == 'mz') {
                $price = $data->selection->pvp_mt;
            } else if ($country_code == 'ao') {
                $price = $data->selection->pvp_kz;
            } else {
                $price = $data->selection->pvp_eur;
            }
        }

        $data = [
            'quote_request_id' => $quote_request->id,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'company_name' => $company_name,
            'country_name' => $country_name,
            'product_name' => $product_name,
            'selection_name' => $selection_name,
            'selection_part_number' => $selection_part_number,
            'selection_description' => $selection_description,
            'price' => $price,
            'final_price' => $data->calculatedPrice
        ];

        $quote_request->data = $data;
        $quote_request->save();

        if ($country_code == 'mz') {
            $email = 'comercial@dssi.co.mz';
        } else if ($country_code == 'ao') {
            $email = 'comercial@dssi.co.ao';
        } else {
            $email = 'comercial@dssi.pt';
        }

        Notification::route('mail', $email)
            ->notify(new sendQuoteNotification($data));

    }

    public function index(Request $request)
    {

        abort_if(Gate::denies('quote_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuoteRequestResource(QuoteRequest::with(['user', 'product'])->get());
    }

    public function store(StoreQuoteRequestRequest $request)
    {
        $quoteRequest = QuoteRequest::create($request->all());

        return (new QuoteRequestResource($quoteRequest))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(QuoteRequest $quoteRequest)
    {
        abort_if(Gate::denies('quote_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuoteRequestResource($quoteRequest->load(['user', 'product']));
    }

    public function update(UpdateQuoteRequestRequest $request, QuoteRequest $quoteRequest)
    {
        $quoteRequest->update($request->all());

        return (new QuoteRequestResource($quoteRequest))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(QuoteRequest $quoteRequest)
    {
        abort_if(Gate::denies('quote_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quoteRequest->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}