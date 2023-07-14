@extends('layouts.admin')
@section('content')
<div class="content">
    @can('sopho_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.sophos.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.sopho.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Sopho', 'route' => 'admin.sophos.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.sopho.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Sopho">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.product') }}
                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.family') }}
                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.type') }}
                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.term') }}
                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.description') }}
                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.min') }}
                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.max') }}
                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.price_partner_met') }}
                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.pvp_met') }}
                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.price_partner_kwa') }}
                                </th>
                                <th>
                                    {{ trans('cruds.sopho.fields.pvp_kwa') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('sopho_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sophos.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.sophos.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'product_name_pt', name: 'product.name_pt' },
{ data: 'family', name: 'family' },
{ data: 'type', name: 'type' },
{ data: 'term', name: 'term' },
{ data: 'description', name: 'description' },
{ data: 'min', name: 'min' },
{ data: 'max', name: 'max' },
{ data: 'price_partner_met', name: 'price_partner_met' },
{ data: 'pvp_met', name: 'pvp_met' },
{ data: 'price_partner_kwa', name: 'price_partner_kwa' },
{ data: 'pvp_kwa', name: 'pvp_kwa' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Sopho').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection