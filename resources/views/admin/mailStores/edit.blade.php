@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.mailStore.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mail-stores.update", [$mailStore->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.mailStore.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $mailStore->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.mailStore.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $mailStore->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="term">{{ trans('cruds.mailStore.fields.term') }}</label>
                <input class="form-control {{ $errors->has('term') ? 'is-invalid' : '' }}" type="number" name="term" id="term" value="{{ old('term', $mailStore->term) }}" step="1">
                @if($errors->has('term'))
                    <div class="invalid-feedback">
                        {{ $errors->first('term') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.term_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="from">{{ trans('cruds.mailStore.fields.from') }}</label>
                <input class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}" type="number" name="from" id="from" value="{{ old('from', $mailStore->from) }}" step="1">
                @if($errors->has('from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="to">{{ trans('cruds.mailStore.fields.to') }}</label>
                <input class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}" type="number" name="to" id="to" value="{{ old('to', $mailStore->to) }}" step="1">
                @if($errors->has('to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="part_number">{{ trans('cruds.mailStore.fields.part_number') }}</label>
                <input class="form-control {{ $errors->has('part_number') ? 'is-invalid' : '' }}" type="text" name="part_number" id="part_number" value="{{ old('part_number', $mailStore->part_number) }}">
                @if($errors->has('part_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('part_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.part_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.mailStore.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $mailStore->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_eur">{{ trans('cruds.mailStore.fields.partner_eur') }}</label>
                <input class="form-control {{ $errors->has('partner_eur') ? 'is-invalid' : '' }}" type="number" name="partner_eur" id="partner_eur" value="{{ old('partner_eur', $mailStore->partner_eur) }}" step="0.01">
                @if($errors->has('partner_eur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_eur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.partner_eur_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_eur">{{ trans('cruds.mailStore.fields.pvp_eur') }}</label>
                <input class="form-control {{ $errors->has('pvp_eur') ? 'is-invalid' : '' }}" type="number" name="pvp_eur" id="pvp_eur" value="{{ old('pvp_eur', $mailStore->pvp_eur) }}" step="0.01">
                @if($errors->has('pvp_eur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_eur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.pvp_eur_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_mt">{{ trans('cruds.mailStore.fields.partner_mt') }}</label>
                <input class="form-control {{ $errors->has('partner_mt') ? 'is-invalid' : '' }}" type="number" name="partner_mt" id="partner_mt" value="{{ old('partner_mt', $mailStore->partner_mt) }}" step="0.01">
                @if($errors->has('partner_mt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_mt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.partner_mt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_mt">{{ trans('cruds.mailStore.fields.pvp_mt') }}</label>
                <input class="form-control {{ $errors->has('pvp_mt') ? 'is-invalid' : '' }}" type="number" name="pvp_mt" id="pvp_mt" value="{{ old('pvp_mt', $mailStore->pvp_mt) }}" step="0.01">
                @if($errors->has('pvp_mt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_mt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.pvp_mt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="partner_kz">{{ trans('cruds.mailStore.fields.partner_kz') }}</label>
                <input class="form-control {{ $errors->has('partner_kz') ? 'is-invalid' : '' }}" type="number" name="partner_kz" id="partner_kz" value="{{ old('partner_kz', $mailStore->partner_kz) }}" step="0.01">
                @if($errors->has('partner_kz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('partner_kz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.partner_kz_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pvp_kz">{{ trans('cruds.mailStore.fields.pvp_kz') }}</label>
                <input class="form-control {{ $errors->has('pvp_kz') ? 'is-invalid' : '' }}" type="number" name="pvp_kz" id="pvp_kz" value="{{ old('pvp_kz', $mailStore->pvp_kz) }}" step="0.01">
                @if($errors->has('pvp_kz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pvp_kz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mailStore.fields.pvp_kz_helper') }}</span>
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