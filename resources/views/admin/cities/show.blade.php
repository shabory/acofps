@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.city.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.cities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $city->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $city->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.city.fields.countryid') }}
                                    </th>
                                    <td>
                                        {{ $city->countryid->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.cities.index') }}">
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
                        <a href="#city_courses" aria-controls="city_courses" role="tab" data-toggle="tab">
                            {{ trans('cruds.course.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#city_diplomas" aria-controls="city_diplomas" role="tab" data-toggle="tab">
                            {{ trans('cruds.diploma.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="city_courses">
                        @includeIf('admin.cities.relationships.cityCourses', ['courses' => $city->cityCourses])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="city_diplomas">
                        @includeIf('admin.cities.relationships.cityDiplomas', ['diplomas' => $city->cityDiplomas])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection