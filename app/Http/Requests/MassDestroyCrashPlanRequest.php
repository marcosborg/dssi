<?php

namespace App\Http\Requests;

use App\Models\CrashPlan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCrashPlanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('crash_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:crash_plans,id',
        ];
    }
}
