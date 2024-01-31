<?php

namespace App\Http\Requests;

use App\Models\CrashPlan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCrashPlanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('crash_plan_edit');
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
            'term' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'product_number' => [
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
