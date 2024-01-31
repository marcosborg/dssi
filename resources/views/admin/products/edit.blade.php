@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="manufacturer_id">{{ trans('cruds.product.fields.manufacturer') }}</label>
                <select class="form-control select2 {{ $errors->has('manufacturer') ? 'is-invalid' : '' }}" name="manufacturer_id" id="manufacturer_id" required>
                    @foreach($manufacturers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('manufacturer_id') ? old('manufacturer_id') : $product->manufacturer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('manufacturer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('manufacturer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.manufacturer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="solution_id">{{ trans('cruds.product.fields.solution') }}</label>
                <select class="form-control select2 {{ $errors->has('solution') ? 'is-invalid' : '' }}" name="solution_id" id="solution_id" required>
                    @foreach($solutions as $id => $entry)
                        <option value="{{ $id }}" {{ (old('solution_id') ? old('solution_id') : $product->solution->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('solution'))
                    <div class="invalid-feedback">
                        {{ $errors->first('solution') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.solution_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.product.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $product->link) }}">
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="questions">{{ trans('cruds.product.fields.questions') }}</label>
                <input class="form-control {{ $errors->has('questions') ? 'is-invalid' : '' }}" type="number" name="questions" id="questions" value="{{ old('questions', $product->questions) }}" step="1">
                @if($errors->has('questions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('questions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.questions_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_1_pt">{{ trans('cruds.product.fields.question_1_pt') }}</label>
                <input class="form-control {{ $errors->has('question_1_pt') ? 'is-invalid' : '' }}" type="text" name="question_1_pt" id="question_1_pt" value="{{ old('question_1_pt', $product->question_1_pt) }}">
                @if($errors->has('question_1_pt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_1_pt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.question_1_pt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_1_en">{{ trans('cruds.product.fields.question_1_en') }}</label>
                <input class="form-control {{ $errors->has('question_1_en') ? 'is-invalid' : '' }}" type="text" name="question_1_en" id="question_1_en" value="{{ old('question_1_en', $product->question_1_en) }}">
                @if($errors->has('question_1_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_1_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.question_1_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_2_pt">{{ trans('cruds.product.fields.question_2_pt') }}</label>
                <input class="form-control {{ $errors->has('question_2_pt') ? 'is-invalid' : '' }}" type="text" name="question_2_pt" id="question_2_pt" value="{{ old('question_2_pt', $product->question_2_pt) }}">
                @if($errors->has('question_2_pt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_2_pt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.question_2_pt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_2_en">{{ trans('cruds.product.fields.question_2_en') }}</label>
                <input class="form-control {{ $errors->has('question_2_en') ? 'is-invalid' : '' }}" type="text" name="question_2_en" id="question_2_en" value="{{ old('question_2_en', $product->question_2_en) }}">
                @if($errors->has('question_2_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_2_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.question_2_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_3_pt">{{ trans('cruds.product.fields.question_3_pt') }}</label>
                <input class="form-control {{ $errors->has('question_3_pt') ? 'is-invalid' : '' }}" type="text" name="question_3_pt" id="question_3_pt" value="{{ old('question_3_pt', $product->question_3_pt) }}">
                @if($errors->has('question_3_pt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_3_pt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.question_3_pt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_3_en">{{ trans('cruds.product.fields.question_3_en') }}</label>
                <input class="form-control {{ $errors->has('question_3_en') ? 'is-invalid' : '' }}" type="text" name="question_3_en" id="question_3_en" value="{{ old('question_3_en', $product->question_3_en) }}">
                @if($errors->has('question_3_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_3_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.question_3_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_4_pt">{{ trans('cruds.product.fields.question_4_pt') }}</label>
                <input class="form-control {{ $errors->has('question_4_pt') ? 'is-invalid' : '' }}" type="text" name="question_4_pt" id="question_4_pt" value="{{ old('question_4_pt', $product->question_4_pt) }}">
                @if($errors->has('question_4_pt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_4_pt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.question_4_pt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_4_en">{{ trans('cruds.product.fields.question_4_en') }}</label>
                <input class="form-control {{ $errors->has('question_4_en') ? 'is-invalid' : '' }}" type="text" name="question_4_en" id="question_4_en" value="{{ old('question_4_en', $product->question_4_en) }}">
                @if($errors->has('question_4_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_4_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.question_4_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_5_pt">{{ trans('cruds.product.fields.question_5_pt') }}</label>
                <input class="form-control {{ $errors->has('question_5_pt') ? 'is-invalid' : '' }}" type="text" name="question_5_pt" id="question_5_pt" value="{{ old('question_5_pt', $product->question_5_pt) }}">
                @if($errors->has('question_5_pt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_5_pt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.question_5_pt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question_5_en">{{ trans('cruds.product.fields.question_5_en') }}</label>
                <input class="form-control {{ $errors->has('question_5_en') ? 'is-invalid' : '' }}" type="text" name="question_5_en" id="question_5_en" value="{{ old('question_5_en', $product->question_5_en) }}">
                @if($errors->has('question_5_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_5_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.question_5_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.product.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <div class="invalid-feedback">
                        {{ $errors->first('files') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.files_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
      uploadedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilesMap[file.name]
      }
      $('form').find('input[name="files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($product) && $product->files)
          var files =
            {!! json_encode($product->files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection