@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.ubiquiti.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ubiquitis.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.ubiquiti.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ubiquiti.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.ubiquiti.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ubiquiti.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.ubiquiti.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ubiquiti.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_information">{{ trans('cruds.ubiquiti.fields.product_information') }}</label>
                <textarea class="form-control {{ $errors->has('product_information') ? 'is-invalid' : '' }}" name="product_information" id="product_information">{{ old('product_information') }}</textarea>
                @if($errors->has('product_information'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_information') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ubiquiti.fields.product_information_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_number">{{ trans('cruds.ubiquiti.fields.product_number') }}</label>
                <input class="form-control {{ $errors->has('product_number') ? 'is-invalid' : '' }}" type="text" name="product_number" id="product_number" value="{{ old('product_number', '') }}">
                @if($errors->has('product_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ubiquiti.fields.product_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_mt">{{ trans('cruds.ubiquiti.fields.partner_mt') }}</label>
                <input class="form-control {{ $errors->has('partner_mt') ? 'is-invalid' : '' }}" type="number" name="partner_mt" id="partner_mt" value="{{ old('partner_mt', '') }}" step="0.01">
                @if($errors->has('partner_mt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_mt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ubiquiti.fields.partner_mt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_mt">{{ trans('cruds.ubiquiti.fields.pvp_mt') }}</label>
                <input class="form-control {{ $errors->has('pvp_mt') ? 'is-invalid' : '' }}" type="number" name="pvp_mt" id="pvp_mt" value="{{ old('pvp_mt', '') }}" step="0.01">
                @if($errors->has('pvp_mt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_mt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ubiquiti.fields.pvp_mt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_kz">{{ trans('cruds.ubiquiti.fields.partner_kz') }}</label>
                <input class="form-control {{ $errors->has('partner_kz') ? 'is-invalid' : '' }}" type="number" name="partner_kz" id="partner_kz" value="{{ old('partner_kz', '') }}" step="0.01">
                @if($errors->has('partner_kz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_kz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ubiquiti.fields.partner_kz_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_kz">{{ trans('cruds.ubiquiti.fields.pvp_kz') }}</label>
                <input class="form-control {{ $errors->has('pvp_kz') ? 'is-invalid' : '' }}" type="number" name="pvp_kz" id="pvp_kz" value="{{ old('pvp_kz', '') }}" step="0.01">
                @if($errors->has('pvp_kz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_kz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ubiquiti.fields.pvp_kz_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="stock_mz_id">{{ trans('cruds.ubiquiti.fields.stock_mz') }}</label>
                <select class="form-control select2 {{ $errors->has('stock_mz') ? 'is-invalid' : '' }}" name="stock_mz_id" id="stock_mz_id">
                    @foreach($stock_mzs as $id => $entry)
                        <option value="{{ $id }}" {{ old('stock_mz_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('stock_mz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stock_mz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ubiquiti.fields.stock_mz_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="stock_ao_id">{{ trans('cruds.ubiquiti.fields.stock_ao') }}</label>
                <select class="form-control select2 {{ $errors->has('stock_ao') ? 'is-invalid' : '' }}" name="stock_ao_id" id="stock_ao_id">
                    @foreach($stock_aos as $id => $entry)
                        <option value="{{ $id }}" {{ old('stock_ao_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('stock_ao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stock_ao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ubiquiti.fields.stock_ao_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection