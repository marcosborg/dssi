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
            'name' => [
                'string',
                'required',
            ],
            'manufacturer_id' => [
                'required',
                'integer',
            ],
            'solution_id' => [
                'required',
                'integer',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'questions' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'question_1_pt' => [
                'string',
                'nullable',
            ],
            'question_1_en' => [
                'string',
                'nullable',
            ],
            'question_2_pt' => [
                'string',
                'nullable',
            ],
            'question_2_en' => [
                'string',
                'nullable',
            ],
            'question_3_pt' => [
                'string',
                'nullable',
            ],
            'question_3_en' => [
                'string',
                'nullable',
            ],
            'question_4_pt' => [
                'string',
                'nullable',
            ],
            'question_4_en' => [
                'string',
                'nullable',
            ],
            'question_5_pt' => [
                'string',
                'nullable',
            ],
            'question_5_en' => [
                'string',
                'nullable',
            ],
            'files' => [
                'array',
            ],
        ];
    }
}
