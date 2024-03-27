<?php

namespace App\Http\Requests;

use App\Models\Nakivo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNakivoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('nakivo_edit');
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
