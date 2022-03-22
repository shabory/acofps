@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.forumCategory.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.forum-categories.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.forumCategory.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $forumCategory->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.forumCategory.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $forumCategory->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.forumCategory.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $forumCategory->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.forumCategory.fields.seo_title') }}
                                    </th>
                                    <td>
                                        {{ $forumCategory->seo_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.forumCategory.fields.seo_description') }}
                                    </th>
                                    <td>
                                        {{ $forumCategory->seo_description }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.forum-categories.index') }}">
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
                        <a href="#fourm_category_threads" aria-controls="fourm_category_threads" role="tab" data-toggle="tab">
                            {{ trans('cruds.thread.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="fourm_category_threads">
                        @includeIf('admin.forumCategories.relationships.fourmCategoryThreads', ['threads' => $forumCategory->fourmCategoryThreads])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection