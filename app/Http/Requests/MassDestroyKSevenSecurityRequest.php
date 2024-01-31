<?php

namespace App\Http\Requests;

use App\Models\KSevenSecurity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyKSevenSecurityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('k_seven_security_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:k_seven_securities,id',
        ];
    }
}
