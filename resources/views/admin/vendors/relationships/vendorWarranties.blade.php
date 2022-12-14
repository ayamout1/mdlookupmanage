<div class="m-3">
    @can('warranty_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.warranties.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.warranty.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.warranty.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-vendorWarranties">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.warranty.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.warranty.fields.warranty') }}
                            </th>
                            <th>
                                {{ trans('cruds.warranty.fields.vendor') }}
                            </th>
                            <th>
                                {{ trans('cruds.warranty.fields.file') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($warranties as $key => $warranty)
                            <tr data-entry-id="{{ $warranty->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $warranty->id ?? '' }}
                                </td>
                                <td>
                                    {{ $warranty->warranty ?? '' }}
                                </td>
                                <td>
                                    {{ $warranty->vendor->name ?? '' }}
                                </td>
                                <td>
                                    @if($warranty->file)
                                        <a href="{{ $warranty->file->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @can('warranty_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.warranties.show', $warranty->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('warranty_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.warranties.edit', $warranty->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('warranty_delete')
                                        <form action="{{ route('admin.warranties.destroy', $warranty->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('warranty_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.warranties.massDestroy') }}",
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
  let table = $('.datatable-vendorWarranties:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection