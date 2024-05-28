<?php

namespace App\Http\Requests;

use App\Models\QuoteRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateQuoteRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('quote_request_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
