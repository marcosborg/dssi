<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            'name_pt' => [
                'string',
                'required',
            ],
            'name_en' => [
                'string',
                'required',
            ],
            'manufacturer_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
