<?php

namespace App\Http\Requests;

use App\Models\RoomAlert;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRoomAlertRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('room_alert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:room_alerts,id',
        ];
    }
}
