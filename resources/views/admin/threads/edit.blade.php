@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.thread.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.threads.update", [$thread->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.thread.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $thread->title) }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.thread.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('fourm_category') ? 'has-error' : '' }}">
                            <label class="required" for="fourm_category_id">{{ trans('cruds.thread.fields.fourm_category') }}</label>
                            <select class="form-control select2" name="fourm_category_id" id="fourm_category_id" required>
                                @foreach($fourm_categories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('fourm_category_id') ? old('fourm_category_id') : $thread->fourm_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('fourm_category'))
                                <span class="help-block" role="alert">{{ $errors->first('fourm_category') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.thread.fields.fourm_category_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                            <label for="content">{{ trans('cruds.thread.fields.content') }}</label>
                            <textarea class="form-control ckeditor" name="content" id="content">{!! old('content', $thread->content) !!}</textarea>
                            @if($errors->has('content'))
                                <span class="help-block" role="alert">{{ $errors->first('content') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.thread.fields.content_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
                            <label class="required" for="user_id">{{ trans('cruds.thread.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $thread->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <span class="help-block" role="alert">{{ $errors->first('user') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.thread.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('seo_title') ? 'has-error' : '' }}">
                            <label for="seo_title">{{ trans('cruds.thread.fields.seo_title') }}</label>
                            <input class="form-control" type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $thread->seo_title) }}">
                            @if($errors->has('seo_title'))
                                <span class="help-block" role="alert">{{ $errors->first('seo_title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.thread.fields.seo_title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('seo_description') ? 'has-error' : '' }}">
                            <label for="seo_description">{{ trans('cruds.thread.fields.seo_description') }}</label>
                            <textarea class="form-control" name="seo_description" id="seo_description">{{ old('seo_description', $thread->seo_description) }}</textarea>
                            @if($errors->has('seo_description'))
                                <span class="help-block" role="alert">{{ $errors->first('seo_description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.thread.fields.seo_description_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.threads.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $thread->id ?? 0 }}');
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

@endsection