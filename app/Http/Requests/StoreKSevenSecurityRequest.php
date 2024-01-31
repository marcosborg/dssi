<?php

namespace App\Http\Requests;

use App\Models\KSevenSecurity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKSevenSecurityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('k_seven_security_create');
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
            'part_number' => [
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
