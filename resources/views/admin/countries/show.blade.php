@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.country.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.countries.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $country->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $country->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.country.fields.active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $country->active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.countries.index') }}">
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
                        <a href="#countryid_cities" aria-controls="countryid_cities" role="tab" data-toggle="tab">
                            {{ trans('cruds.city.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#country_courses" aria-controls="country_courses" role="tab" data-toggle="tab">
                            {{ trans('cruds.course.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#country_diplomas" aria-controls="country_diplomas" role="tab" data-toggle="tab">
                            {{ trans('cruds.diploma.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="countryid_cities">
                        @includeIf('admin.countries.relationships.countryidCities', ['cities' => $country->countryidCities])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="country_courses">
                        @includeIf('admin.countries.relationships.countryCourses', ['courses' => $country->countryCourses])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="country_diplomas">
                        @includeIf('admin.countries.relationships.countryDiplomas', ['diplomas' => $country->countryDiplomas])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection