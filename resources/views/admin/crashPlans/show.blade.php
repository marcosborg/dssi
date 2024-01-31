@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.crashPlan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crash-plans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.id') }}
                        </th>
                        <td>
                            {{ $crashPlan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.product') }}
                        </th>
                        <td>
                            {{ $crashPlan->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.name') }}
                        </th>
                        <td>
                            {{ $crashPlan->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.from') }}
                        </th>
                        <td>
                            {{ $crashPlan->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.to') }}
                        </th>
                        <td>
                            {{ $crashPlan->to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.term') }}
                        </th>
                        <td>
                            {{ $crashPlan->term }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.product_number') }}
                        </th>
                        <td>
                            {{ $crashPlan->product_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.description') }}
                        </th>
                        <td>
                            {{ $crashPlan->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.partner_eur') }}
                        </th>
                        <td>
                            {{ $crashPlan->partner_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.pvp_eur') }}
                        </th>
                        <td>
                            {{ $crashPlan->pvp_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.partner_mt') }}
                        </th>
                        <td>
                            {{ $crashPlan->partner_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.pvp_mt') }}
                        </th>
                        <td>
                            {{ $crashPlan->pvp_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.partner_kz') }}
                        </th>
                        <td>
                            {{ $crashPlan->partner_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.crashPlan.fields.pvp_kz') }}
                        </th>
                        <td>
                            {{ $crashPlan->pvp_kz }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.crash-plans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection