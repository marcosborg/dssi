@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name_pt') ? 'has-error' : '' }}">
                            <label class="required" for="name_pt">{{ trans('cruds.product.fields.name_pt') }}</label>
                            <input class="form-control" type="text" name="name_pt" id="name_pt" value="{{ old('name_pt', $product->name_pt) }}" required>
                            @if($errors->has('name_pt'))
                                <span class="help-block" role="alert">{{ $errors->first('name_pt') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.name_pt_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('name_en') ? 'has-error' : '' }}">
                            <label class="required" for="name_en">{{ trans('cruds.product.fields.name_en') }}</label>
                            <input class="form-control" type="text" name="name_en" id="name_en" value="{{ old('name_en', $product->name_en) }}" required>
                            @if($errors->has('name_en'))
                                <span class="help-block" role="alert">{{ $errors->first('name_en') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.name_en_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('manufacturer') ? 'has-error' : '' }}">
                            <label class="required" for="manufacturer_id">{{ trans('cruds.product.fields.manufacturer') }}</label>
                            <select class="form-control select2" name="manufacturer_id" id="manufacturer_id" required>
                                @foreach($manufacturers as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('manufacturer_id') ? old('manufacturer_id') : $product->manufacturer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('manufacturer'))
                                <span class="help-block" role="alert">{{ $errors->first('manufacturer') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.manufacturer_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('solution') ? 'has-error' : '' }}">
                            <label for="solution_id">{{ trans('cruds.product.fields.solution') }}</label>
                            <select class="form-control select2" name="solution_id" id="solution_id">
                                @foreach($solutions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('solution_id') ? old('solution_id') : $product->solution->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('solution'))
                                <span class="help-block" role="alert">{{ $errors->first('solution') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.solution_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                            <label for="category_id">{{ trans('cruds.product.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id">
                                @foreach($categories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $product->category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <span class="help-block" role="alert">{{ $errors->first('category') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description_pt') ? 'has-error' : '' }}">
                            <label for="description_pt">{{ trans('cruds.product.fields.description_pt') }}</label>
                            <textarea class="form-control ckeditor" name="description_pt" id="description_pt">{!! old('description_pt', $product->description_pt) !!}</textarea>
                            @if($errors->has('description_pt'))
                                <span class="help-block" role="alert">{{ $errors->first('description_pt') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.description_pt_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description_en') ? 'has-error' : '' }}">
                            <label for="description_en">{{ trans('cruds.product.fields.description_en') }}</label>
                            <textarea class="form-control ckeditor" name="description_en" id="description_en">{!! old('description_en', $product->description_en) !!}</textarea>
                            @if($errors->has('description_en'))
                                <span class="help-block" role="alert">{{ $errors->first('description_en') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.description_en_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                            <label for="image">{{ trans('cruds.product.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <span class="help-block" role="alert">{{ $errors->first('image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.image_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.products.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $product->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
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
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->image)
      var file = {!! json_encode($product->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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
@endsection