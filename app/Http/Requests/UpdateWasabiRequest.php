<?php

namespace App\Http\Requests;

use App\Models\Wasabi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWasabiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('wasabi_edit');
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
            'tb' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'term' => [
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