@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kSevenSecurity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.k-seven-securities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.id') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.product') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.name') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.term') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->term }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.from') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.to') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.part_number') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->part_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.description') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.partner_eur') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->partner_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.pvp_eur') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->pvp_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.partner_mt') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->partner_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.pvp_mt') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->pvp_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.partner_kz') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->partner_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kSevenSecurity.fields.pvp_kz') }}
                        </th>
                        <td>
                            {{ $kSevenSecurity->pvp_kz }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.k-seven-securities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection