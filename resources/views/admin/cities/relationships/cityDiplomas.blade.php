<div class="content">
    @can('diploma_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.diplomas.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.diploma.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.diploma.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-cityDiplomas">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.logo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.trainer') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.discount_price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.end_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.country') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.city') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.diploma.fields.speclization') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($diplomas as $key => $diploma)
                                    <tr data-entry-id="{{ $diploma->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $diploma->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $diploma->name ?? '' }}
                                        </td>
                                        <td>
                                            @if($diploma->logo)
                                                <a href="{{ $diploma->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $diploma->logo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ App\Models\Diploma::TYPE_SELECT[$diploma->type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $diploma->trainer->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $diploma->price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $diploma->discount_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $diploma->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $diploma->end_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $diploma->country->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $diploma->city->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $diploma->speclization->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('diploma_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.diplomas.show', $diploma->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('diploma_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.diplomas.edit', $diploma->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('diploma_delete')
                                                <form action="{{ route('admin.diplomas.destroy', $diploma->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('diploma_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.diplomas.massDestroy') }}",
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
  let table = $('.datatable-cityDiplomas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection