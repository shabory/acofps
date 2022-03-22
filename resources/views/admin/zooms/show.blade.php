@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.zoom.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.zooms.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.zoom.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $zoom->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.zoom.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $zoom->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.zoom.fields.lesson') }}
                                    </th>
                                    <td>
                                        {{ $zoom->lesson->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.zoom.fields.zoomlink') }}
                                    </th>
                                    <td>
                                        {{ $zoom->zoomlink }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.zoom.fields.zoomtime') }}
                                    </th>
                                    <td>
                                        {{ $zoom->zoomtime }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.zooms.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection