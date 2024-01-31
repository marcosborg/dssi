<?php

namespace App\Http\Requests;

use App\Models\Solution;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSolutionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('solution_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
