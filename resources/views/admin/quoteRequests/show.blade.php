@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.quoteRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.quote-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.quoteRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $quoteRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quoteRequest.fields.user') }}
                        </th>
                        <td>
                            {{ $quoteRequest->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quoteRequest.fields.product') }}
                        </th>
                        <td>
                            {{ $quoteRequest->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quoteRequest.fields.quote') }}
                        </th>
                        <td>
                            {{ $quoteRequest->quote }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quoteRequest.fields.data') }}
                        </th>
                        <td>
                            {{ $quoteRequest->data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quoteRequest.fields.comments') }}
                        </th>
                        <td>
                            {!! $quoteRequest->comments !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quoteRequest.fields.checked') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $quoteRequest->checked ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quoteRequest.fields.created_at') }}
                        </th>
                        <td>
                            {{ $quoteRequest->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.quote-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection