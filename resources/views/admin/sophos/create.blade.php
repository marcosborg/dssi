@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.sopho.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.sophos.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('product') ? 'has-error' : '' }}">
                            <label class="required" for="product_id">{{ trans('cruds.sopho.fields.product') }}</label>
                            <select class="form-control select2" name="product_id" id="product_id" required>
                                @foreach($products as $id => $entry)
                                    <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product'))
                                <span class="help-block" role="alert">{{ $errors->first('product') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.sopho.fields.product_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('family') ? 'has-error' : '' }}">
                            <label for="family">{{ trans('cruds.sopho.fields.family') }}</label>
                            <input class="form-control" type="text" name="family" id="family" value="{{ old('family', '') }}">
                            @if($errors->has('family'))
                                <span class="help-block" role="alert">{{ $errors->first('family') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.sopho.fields.family_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label for="type">{{ trans('cruds.sopho.fields.type') }}</label>
                            <input class="form-control" type="text" name="type" id="type" value="{{ old('type', '') }}">
                            @if($errors->has('type'))
                                <span class="help-block" role="alert">{{ $errors->first('type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.sopho.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('term') ? 'has-error' : '' }}">
                            <label for="term">{{ trans('cruds.sopho.fields.term') }}</label>
                            <input class="form-control" type="number" name="term" id="term" value="{{ old('term', '') }}" step="1">
                            @if($errors->has('term'))
                                <span class="help-block" role="alert">{{ $errors->first('term') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.sopho.fields.term_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.sopho.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.sopho.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('min') ? 'has-error' : '' }}">
                            <label for="min">{{ trans('cruds.sopho.fields.min') }}</label>
                            <input class="form-control" type="number" name="min" id="min" value="{{ old('min', '') }}" step="1">
                            @if($errors->has('min'))
                                <span class="help-block" role="alert">{{ $errors->first('min') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.sopho.fields.min_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('max') ? 'has-error' : '' }}">
                            <label for="max">{{ trans('cruds.sopho.fields.max') }}</label>
                            <input class="form-control" type="number" name="max" id="max" value="{{ old('max', '') }}" step="1">
                            @if($errors->has('max'))
                                <span class="help-block" role="alert">{{ $errors->first('max') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.sopho.fields.max_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('price_partner_met') ? 'has-error' : '' }}">
                            <label for="price_partner_met">{{ trans('cruds.sopho.fields.price_partner_met') }}</label>
                            <input class="form-control" type="number" name="price_partner_met" id="price_partner_met" value="{{ old('price_partner_met', '') }}" step="0.01">
                            @if($errors->has('price_partner_met'))
                                <span class="help-block" role="alert">{{ $errors->first('price_partner_met') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.sopho.fields.price_partner_met_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('pvp_met') ? 'has-error' : '' }}">
                            <label for="pvp_met">{{ trans('cruds.sopho.fields.pvp_met') }}</label>
                            <input class="form-control" type="number" name="pvp_met" id="pvp_met" value="{{ old('pvp_met', '') }}" step="0.01">
                            @if($errors->has('pvp_met'))
                                <span class="help-block" role="alert">{{ $errors->first('pvp_met') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.sopho.fields.pvp_met_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('price_partner_kwa') ? 'has-error' : '' }}">
                            <label for="price_partner_kwa">{{ trans('cruds.sopho.fields.price_partner_kwa') }}</label>
                            <input class="form-control" type="number" name="price_partner_kwa" id="price_partner_kwa" value="{{ old('price_partner_kwa', '') }}" step="0.01">
                            @if($errors->has('price_partner_kwa'))
                                <span class="help-block" role="alert">{{ $errors->first('price_partner_kwa') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.sopho.fields.price_partner_kwa_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('pvp_kwa') ? 'has-error' : '' }}">
                            <label for="pvp_kwa">{{ trans('cruds.sopho.fields.pvp_kwa') }}</label>
                            <input class="form-control" type="number" name="pvp_kwa" id="pvp_kwa" value="{{ old('pvp_kwa', '') }}" step="0.01">
                            @if($errors->has('pvp_kwa'))
                                <span class="help-block" role="alert">{{ $errors->first('pvp_kwa') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.sopho.fields.pvp_kwa_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection