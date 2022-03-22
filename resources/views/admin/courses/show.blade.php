@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.course.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $course->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $course->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.logo') }}
                                    </th>
                                    <td>
                                        @if($course->logo)
                                            <a href="{{ $course->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $course->logo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Course::TYPE_SELECT[$course->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.descrption') }}
                                    </th>
                                    <td>
                                        {!! $course->descrption !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.featured_image') }}
                                    </th>
                                    <td>
                                        @if($course->featured_image)
                                            <a href="{{ $course->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $course->featured_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.media') }}
                                    </th>
                                    <td>
                                        @foreach($course->media as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.attachments') }}
                                    </th>
                                    <td>
                                        @foreach($course->attachments as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.trainer') }}
                                    </th>
                                    <td>
                                        {{ $course->trainer->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $course->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.discount_price') }}
                                    </th>
                                    <td>
                                        {{ $course->discount_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $course->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $course->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.country') }}
                                    </th>
                                    <td>
                                        {{ $course->country->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $course->city->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.seo_title') }}
                                    </th>
                                    <td>
                                        {{ $course->seo_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.seo_description') }}
                                    </th>
                                    <td>
                                        {{ $course->seo_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.speclization') }}
                                    </th>
                                    <td>
                                        {{ $course->speclization->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.diploma') }}
                                    </th>
                                    <td>
                                        {{ $course->diploma->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
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
                        <a href="#course_lessons" aria-controls="course_lessons" role="tab" data-toggle="tab">
                            {{ trans('cruds.lesson.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#course_orders" aria-controls="course_orders" role="tab" data-toggle="tab">
                            {{ trans('cruds.order.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#course_certificates" aria-controls="course_certificates" role="tab" data-toggle="tab">
                            {{ trans('cruds.certificate.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="course_lessons">
                        @includeIf('admin.courses.relationships.courseLessons', ['lessons' => $course->courseLessons])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="course_orders">
                        @includeIf('admin.courses.relationships.courseOrders', ['orders' => $course->courseOrders])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="course_certificates">
                        @includeIf('admin.courses.relationships.courseCertificates', ['certificates' => $course->courseCertificates])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection