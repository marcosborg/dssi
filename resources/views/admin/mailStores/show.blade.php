@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mailStore.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mail-stores.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.id') }}
                        </th>
                        <td>
                            {{ $mailStore->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.product') }}
                        </th>
                        <td>
                            {{ $mailStore->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.name') }}
                        </th>
                        <td>
                            {{ $mailStore->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.term') }}
                        </th>
                        <td>
                            {{ $mailStore->term }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.from') }}
                        </th>
                        <td>
                            {{ $mailStore->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.to') }}
                        </th>
                        <td>
                            {{ $mailStore->to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.sku') }}
                        </th>
                        <td>
                            {{ $mailStore->sku }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.description') }}
                        </th>
                        <td>
                            {{ $mailStore->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.partner_eur') }}
                        </th>
                        <td>
                            {{ $mailStore->partner_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.pvp_eur') }}
                        </th>
                        <td>
                            {{ $mailStore->pvp_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.partner_mt') }}
                        </th>
                        <td>
                            {{ $mailStore->partner_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.pvp_mt') }}
                        </th>
                        <td>
                            {{ $mailStore->pvp_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.partner_kz') }}
                        </th>
                        <td>
                            {{ $mailStore->partner_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mailStore.fields.pvp_kz') }}
                        </th>
                        <td>
                            {{ $mailStore->pvp_kz }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mail-stores.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection