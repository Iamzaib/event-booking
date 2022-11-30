@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.events.update", [$event->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="event_title">{{ trans('cruds.event.fields.event_title') }}</label>
                            <input class="form-control" type="text" name="event_title" id="event_title" value="{{ old('event_title', $event->event_title) }}" required>
                            @if($errors->has('event_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.event_title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="overview">{{ trans('cruds.event.fields.overview') }}</label>
                            <textarea class="form-control ckeditor" name="overview" id="overview">{!! old('overview', $event->overview) !!}</textarea>
                            @if($errors->has('overview'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('overview') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.overview_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="duration">{{ trans('cruds.event.fields.duration') }}</label>
                            <input class="form-control" type="text" name="duration" id="duration" value="{{ old('duration', $event->duration) }}">
                            @if($errors->has('duration'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('duration') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.duration_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="daily_price">{{ trans('cruds.event.fields.daily_price') }}</label>
                            <input class="form-control" type="number" name="daily_price" id="daily_price" value="{{ old('daily_price', $event->daily_price) }}" step="0.01" required>
                            @if($errors->has('daily_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('daily_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.daily_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="featured_image">{{ trans('cruds.event.fields.featured_image') }}</label>
                            <div class="needsclick dropzone" id="featured_image-dropzone">
                            </div>
                            @if($errors->has('featured_image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('featured_image') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.featured_image_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="information">{{ trans('cruds.event.fields.information') }}</label>
                            <textarea class="form-control ckeditor" name="information" id="information">{!! old('information', $event->information) !!}</textarea>
                            @if($errors->has('information'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('information') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.information_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="country_id">{{ trans('cruds.event.fields.country') }}</label>
                            <select class="form-control select2" name="country_id" id="country_id" required>
                                @foreach($countries as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $event->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('country') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="state_id">{{ trans('cruds.event.fields.state') }}</label>
                            <select class="form-control select2" name="state_id" id="state_id" required>
                                @foreach($states as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('state_id') ? old('state_id') : $event->state->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('state') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.state_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="city_id">{{ trans('cruds.event.fields.city') }}</label>
                            <select class="form-control select2" name="city_id" id="city_id" required>
                                @foreach($cities as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $event->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="event_start">{{ trans('cruds.event.fields.event_start') }}</label>
                            <input class="form-control date" type="text" name="event_start" id="event_start" value="{{ old('event_start', $event->event_start) }}" required>
                            @if($errors->has('event_start'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_start') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.event_start_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="event_end">{{ trans('cruds.event.fields.event_end') }}</label>
                            <input class="form-control date" type="text" name="event_end" id="event_end" value="{{ old('event_end', $event->event_end) }}" required>
                            @if($errors->has('event_end'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_end') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.event_end_helper') }}</span>
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
                xhr.open('POST', '{{ route('frontend.events.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $event->id ?? 0 }}');
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
    Dropzone.options.featuredImageDropzone = {
    url: '{{ route('frontend.events.storeMedia') }}',
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
      $('form').find('input[name="featured_image"]').remove()
      $('form').append('<input type="hidden" name="featured_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="featured_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($event) && $event->featured_image)
      var file = {!! json_encode($event->featured_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="featured_image" value="' + file.file_name + '">')
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