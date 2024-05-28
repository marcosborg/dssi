@extends('layouts.admin')
@section('content')
@can('solar_wind_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.solar-winds.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.solarWind.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'SolarWind', 'route' => 'admin.solar-winds.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.solarWind.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SolarWind">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.option_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.option_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.part_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.partner_eur') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.pvp_eur') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.partner_mt') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.pvp_mt') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.partner_kz') }}
                    </th>
                    <th>
                        {{ trans('cruds.solarWind.fields.pvp_kz') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($products as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('solar_wind_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.solar-winds.massDestroy') }}",
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
    ajax: "{{ route('admin.solar-winds.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'product_name', name: 'product.name' },
{ data: 'name', name: 'name' },
{ data: 'option_1', name: 'option_1' },
{ data: 'option_2', name: 'option_2' },
{ data: 'part_number', name: 'part_number' },
{ data: 'description', name: 'description' },
{ data: 'partner_eur', name: 'partner_eur' },
{ data: 'pvp_eur', name: 'pvp_eur' },
{ data: 'partner_mt', name: 'partner_mt' },
{ data: 'pvp_mt', name: 'pvp_mt' },
{ data: 'partner_kz', name: 'partner_kz' },
{ data: 'pvp_kz', name: 'pvp_kz' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-SolarWind').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection