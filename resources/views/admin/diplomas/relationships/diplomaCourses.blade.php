<div class="content">
    @can('course_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.courses.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.course.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.course.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-diplomaCourses">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.logo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.trainer') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.discount_price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.end_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.country') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.city') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.speclization') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.diploma') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $key => $course)
                                    <tr data-entry-id="{{ $course->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $course->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->name ?? '' }}
                                        </td>
                                        <td>
                                            @if($course->logo)
                                                <a href="{{ $course->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $course->logo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ App\Models\Course::TYPE_SELECT[$course->type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->trainer->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->discount_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->end_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->country->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->city->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->speclization->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->diploma->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('course_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.courses.show', $course->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('course_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.courses.edit', $course->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('course_delete')
                                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('course_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.courses.massDestroy') }}",
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
  let table = $('.datatable-diplomaCourses:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection