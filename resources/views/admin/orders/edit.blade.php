@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.orders.update", [$order->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('course') ? 'has-error' : '' }}">
                            <label for="course_id">{{ trans('cruds.order.fields.course') }}</label>
                            <select class="form-control select2" name="course_id" id="course_id">
                                @foreach($courses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $order->course->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('course'))
                                <span class="help-block" role="alert">{{ $errors->first('course') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.course_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('diploma') ? 'has-error' : '' }}">
                            <label for="diploma_id">{{ trans('cruds.order.fields.diploma') }}</label>
                            <select class="form-control select2" name="diploma_id" id="diploma_id">
                                @foreach($diplomas as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('diploma_id') ? old('diploma_id') : $order->diploma->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('diploma'))
                                <span class="help-block" role="alert">{{ $errors->first('diploma') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.diploma_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
                            <label class="required" for="user_id">{{ trans('cruds.order.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $order->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <span class="help-block" role="alert">{{ $errors->first('user') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('time') ? 'has-error' : '' }}">
                            <label class="required" for="time">{{ trans('cruds.order.fields.time') }}</label>
                            <input class="form-control datetime" type="text" name="time" id="time" value="{{ old('time', $order->time) }}" required>
                            @if($errors->has('time'))
                                <span class="help-block" role="alert">{{ $errors->first('time') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.time_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('invoice') ? 'has-error' : '' }}">
                            <label class="required" for="invoice_id">{{ trans('cruds.order.fields.invoice') }}</label>
                            <select class="form-control select2" name="invoice_id" id="invoice_id" required>
                                @foreach($invoices as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('invoice_id') ? old('invoice_id') : $order->invoice->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('invoice'))
                                <span class="help-block" role="alert">{{ $errors->first('invoice') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.invoice_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection