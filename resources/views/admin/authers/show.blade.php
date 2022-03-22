@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.auther.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.authers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auther.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $auther->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auther.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $auther->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auther.fields.image') }}
                                    </th>
                                    <td>
                                        @if($auther->image)
                                            <a href="{{ $auther->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $auther->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auther.fields.bio') }}
                                    </th>
                                    <td>
                                        {!! $auther->bio !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auther.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $auther->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auther.fields.seo_title') }}
                                    </th>
                                    <td>
                                        {{ $auther->seo_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.auther.fields.seo_description') }}
                                    </th>
                                    <td>
                                        {{ $auther->seo_description }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.authers.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#auther_articles" aria-controls="auther_articles" role="tab" data-toggle="tab">
                            {{ trans('cruds.article.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="auther_articles">
                        @includeIf('admin.authers.relationships.autherArticles', ['articles' => $auther->autherArticles])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection