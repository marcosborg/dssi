@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.solution.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.solutions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.solution.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $solution->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.solution.fields.name_pt') }}
                                    </th>
                                    <td>
                                        {{ $solution->name_pt }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.solution.fields.name_en') }}
                                    </th>
                                    <td>
                                        {{ $solution->name_en }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.solution.fields.description_pt') }}
                                    </th>
                                    <td>
                                        {!! $solution->description_pt !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.solution.fields.description_en') }}
                                    </th>
                                    <td>
                                        {!! $solution->description_en !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.solution.fields.image') }}
                                    </th>
                                    <td>
                                        @if($solution->image)
                                            <a href="{{ $solution->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $solution->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.solutions.index') }}">
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