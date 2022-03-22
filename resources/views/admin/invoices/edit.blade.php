@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.invoice.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.invoices.update", [$invoice->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
                            <label class="required" for="user_id">{{ trans('cruds.invoice.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $invoice->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <span class="help-block" role="alert">{{ $errors->first('user') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                            <label class="required" for="amount">{{ trans('cruds.invoice.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $invoice->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <span class="help-block" role="alert">{{ $errors->first('amount') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('payment_time') ? 'has-error' : '' }}">
                            <label for="payment_time">{{ trans('cruds.invoice.fields.payment_time') }}</label>
                            <input class="form-control datetime" type="text" name="payment_time" id="payment_time" value="{{ old('payment_time', $invoice->payment_time) }}">
                            @if($errors->has('payment_time'))
                                <span class="help-block" role="alert">{{ $errors->first('payment_time') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.payment_time_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.invoice.fields.payment_method') }}</label>
                            <select class="form-control" name="payment_method" id="payment_method" required>
                                <option value disabled {{ old('payment_method', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Invoice::PAYMENT_METHOD_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('payment_method', $invoice->payment_method) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('payment_method'))
                                <span class="help-block" role="alert">{{ $errors->first('payment_method') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.payment_method_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('payment_refrence') ? 'has-error' : '' }}">
                            <label for="payment_refrence">{{ trans('cruds.invoice.fields.payment_refrence') }}</label>
                            <input class="form-control" type="text" name="payment_refrence" id="payment_refrence" value="{{ old('payment_refrence', $invoice->payment_refrence) }}">
                            @if($errors->has('payment_refrence'))
                                <span class="help-block" role="alert">{{ $errors->first('payment_refrence') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.payment_refrence_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('qeoud_registerd') ? 'has-error' : '' }}">
                            <label class="required">{{ trans('cruds.invoice.fields.qeoud_registerd') }}</label>
                            @foreach(App\Models\Invoice::QEOUD_REGISTERD_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="qeoud_registerd_{{ $key }}" name="qeoud_registerd" value="{{ $key }}" {{ old('qeoud_registerd', $invoice->qeoud_registerd) === (string) $key ? 'checked' : '' }} required>
                                    <label for="qeoud_registerd_{{ $key }}" style="font-weight: 400">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('qeoud_registerd'))
                                <span class="help-block" role="alert">{{ $errors->first('qeoud_registerd') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.qeoud_registerd_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('qeoud_number') ? 'has-error' : '' }}">
                            <label for="qeoud_number">{{ trans('cruds.invoice.fields.qeoud_number') }}</label>
                            <input class="form-control" type="text" name="qeoud_number" id="qeoud_number" value="{{ old('qeoud_number', $invoice->qeoud_number) }}">
                            @if($errors->has('qeoud_number'))
                                <span class="help-block" role="alert">{{ $errors->first('qeoud_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.invoice.fields.qeoud_number_helper') }}</span>
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