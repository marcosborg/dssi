@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.roomAlert.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.room-alerts.update", [$roomAlert->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.roomAlert.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $roomAlert->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.roomAlert.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.roomAlert.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $roomAlert->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.roomAlert.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.roomAlert.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $roomAlert->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.roomAlert.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_information">{{ trans('cruds.roomAlert.fields.product_information') }}</label>
                <textarea class="form-control {{ $errors->has('product_information') ? 'is-invalid' : '' }}" name="product_information" id="product_information">{{ old('product_information', $roomAlert->product_information) }}</textarea>
                @if($errors->has('product_information'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_information') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.roomAlert.fields.product_information_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="part_number">{{ trans('cruds.roomAlert.fields.part_number') }}</label>
                <input class="form-control {{ $errors->has('part_number') ? 'is-invalid' : '' }}" type="text" name="part_number" id="part_number" value="{{ old('part_number', $roomAlert->part_number) }}">
                @if($errors->has('part_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('part_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.roomAlert.fields.part_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_mt">{{ trans('cruds.roomAlert.fields.partner_mt') }}</label>
                <input class="form-control {{ $errors->has('partner_mt') ? 'is-invalid' : '' }}" type="number" name="partner_mt" id="partner_mt" value="{{ old('partner_mt', $roomAlert->partner_mt) }}" step="0.01">
                @if($errors->has('partner_mt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_mt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.roomAlert.fields.partner_mt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_mt">{{ trans('cruds.roomAlert.fields.pvp_mt') }}</label>
                <input class="form-control {{ $errors->has('pvp_mt') ? 'is-invalid' : '' }}" type="number" name="pvp_mt" id="pvp_mt" value="{{ old('pvp_mt', $roomAlert->pvp_mt) }}" step="0.01">
                @if($errors->has('pvp_mt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_mt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.roomAlert.fields.pvp_mt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_kz">{{ trans('cruds.roomAlert.fields.partner_kz') }}</label>
                <input class="form-control {{ $errors->has('partner_kz') ? 'is-invalid' : '' }}" type="number" name="partner_kz" id="partner_kz" value="{{ old('partner_kz', $roomAlert->partner_kz) }}" step="0.01">
                @if($errors->has('partner_kz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_kz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.roomAlert.fields.partner_kz_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_kz">{{ trans('cruds.roomAlert.fields.pvp_kz') }}</label>
                <input class="form-control {{ $errors->has('pvp_kz') ? 'is-invalid' : '' }}" type="number" name="pvp_kz" id="pvp_kz" value="{{ old('pvp_kz', $roomAlert->pvp_kz) }}" step="0.01">
                @if($errors->has('pvp_kz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_kz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.roomAlert.fields.pvp_kz_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="stock_mz_id">{{ trans('cruds.roomAlert.fields.stock_mz') }}</label>
                <select class="form-control select2 {{ $errors->has('stock_mz') ? 'is-invalid' : '' }}" name="stock_mz_id" id="stock_mz_id">
                    @foreach($stock_mzs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('stock_mz_id') ? old('stock_mz_id') : $roomAlert->stock_mz->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('stock_mz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stock_mz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.roomAlert.fields.stock_mz_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="stock_ao_id">{{ trans('cruds.roomAlert.fields.stock_ao') }}</label>
                <select class="form-control select2 {{ $errors->has('stock_ao') ? 'is-invalid' : '' }}" name="stock_ao_id" id="stock_ao_id">
                    @foreach($stock_aos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('stock_ao_id') ? old('stock_ao_id') : $roomAlert->stock_ao->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('stock_ao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stock_ao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.roomAlert.fields.stock_ao_helper') }}</span>
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