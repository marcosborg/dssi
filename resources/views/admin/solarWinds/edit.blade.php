@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.solarWind.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.solar-winds.update", [$solarWind->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.solarWind.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $solarWind->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.solarWind.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $solarWind->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="option_1">{{ trans('cruds.solarWind.fields.option_1') }}</label>
                <input class="form-control {{ $errors->has('option_1') ? 'is-invalid' : '' }}" type="text" name="option_1" id="option_1" value="{{ old('option_1', $solarWind->option_1) }}">
                @if($errors->has('option_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('option_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.option_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="option_2">{{ trans('cruds.solarWind.fields.option_2') }}</label>
                <input class="form-control {{ $errors->has('option_2') ? 'is-invalid' : '' }}" type="text" name="option_2" id="option_2" value="{{ old('option_2', $solarWind->option_2) }}">
                @if($errors->has('option_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('option_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.option_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="part_number">{{ trans('cruds.solarWind.fields.part_number') }}</label>
                <input class="form-control {{ $errors->has('part_number') ? 'is-invalid' : '' }}" type="text" name="part_number" id="part_number" value="{{ old('part_number', $solarWind->part_number) }}">
                @if($errors->has('part_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('part_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.part_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.solarWind.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $solarWind->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_eur">{{ trans('cruds.solarWind.fields.partner_eur') }}</label>
                <input class="form-control {{ $errors->has('partner_eur') ? 'is-invalid' : '' }}" type="number" name="partner_eur" id="partner_eur" value="{{ old('partner_eur', $solarWind->partner_eur) }}" step="0.01">
                @if($errors->has('partner_eur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_eur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.partner_eur_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_eur">{{ trans('cruds.solarWind.fields.pvp_eur') }}</label>
                <input class="form-control {{ $errors->has('pvp_eur') ? 'is-invalid' : '' }}" type="number" name="pvp_eur" id="pvp_eur" value="{{ old('pvp_eur', $solarWind->pvp_eur) }}" step="0.01">
                @if($errors->has('pvp_eur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_eur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.pvp_eur_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_mt">{{ trans('cruds.solarWind.fields.partner_mt') }}</label>
                <input class="form-control {{ $errors->has('partner_mt') ? 'is-invalid' : '' }}" type="number" name="partner_mt" id="partner_mt" value="{{ old('partner_mt', $solarWind->partner_mt) }}" step="0.01">
                @if($errors->has('partner_mt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_mt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.partner_mt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_mt">{{ trans('cruds.solarWind.fields.pvp_mt') }}</label>
                <input class="form-control {{ $errors->has('pvp_mt') ? 'is-invalid' : '' }}" type="number" name="pvp_mt" id="pvp_mt" value="{{ old('pvp_mt', $solarWind->pvp_mt) }}" step="0.01">
                @if($errors->has('pvp_mt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_mt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.pvp_mt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_kz">{{ trans('cruds.solarWind.fields.partner_kz') }}</label>
                <input class="form-control {{ $errors->has('partner_kz') ? 'is-invalid' : '' }}" type="number" name="partner_kz" id="partner_kz" value="{{ old('partner_kz', $solarWind->partner_kz) }}" step="0.01">
                @if($errors->has('partner_kz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_kz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.partner_kz_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_kz">{{ trans('cruds.solarWind.fields.pvp_kz') }}</label>
                <input class="form-control {{ $errors->has('pvp_kz') ? 'is-invalid' : '' }}" type="number" name="pvp_kz" id="pvp_kz" value="{{ old('pvp_kz', $solarWind->pvp_kz) }}" step="0.01">
                @if($errors->has('pvp_kz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_kz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.solarWind.fields.pvp_kz_helper') }}</span>
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