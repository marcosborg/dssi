<?php

namespace App\Http\Requests;

use App\Models\Ubiquiti;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUbiquitiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ubiquiti_edit');
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
            'part_number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
