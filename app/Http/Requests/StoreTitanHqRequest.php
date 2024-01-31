<?php

namespace App\Http\Requests;

use App\Models\TitanHq;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTitanHqRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('titan_hq_create');
    }

    public function rules()
    {
        return [
            'product_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'term' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'from' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'to' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'product_number' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
