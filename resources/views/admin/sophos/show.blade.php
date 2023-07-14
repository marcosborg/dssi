@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.sopho.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.sophos.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $sopho->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.product') }}
                                    </th>
                                    <td>
                                        {{ $sopho->product->name_pt ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.family') }}
                                    </th>
                                    <td>
                                        {{ $sopho->family }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.type') }}
                                    </th>
                                    <td>
                                        {{ $sopho->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.term') }}
                                    </th>
                                    <td>
                                        {{ $sopho->term }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $sopho->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.min') }}
                                    </th>
                                    <td>
                                        {{ $sopho->min }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.max') }}
                                    </th>
                                    <td>
                                        {{ $sopho->max }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.price_partner_met') }}
                                    </th>
                                    <td>
                                        {{ $sopho->price_partner_met }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.pvp_met') }}
                                    </th>
                                    <td>
                                        {{ $sopho->pvp_met }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.price_partner_kwa') }}
                                    </th>
                                    <td>
                                        {{ $sopho->price_partner_kwa }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sopho.fields.pvp_kwa') }}
                                    </th>
                                    <td>
                                        {{ $sopho->pvp_kwa }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.sophos.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection