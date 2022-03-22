@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.zoom.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.zooms.update", [$zoom->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.zoom.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $zoom->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.zoom.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('lesson') ? 'has-error' : '' }}">
                            <label class="required" for="lesson_id">{{ trans('cruds.zoom.fields.lesson') }}</label>
                            <select class="form-control select2" name="lesson_id" id="lesson_id" required>
                                @foreach($lessons as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('lesson_id') ? old('lesson_id') : $zoom->lesson->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('lesson'))
                                <span class="help-block" role="alert">{{ $errors->first('lesson') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.zoom.fields.lesson_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('zoomlink') ? 'has-error' : '' }}">
                            <label class="required" for="zoomlink">{{ trans('cruds.zoom.fields.zoomlink') }}</label>
                            <input class="form-control" type="text" name="zoomlink" id="zoomlink" value="{{ old('zoomlink', $zoom->zoomlink) }}" required>
                            @if($errors->has('zoomlink'))
                                <span class="help-block" role="alert">{{ $errors->first('zoomlink') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.zoom.fields.zoomlink_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('zoomtime') ? 'has-error' : '' }}">
                            <label class="required" for="zoomtime">{{ trans('cruds.zoom.fields.zoomtime') }}</label>
                            <input class="form-control datetime" type="text" name="zoomtime" id="zoomtime" value="{{ old('zoomtime', $zoom->zoomtime) }}" required>
                            @if($errors->has('zoomtime'))
                                <span class="help-block" role="alert">{{ $errors->first('zoomtime') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.zoom.fields.zoomtime_helper') }}</span>
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