@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.wasabi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.wasabis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.id') }}
                        </th>
                        <td>
                            {{ $wasabi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.product') }}
                        </th>
                        <td>
                            {{ $wasabi->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.name') }}
                        </th>
                        <td>
                            {{ $wasabi->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.tb') }}
                        </th>
                        <td>
                            {{ $wasabi->tb }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.term') }}
                        </th>
                        <td>
                            {{ $wasabi->term }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.product_number') }}
                        </th>
                        <td>
                            {{ $wasabi->product_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.description') }}
                        </th>
                        <td>
                            {{ $wasabi->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.partner_eur') }}
                        </th>
                        <td>
                            {{ $wasabi->partner_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.pvp_eur') }}
                        </th>
                        <td>
                            {{ $wasabi->pvp_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.partner_mt') }}
                        </th>
                        <td>
                            {{ $wasabi->partner_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.pvp_mt') }}
                        </th>
                        <td>
                            {{ $wasabi->pvp_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.partner_kz') }}
                        </th>
                        <td>
                            {{ $wasabi->partner_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wasabi.fields.pvp_kz') }}
                        </th>
                        <td>
                            {{ $wasabi->pvp_kz }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.wasabis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection