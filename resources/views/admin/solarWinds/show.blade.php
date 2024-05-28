@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.solarWind.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.solar-winds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.id') }}
                        </th>
                        <td>
                            {{ $solarWind->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.product') }}
                        </th>
                        <td>
                            {{ $solarWind->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.name') }}
                        </th>
                        <td>
                            {{ $solarWind->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.option_1') }}
                        </th>
                        <td>
                            {{ $solarWind->option_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.option_2') }}
                        </th>
                        <td>
                            {{ $solarWind->option_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.part_number') }}
                        </th>
                        <td>
                            {{ $solarWind->part_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.description') }}
                        </th>
                        <td>
                            {{ $solarWind->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.partner_eur') }}
                        </th>
                        <td>
                            {{ $solarWind->partner_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.pvp_eur') }}
                        </th>
                        <td>
                            {{ $solarWind->pvp_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.partner_mt') }}
                        </th>
                        <td>
                            {{ $solarWind->partner_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.pvp_mt') }}
                        </th>
                        <td>
                            {{ $solarWind->pvp_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.partner_kz') }}
                        </th>
                        <td>
                            {{ $solarWind->partner_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.solarWind.fields.pvp_kz') }}
                        </th>
                        <td>
                            {{ $solarWind->pvp_kz }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.solar-winds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection