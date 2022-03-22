@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.forumCategory.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.forum-categories.update", [$forumCategory->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.forumCategory.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $forumCategory->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.forumCategory.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.forumCategory.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $forumCategory->description) }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.forumCategory.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('seo_title') ? 'has-error' : '' }}">
                            <label for="seo_title">{{ trans('cruds.forumCategory.fields.seo_title') }}</label>
                            <input class="form-control" type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $forumCategory->seo_title) }}">
                            @if($errors->has('seo_title'))
                                <span class="help-block" role="alert">{{ $errors->first('seo_title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.forumCategory.fields.seo_title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('seo_description') ? 'has-error' : '' }}">
                            <label for="seo_description">{{ trans('cruds.forumCategory.fields.seo_description') }}</label>
                            <textarea class="form-control" name="seo_description" id="seo_description">{{ old('seo_description', $forumCategory->seo_description) }}</textarea>
                            @if($errors->has('seo_description'))
                                <span class="help-block" role="alert">{{ $errors->first('seo_description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.forumCategory.fields.seo_description_helper') }}</span>
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