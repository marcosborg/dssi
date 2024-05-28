<?php

namespace App\Http\Requests;

use App\Models\SolarWind;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySolarWindRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('solar_wind_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:solar_winds,id',
        ];
    }
}
