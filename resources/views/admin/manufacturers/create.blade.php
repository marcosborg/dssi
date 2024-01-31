@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.manufacturer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.manufacturers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.manufacturer.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manufacturer.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.manufacturer.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', '') }}">
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manufacturer.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">{{ trans('cruds.manufacturer.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manufacturer.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.manufacturer.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <div class="invalid-feedback">
                        {{ $errors->first('files') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manufacturer.fields.files_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('pt') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="pt" value="0">
                    <input class="form-check-input" type="checkbox" name="pt" id="pt" value="1" {{ old('pt', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="pt">{{ trans('cruds.manufacturer.fields.pt') }}</label>
                </div>
                @if($errors->has('pt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manufacturer.fields.pt_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('mz') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="mz" value="0">
                    <input class="form-check-input" type="checkbox" name="mz" id="mz" value="1" {{ old('mz', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="mz">{{ trans('cruds.manufacturer.fields.mz') }}</label>
                </div>
                @if($errors->has('mz'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mz') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manufacturer.fields.mz_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('ao') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="ao" value="0">
                    <input class="form-check-input" type="checkbox" name="ao" id="ao" value="1" {{ old('ao', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="ao">{{ trans('cruds.manufacturer.fields.ao') }}</label>
                </div>
                @if($errors->has('ao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.manufacturer.fields.ao_helper') }}</span>
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
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.manufacturers.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($manufacturer) && $manufacturer->logo)
      var file = {!! json_encode($manufacturer->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
<script>
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.manufacturers.storeMedia') }}',
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
@if(isset($manufacturer) && $manufacturer->files)
          var files =
            {!! json_encode($manufacturer->files) !!}
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