<?php

namespace App\Http\Requests;

use App\Models\Solution;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSolutionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('solution_create');
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
        ];
    }
}
