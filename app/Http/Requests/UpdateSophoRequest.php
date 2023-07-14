<?php

namespace App\Http\Requests;

use App\Models\Sopho;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSophoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sopho_edit');
    }

    public function rules()
    {
        return [
            'product_id' => [
                'required',
                'integer',
            ],
            'family' => [
                'string',
                'nullable',
            ],
            'type' => [
                'string',
                'nullable',
            ],
            'term' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'min' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'max' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
