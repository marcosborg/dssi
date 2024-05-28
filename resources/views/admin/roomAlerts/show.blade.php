@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.roomAlert.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.room-alerts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.id') }}
                        </th>
                        <td>
                            {{ $roomAlert->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.product') }}
                        </th>
                        <td>
                            {{ $roomAlert->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.name') }}
                        </th>
                        <td>
                            {{ $roomAlert->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.description') }}
                        </th>
                        <td>
                            {{ $roomAlert->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.product_information') }}
                        </th>
                        <td>
                            {{ $roomAlert->product_information }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.part_number') }}
                        </th>
                        <td>
                            {{ $roomAlert->part_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.partner_mt') }}
                        </th>
                        <td>
                            {{ $roomAlert->partner_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.pvp_mt') }}
                        </th>
                        <td>
                            {{ $roomAlert->pvp_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.partner_kz') }}
                        </th>
                        <td>
                            {{ $roomAlert->partner_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.pvp_kz') }}
                        </th>
                        <td>
                            {{ $roomAlert->pvp_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.stock_mz') }}
                        </th>
                        <td>
                            {{ $roomAlert->stock_mz->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.roomAlert.fields.stock_ao') }}
                        </th>
                        <td>
                            {{ $roomAlert->stock_ao->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.room-alerts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection