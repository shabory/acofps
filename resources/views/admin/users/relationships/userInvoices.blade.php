<div class="content">
    @can('invoice_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.invoices.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.invoice.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.invoice.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-userInvoices">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.user') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.payment_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.payment_method') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.payment_refrence') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.qeoud_registerd') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.invoice.fields.qeoud_number') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $key => $invoice)
                                    <tr data-entry-id="{{ $invoice->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $invoice->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoice->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoice->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoice->payment_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Invoice::PAYMENT_METHOD_SELECT[$invoice->payment_method] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoice->payment_refrence ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Invoice::QEOUD_REGISTERD_RADIO[$invoice->qeoud_registerd] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $invoice->qeoud_number ?? '' }}
                                        </td>
                                        <td>
                                            @can('invoice_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.invoices.show', $invoice->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('invoice_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.invoices.edit', $invoice->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('invoice_delete')
                                                <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('invoice_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.invoices.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-userInvoices:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection