<?php

namespace App\Http\Requests;

use App\Models\Ubiquiti;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUbiquitiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ubiquiti_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'product_number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
