@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.solution.title') }}
    </div>

    <div class="card-body">
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
                            {{ trans('cruds.solution.fields.name') }}
                        </th>
                        <td>
                            {{ $solution->name }}
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



@endsection