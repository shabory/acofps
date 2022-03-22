@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.thread.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.threads.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.thread.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $thread->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.thread.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $thread->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.thread.fields.fourm_category') }}
                                    </th>
                                    <td>
                                        {{ $thread->fourm_category->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.thread.fields.content') }}
                                    </th>
                                    <td>
                                        {!! $thread->content !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.thread.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $thread->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.thread.fields.seo_title') }}
                                    </th>
                                    <td>
                                        {{ $thread->seo_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.thread.fields.seo_description') }}
                                    </th>
                                    <td>
                                        {{ $thread->seo_description }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.threads.index') }}">
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
                        <a href="#thread_forum_comments" aria-controls="thread_forum_comments" role="tab" data-toggle="tab">
                            {{ trans('cruds.forumComment.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="thread_forum_comments">
                        @includeIf('admin.threads.relationships.threadForumComments', ['forumComments' => $thread->threadForumComments])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection