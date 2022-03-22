@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.specialization.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.specializations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.specialization.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $specialization->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.specialization.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $specialization->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.specialization.fields.image') }}
                                    </th>
                                    <td>
                                        @if($specialization->image)
                                            <a href="{{ $specialization->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $specialization->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.specializations.index') }}">
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
                        <a href="#speclization_courses" aria-controls="speclization_courses" role="tab" data-toggle="tab">
                            {{ trans('cruds.course.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#speclization_diplomas" aria-controls="speclization_diplomas" role="tab" data-toggle="tab">
                            {{ trans('cruds.diploma.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="speclization_courses">
                        @includeIf('admin.specializations.relationships.speclizationCourses', ['courses' => $specialization->speclizationCourses])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="speclization_diplomas">
                        @includeIf('admin.specializations.relationships.speclizationDiplomas', ['diplomas' => $specialization->speclizationDiplomas])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection