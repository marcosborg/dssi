<?php

namespace App\Http\Requests;

use App\Models\OwnCloud;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOwnCloudRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('own_cloud_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:own_clouds,id',
        ];
    }
}
