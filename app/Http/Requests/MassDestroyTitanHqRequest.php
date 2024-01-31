<?php

namespace App\Http\Requests;

use App\Models\TitanHq;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTitanHqRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('titan_hq_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:titan_hqs,id',
        ];
    }
}
