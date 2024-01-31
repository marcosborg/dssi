@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.manufacturer.title') }}
    </div>

    <div class="card-body">
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
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.files') }}
                        </th>
                        <td>
                            @foreach($manufacturer->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.pt') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $manufacturer->pt ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.mz') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $manufacturer->mz ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.manufacturer.fields.ao') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $manufacturer->ao ? 'checked' : '' }}>
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



@endsection