@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.invoice.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.invoices.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $invoice->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $invoice->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $invoice->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.payment_time') }}
                                    </th>
                                    <td>
                                        {{ $invoice->payment_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.payment_method') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Invoice::PAYMENT_METHOD_SELECT[$invoice->payment_method] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.payment_refrence') }}
                                    </th>
                                    <td>
                                        {{ $invoice->payment_refrence }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.qeoud_registerd') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Invoice::QEOUD_REGISTERD_RADIO[$invoice->qeoud_registerd] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.invoice.fields.qeoud_number') }}
                                    </th>
                                    <td>
                                        {{ $invoice->qeoud_number }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.invoices.index') }}">
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
                        <a href="#invoice_orders" aria-controls="invoice_orders" role="tab" data-toggle="tab">
                            {{ trans('cruds.order.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="invoice_orders">
                        @includeIf('admin.invoices.relationships.invoiceOrders', ['orders' => $invoice->invoiceOrders])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection