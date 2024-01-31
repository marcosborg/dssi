@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ownCloud.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.own-clouds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.id') }}
                        </th>
                        <td>
                            {{ $ownCloud->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.product') }}
                        </th>
                        <td>
                            {{ $ownCloud->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.name') }}
                        </th>
                        <td>
                            {{ $ownCloud->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.term') }}
                        </th>
                        <td>
                            {{ $ownCloud->term }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.from') }}
                        </th>
                        <td>
                            {{ $ownCloud->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.to') }}
                        </th>
                        <td>
                            {{ $ownCloud->to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.product_number') }}
                        </th>
                        <td>
                            {{ $ownCloud->product_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.description') }}
                        </th>
                        <td>
                            {{ $ownCloud->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.partner_eur') }}
                        </th>
                        <td>
                            {{ $ownCloud->partner_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.pvp_eur') }}
                        </th>
                        <td>
                            {{ $ownCloud->pvp_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.partner_mt') }}
                        </th>
                        <td>
                            {{ $ownCloud->partner_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.pvp_mt') }}
                        </th>
                        <td>
                            {{ $ownCloud->pvp_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.partner_kz') }}
                        </th>
                        <td>
                            {{ $ownCloud->partner_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ownCloud.fields.pvp_kz') }}
                        </th>
                        <td>
                            {{ $ownCloud->pvp_kz }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.own-clouds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection