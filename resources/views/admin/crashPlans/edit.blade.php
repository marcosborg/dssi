@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.crashPlan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.crash-plans.update", [$crashPlan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.crashPlan.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $crashPlan->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.crashPlan.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $crashPlan->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="from">{{ trans('cruds.crashPlan.fields.from') }}</label>
                <input class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}" type="number" name="from" id="from" value="{{ old('from', $crashPlan->from) }}" step="1">
                @if($errors->has('from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="to">{{ trans('cruds.crashPlan.fields.to') }}</label>
                <input class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}" type="number" name="to" id="to" value="{{ old('to', $crashPlan->to) }}" step="1">
                @if($errors->has('to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="term">{{ trans('cruds.crashPlan.fields.term') }}</label>
                <input class="form-control {{ $errors->has('term') ? 'is-invalid' : '' }}" type="number" name="term" id="term" value="{{ old('term', $crashPlan->term) }}" step="1">
                @if($errors->has('term'))
                    <div class="invalid-feedback">
                        {{ $errors->first('term') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.term_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_number">{{ trans('cruds.crashPlan.fields.product_number') }}</label>
                <input class="form-control {{ $errors->has('product_number') ? 'is-invalid' : '' }}" type="text" name="product_number" id="product_number" value="{{ old('product_number', $crashPlan->product_number) }}">
                @if($errors->has('product_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.product_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.crashPlan.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $crashPlan->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_eur">{{ trans('cruds.crashPlan.fields.partner_eur') }}</label>
                <input class="form-control {{ $errors->has('partner_eur') ? 'is-invalid' : '' }}" type="number" name="partner_eur" id="partner_eur" value="{{ old('partner_eur', $crashPlan->partner_eur) }}" step="0.01">
                @if($errors->has('partner_eur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_eur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.partner_eur_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_eur">{{ trans('cruds.crashPlan.fields.pvp_eur') }}</label>
                <input class="form-control {{ $errors->has('pvp_eur') ? 'is-invalid' : '' }}" type="number" name="pvp_eur" id="pvp_eur" value="{{ old('pvp_eur', $crashPlan->pvp_eur) }}" step="0.01">
                @if($errors->has('pvp_eur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_eur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.pvp_eur_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_mt">{{ trans('cruds.crashPlan.fields.partner_mt') }}</label>
                <input class="form-control {{ $errors->has('partner_mt') ? 'is-invalid' : '' }}" type="number" name="partner_mt" id="partner_mt" value="{{ old('partner_mt', $crashPlan->partner_mt) }}" step="0.01">
                @if($errors->has('partner_mt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_mt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.partner_mt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_mt">{{ trans('cruds.crashPlan.fields.pvp_mt') }}</label>
                <input class="form-control {{ $errors->has('pvp_mt') ? 'is-invalid' : '' }}" type="number" name="pvp_mt" id="pvp_mt" value="{{ old('pvp_mt', $crashPlan->pvp_mt) }}" step="0.01">
                @if($errors->has('pvp_mt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_mt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.pvp_mt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_kz">{{ trans('cruds.crashPlan.fields.partner_kz') }}</label>
                <input class="form-control {{ $errors->has('partner_kz') ? 'is-invalid' : '' }}" type="number" name="partner_kz" id="partner_kz" value="{{ old('partner_kz', $crashPlan->partner_kz) }}" step="0.01">
                @if($errors->has('partner_kz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_kz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.partner_kz_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_kz">{{ trans('cruds.crashPlan.fields.pvp_kz') }}</label>
                <input class="form-control {{ $errors->has('pvp_kz') ? 'is-invalid' : '' }}" type="number" name="pvp_kz" id="pvp_kz" value="{{ old('pvp_kz', $crashPlan->pvp_kz) }}" step="0.01">
                @if($errors->has('pvp_kz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_kz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.crashPlan.fields.pvp_kz_helper') }}</span>
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