@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ubiquiti.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ubiquitis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.id') }}
                        </th>
                        <td>
                            {{ $ubiquiti->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.product') }}
                        </th>
                        <td>
                            {{ $ubiquiti->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.name') }}
                        </th>
                        <td>
                            {{ $ubiquiti->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.description') }}
                        </th>
                        <td>
                            {{ $ubiquiti->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.product_information') }}
                        </th>
                        <td>
                            {{ $ubiquiti->product_information }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.product_number') }}
                        </th>
                        <td>
                            {{ $ubiquiti->product_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.partner_mt') }}
                        </th>
                        <td>
                            {{ $ubiquiti->partner_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.pvp_mt') }}
                        </th>
                        <td>
                            {{ $ubiquiti->pvp_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.partner_kz') }}
                        </th>
                        <td>
                            {{ $ubiquiti->partner_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.pvp_kz') }}
                        </th>
                        <td>
                            {{ $ubiquiti->pvp_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.stock_mz') }}
                        </th>
                        <td>
                            {{ $ubiquiti->stock_mz->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ubiquiti.fields.stock_ao') }}
                        </th>
                        <td>
                            {{ $ubiquiti->stock_ao->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ubiquitis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection