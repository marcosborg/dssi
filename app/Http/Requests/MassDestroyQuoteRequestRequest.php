<?php

namespace App\Http\Requests;

use App\Models\QuoteRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyQuoteRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('quote_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:quote_requests,id',
        ];
    }
}