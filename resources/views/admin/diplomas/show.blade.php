@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.diploma.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.diplomas.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $diploma->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $diploma->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.logo') }}
                                    </th>
                                    <td>
                                        @if($diploma->logo)
                                            <a href="{{ $diploma->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $diploma->logo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Diploma::TYPE_SELECT[$diploma->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.descrption') }}
                                    </th>
                                    <td>
                                        {!! $diploma->descrption !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.featured_image') }}
                                    </th>
                                    <td>
                                        @if($diploma->featured_image)
                                            <a href="{{ $diploma->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $diploma->featured_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.media') }}
                                    </th>
                                    <td>
                                        @foreach($diploma->media as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.attachments') }}
                                    </th>
                                    <td>
                                        @foreach($diploma->attachments as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.trainer') }}
                                    </th>
                                    <td>
                                        {{ $diploma->trainer->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $diploma->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.discount_price') }}
                                    </th>
                                    <td>
                                        {{ $diploma->discount_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $diploma->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $diploma->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.country') }}
                                    </th>
                                    <td>
                                        {{ $diploma->country->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $diploma->city->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.seo_title') }}
                                    </th>
                                    <td>
                                        {{ $diploma->seo_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.seo_description') }}
                                    </th>
                                    <td>
                                        {{ $diploma->seo_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.diploma.fields.speclization') }}
                                    </th>
                                    <td>
                                        {{ $diploma->speclization->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.diplomas.index') }}">
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
                        <a href="#diploma_orders" aria-controls="diploma_orders" role="tab" data-toggle="tab">
                            {{ trans('cruds.order.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#diploma_courses" aria-controls="diploma_courses" role="tab" data-toggle="tab">
                            {{ trans('cruds.course.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="diploma_orders">
                        @includeIf('admin.diplomas.relationships.diplomaOrders', ['orders' => $diploma->diplomaOrders])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="diploma_courses">
                        @includeIf('admin.diplomas.relationships.diplomaCourses', ['courses' => $diploma->diplomaCourses])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection