<?php

namespace App\Http\Requests;

use App\Models\SolarWind;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSolarWindRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('solar_wind_create');
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
            'option_1' => [
                'string',
                'nullable',
            ],
            'option_2' => [
                'string',
                'nullable',
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
