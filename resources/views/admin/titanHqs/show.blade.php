@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.titanHq.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.titan-hqs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.id') }}
                        </th>
                        <td>
                            {{ $titanHq->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.product') }}
                        </th>
                        <td>
                            {{ $titanHq->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.name') }}
                        </th>
                        <td>
                            {{ $titanHq->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.term') }}
                        </th>
                        <td>
                            {{ $titanHq->term }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.from') }}
                        </th>
                        <td>
                            {{ $titanHq->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.to') }}
                        </th>
                        <td>
                            {{ $titanHq->to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.part_number') }}
                        </th>
                        <td>
                            {{ $titanHq->part_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.description') }}
                        </th>
                        <td>
                            {{ $titanHq->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.partner_eur') }}
                        </th>
                        <td>
                            {{ $titanHq->partner_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.pvp_eur') }}
                        </th>
                        <td>
                            {{ $titanHq->pvp_eur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.partner_mt') }}
                        </th>
                        <td>
                            {{ $titanHq->partner_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.pvp_mt') }}
                        </th>
                        <td>
                            {{ $titanHq->pvp_mt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.partner_kz') }}
                        </th>
                        <td>
                            {{ $titanHq->partner_kz }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.titanHq.fields.pvp_kz') }}
                        </th>
                        <td>
                            {{ $titanHq->pvp_kz }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.titan-hqs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection