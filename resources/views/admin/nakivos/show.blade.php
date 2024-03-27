@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.nakivo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nakivos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.id') }}
                        </th>
                        <td>
                            {{ $nakivo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.product') }}
                        </th>
                        <td>
                            {{ $nakivo->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.name') }}
                        </th>
                        <td>
                            {{ $nakivo->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.option_1') }}
                        </th>
                        <td>
                            {{ $nakivo->option_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.option_2') }}
                        </th>
                        <td>
                            {{ $nakivo->option_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.part_number') }}
                        </th>
                        <td>
                            {{ $nakivo->part_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.description') }}
                        </th>
                        <td>
                            {{ $nakivo->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.partner_eur') }}
                        </th>
                        <td>
                            {{ $nakivo->partner_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.pvp_eur') }}
                        </th>
                        <td>
                            {{ $nakivo->pvp_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.partner_mt') }}
                        </th>
                        <td>
                            {{ $nakivo->partner_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.pvp_mt') }}
                        </th>
                        <td>
                            {{ $nakivo->pvp_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.partner_kz') }}
                        </th>
                        <td>
                            {{ $nakivo->partner_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nakivo.fields.pvp_kz') }}
                        </th>
                        <td>
                            {{ $nakivo->pvp_kz }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nakivos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection