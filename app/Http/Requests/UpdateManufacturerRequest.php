<?php

namespace App\Http\Requests;

use App\Models\Manufacturer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateManufacturerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('manufacturer_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'url' => [
                'string',
                'required',
            ],
            'text_pt' => [
                'string',
                'nullable',
            ],
            'text_en' => [
                'string',
                'nullable',
            ],
        ];
    }
}
