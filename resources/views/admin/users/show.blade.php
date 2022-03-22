@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.user.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.image') }}
                                    </th>
                                    <td>
                                        @if($user->image)
                                            <a href="{{ $user->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $user->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email_verified_at') }}
                                    </th>
                                    <td>
                                        {{ $user->email_verified_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.roles') }}
                                    </th>
                                    <td>
                                        @foreach($user->roles as $key => $roles)
                                            <span class="label label-info">{{ $roles->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
                        <a href="#user_authers" aria-controls="user_authers" role="tab" data-toggle="tab">
                            {{ trans('cruds.auther.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#user_threads" aria-controls="user_threads" role="tab" data-toggle="tab">
                            {{ trans('cruds.thread.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#user_forum_comments" aria-controls="user_forum_comments" role="tab" data-toggle="tab">
                            {{ trans('cruds.forumComment.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#trainer_courses" aria-controls="trainer_courses" role="tab" data-toggle="tab">
                            {{ trans('cruds.course.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#trainer_diplomas" aria-controls="trainer_diplomas" role="tab" data-toggle="tab">
                            {{ trans('cruds.diploma.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#user_invoices" aria-controls="user_invoices" role="tab" data-toggle="tab">
                            {{ trans('cruds.invoice.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#user_orders" aria-controls="user_orders" role="tab" data-toggle="tab">
                            {{ trans('cruds.order.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#user_certificates" aria-controls="user_certificates" role="tab" data-toggle="tab">
                            {{ trans('cruds.certificate.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="user_authers">
                        @includeIf('admin.users.relationships.userAuthers', ['authers' => $user->userAuthers])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="user_threads">
                        @includeIf('admin.users.relationships.userThreads', ['threads' => $user->userThreads])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="user_forum_comments">
                        @includeIf('admin.users.relationships.userForumComments', ['forumComments' => $user->userForumComments])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="trainer_courses">
                        @includeIf('admin.users.relationships.trainerCourses', ['courses' => $user->trainerCourses])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="trainer_diplomas">
                        @includeIf('admin.users.relationships.trainerDiplomas', ['diplomas' => $user->trainerDiplomas])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="user_invoices">
                        @includeIf('admin.users.relationships.userInvoices', ['invoices' => $user->userInvoices])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="user_orders">
                        @includeIf('admin.users.relationships.userOrders', ['orders' => $user->userOrders])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="user_certificates">
                        @includeIf('admin.users.relationships.userCertificates', ['certificates' => $user->userCertificates])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection