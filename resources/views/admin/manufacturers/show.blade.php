@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.manufacturer.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.manufacturers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manufacturer.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $manufacturer->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manufacturer.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $manufacturer->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manufacturer.fields.url') }}
                                    </th>
                                    <td>
                                        {{ $manufacturer->url }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manufacturer.fields.text_pt') }}
                                    </th>
                                    <td>
                                        {!! $manufacturer->text_pt !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manufacturer.fields.text_en') }}
                                    </th>
                                    <td>
                                        {!! $manufacturer->text_en !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.manufacturer.fields.logo') }}
                                    </th>
                                    <td>
                                        @if($manufacturer->logo)
                                            <a href="{{ $manufacturer->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $manufacturer->logo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.manufacturers.index') }}">
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