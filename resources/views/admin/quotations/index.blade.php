@extends('layouts.admin')
@section('title', __('cruds.quotation.title'))
@section('content')
    <p>&nbsp;</p>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Lead">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.leads.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.leads.fields.name') }}
                            </th>

                            <th>
                                {{ trans('cruds.leads.fields.mobile') }}
                            </th>
                            <th>
                                {{ trans('cruds.leads.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.leads.fields.products') }}
                            </th>
                            <th>
                                {{ trans('cruds.leads.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.leads.fields.created_at') }}
                            </th>

                            <th>
                                {{ trans('cruds.leads.fields.action') }}
                            </th>
                        </tr>
                        {{-- <tr>
                            <td>

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
                            <td>

                            </td>
                            <td>
                            </td>
                        </tr> --}}
                    </thead>
                    <tbody>
                        @foreach ($leads as $lead)
                            <tr data-entry-id="{{ $lead->id }}">
                                <td>{{ $lead->id }}</td>
                                <td>{{ $lead->name }}</td>
                                <td>{{ $lead->mobile }}</td>
                                <td>{{ $lead->email }}</td>

                                <td>
                                    @if ($lead->products->isNotEmpty())
                                        @foreach ($lead->products as $product)
                                            <span class="badge badge-info">{{ $product->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No Products</span>
                                    @endif
                                </td>


                                <td>
                                    @if ($lead->status == 'New')
                                        <span class="badge badge-info">New</span>
                                    @elseif ($lead->status == 'Demo')
                                        <span class="badge badge-success">Demo</span>
                                    @elseif ($lead->status == 'Quotation')
                                        <span class="badge badge-dark">Quotation</span>
                                    @elseif ($lead->status == 'Pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($lead->status == 'Done')
                                        <span class="badge badge-primary">Done</span>
                                    @elseif ($lead->status == 'Cancel')
                                        <span class="badge badge-secondary">Cancel</span>
                                    @else
                                        <span class="badge badge-light">Unknown</span>
                                    @endif
                                </td>
                                <td>{{ optional(\Carbon\Carbon::parse($lead->created_at))->format('d-m-Y g:i A') }}</td>
                                <td>


                                    <!-- View Button -->

                                    {{-- <a class="btn btn-xs btn-primary view-lead" href="#"
                                        data-id="{{ $lead->id }}" data-name="{{ $lead->name }}"
                                        data-mobile="{{ $lead->mobile }}" data-email="{{ $lead->email }}"
                                        data-city="{{ $lead->city }}" data-status="{{ $lead->status }}"
                                        data-purpose="{{ $lead->purpose }}" data-remarks="{{ $lead->remarks }}"
                                        data-products="{{ $lead->products->pluck('name')->implode(', ') }}"
                                        data-toggle="modal" data-target="#viewLeadsModal">
                                        <i class="fa fa-eye"></i>
                                    </a> --}}

                                    <a class="btn btn-xs btn-primary view-lead" href="#"
                                        data-id="{{ $lead->id }}" data-name="{{ $lead->name }}"
                                        data-mobile="{{ $lead->mobile }}" data-email="{{ $lead->email }}"
                                        data-address="{{ $lead->address }}" data-source="{{ $lead->source }}"
                                        data-assigned_name="{{ $lead->assign->name ?? 'Not Assigned' }}"
                                        data-status="{{ $lead->status }}" data-purpose="{{ $lead->purpose }}"
                                        data-remarks="{{ $lead->remarks }}"
                                        data-products="{{ $lead->products->pluck('name')->implode(', ') }}"
                                        data-toggle="modal" data-target="#viewLeadsModal">
                                        <i class="fa fa-eye"></i>
                                    </a>


                                    @if ($lead->mail_status == '1')
                                        <i class="fa fa-check-circle green_color"></i>
                                    @else
                                        <i class="fa fa-times-circle red_color"></i>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Leads Modal -->
    {{-- @include('admin.leads.create') --}}

    <!-- View Leads Modal -->
    {{-- @include('admin.leads.show') --}}




    <!-- View Leads Modal -->
    <div class="modal fade" id="viewLeadsModal" tabindex="-1" role="dialog" aria-labelledby="viewLeadsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewLeadsModalLabel">{{ trans('global.view') }}
                        {{ trans('cruds.leads.title_singular') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>{{ trans('cruds.leads.fields.id') }}</th>
                                <td id="viewId"></td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.leads.fields.name') }}</th>
                                <td id="viewName"></td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.leads.fields.mobile') }}</th>
                                <td id="viewMobile"></td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.leads.fields.email') }}</th>
                                <td id="viewEmail"></td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.leads.fields.address') }}</th>
                                <td id="viewAddress"></td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.leads.fields.products') }}</th>
                                <td id="viewProducts"></td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.products.fields.assigned_name') }}</th>
                                <td id="viewAssignedName"></td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.leads.fields.source') }}</th>
                                <td id="viewSource"></td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.leads.fields.status') }}</th>
                                <td id="viewStatus"></td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.leads.fields.purpose') }}</th>
                                <td id="viewPurpose"></td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.leads.fields.remarks') }}</th>
                                <td id="viewRemarks"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('global.close') }}
                    </button>
                    <form action="{{ isset($lead) ? route('admin.send.quotation', $lead->id) : '#' }}" method="POST">

                        @csrf
                        <input type="hidden" value="1" name="mail_status" id="lead_id">
                        <button type="submit" class="btn btn-success">Send Email</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('lead_delete')
                let deleteButtonTrans =
                    '{{ trans('global.datatables.delete ') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.leads.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert(
                                '{{ trans('global.datatables.zero_selected ') }}'
                            )

                            return
                        }

                        if (confirm(
                                '{{ trans('global.areYouSure ') }}'
                            )) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
            });
            let table = $('.datatable-Lead:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            let visibleColumnsIndexes = null;
            $('.datatable thead').on('input', '.search', function() {
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


        // Handle View Button Click
        $('.view-lead').on('click', function() {
            let assignedName = $(this).data('assigned_name');
            $('#viewId').text($(this).data('id'));
            $('#viewName').text($(this).data('name'));
            $('#viewMobile').text($(this).data('mobile'));
            $('#viewEmail').text($(this).data('email'));
            $('#viewAddress').text($(this).data('address'));
            $('#viewAssignedName').text(assignedName); // Corrected this line
            $('#viewSource').text($(this).data('source'));
            $('#viewStatus').text($(this).data('status'));
            $('#viewPurpose').text($(this).data('purpose'));
            $('#viewRemarks').text($(this).data('remarks'));


            let products = $(this).data('products');
            $('#viewProducts').text(products ? products : 'No Products');

            // Show modal
            $('#viewLeadsModal').modal('show');
        });
    </script>
@endsection
