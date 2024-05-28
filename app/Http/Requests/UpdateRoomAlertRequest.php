<?php

namespace App\Http\Requests;

use App\Models\RoomAlert;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRoomAlertRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('room_alert_edit');
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
