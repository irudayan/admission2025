@extends('layouts.admin')
@section('title', __('cruds.appointments.title'))
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
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-lg-10 col-sm-10 col-md-10 col-xs-12">
                    <h5>{{ trans('cruds.appointments.title_singular') }} {{ trans('global.list') }}</h5>
                </div>
                {{-- <button class="btn btn-success" data-toggle="modal" data-target="#createLeadsModal">
                    {{ trans('global.add') }} {{ trans('cruds.appointments.title_singular') }}
                </button> --}}
            </div>
        </div>

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
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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

                                    <a class="btn btn-xs btn-primary view-lead" href="#"
                                        data-id="{{ $lead->id }}" data-name="{{ $lead->name }}"
                                        data-mobile="{{ $lead->mobile }}" data-email="{{ $lead->email }}"
                                        data-address="{{ $lead->address }}" data-source="{{ $lead->source }}"
                                        data-assigned_name="{{ $lead->assigned_name }}"data-status="{{ $lead->status }}"
                                        data-purpose="{{ $lead->purpose }}" data-remarks="{{ $lead->remarks }}"
                                        data-products="{{ $lead->products->pluck('name')->implode(', ') }}"
                                        data-toggle="modal" data-target="#viewLeadsModal">
                                        <i class="fa fa-calendar"></i>
                                    </a>

                                    @if ($lead->demo_mail_status == '1')
                                        <i class="fa fa-check-circle green_color"></i>
                                    @else
                                        <i class="fa fa-times-circle red_color"></i>
                                    @endif




                                    <!-- Edit Button -->
                                    {{-- <button class="btn btn-xs btn-warning edit-lead" data-id="{{ $lead->id }}"
                                        data-name="{{ $lead->name }}" data-mobile="{{ $lead->mobile }}"
                                        data-email="{{ $lead->email }}" data-address="{{ $lead->address }}"
                                        data-source="{{ $lead->source }}" data-assigned_by="{{ $lead->assigned_name }}"
                                        data-status="{{ $lead->status }}" data-purpose="{{ $lead->purpose }}"
                                        data-remarks="{{ $lead->remarks }}" data-toggle="modal"
                                        data-target="#editLeadsModal">
                                        <i class="fa fa-edit"></i>
                                    </button> --}}


                                    <!-- Delete Button -->
                                    {{-- <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form> --}}
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

    <!-- Edit Leads Modal -->
    <div class="modal fade" id="editLeadsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('global.edit') }} {{ trans('cruds.leads.title_singular') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editLeadForm" method="POST" action="#">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="edit_id" name="id">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_name">{{ trans('cruds.leads.fields.name') }}</label>
                                    <input type="text" id="edit_name" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_mobile">{{ trans('cruds.leads.fields.mobile') }}</label>
                                    <input type="text" id="edit_mobile" class="form-control" name="mobile" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_email">{{ trans('cruds.leads.fields.email') }}</label>
                                    <input type="email" id="edit_email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_address">{{ trans('cruds.leads.fields.address') }}</label>
                                    <input type="text" id="edit_address" class="form-control" name="address" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required" for="product_idss">Select Products</label>

                                    <select name="product_ids[]" id="product_idss" class="form-control select2" multiple
                                        required>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_status">{{ trans('cruds.leads.fields.status') }}</label>
                                    <select name="status" id="edit_status" class="form-control" required>
                                        <option value="New">New</option>
                                        <option value="Demo">Demo</option>
                                        <option value="Quotation">Quotation</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Done">Done</option>
                                        <option value="Cancel">Cancel</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="assigned_name">Assigned Name</label>
                                    <input type="text" id="edit_assigned_name" name="assigned_name"
                                        class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_source">{{ trans('cruds.leads.fields.source') }}</label>
                                    <select name="source" id="edit_source" class="form-control" required>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Twitter">Twitter (X)</option>
                                        <option value="LinkedIn">LinkedIn</option>
                                        <option value="YouTube">YouTube</option>
                                        <option value="WhatsApp">WhatsApp</option>
                                        <option value="Telegram">Telegram</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_purpose">{{ trans('cruds.leads.fields.purpose') }}</label>
                            <textarea id="edit_purpose" class="form-control" name="purpose" rows="2"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_remarks">{{ trans('cruds.leads.fields.remarks') }}</label>
                            <textarea id="edit_remarks" class="form-control" name="remarks" rows="2"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('global.cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                                <th>{{ trans('cruds.leads.fields.assigned_by') }}</th>
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

                <div class="modal-body">
                    {{-- <form action="{{ isset($lead) ? route('admin.send.demo', $lead->id) }} : ?? '' " method="POST"> --}}
                    <form action="{{ isset($lead) ? route('admin.send.demo', $lead->id) : '#' }}" method="POST">

                        @csrf
                        <input type="hidden" value="1" name="mail_status" id="lead_id">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">{{ trans('cruds.appointments.fields.date') }}</label>
                                    <input type="date" name="demo_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time">{{ trans('cruds.appointments.fields.time') }}</label>
                                    <input type="time" name="demo_time" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Send Email</button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('global.close') }}</button>
                        </div>
                    </form>

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

            // Handle Edit Button Click
            $('.edit-lead').on('click', function() {
                let leadId = $(this).data('id');

                // Set the form action URL dynamically
                $('#editLeadForm').attr('action', `/admin/leads/${leadId}`);

                // Set input values
                $('#edit_id').val(leadId);
                $('#edit_name').val($(this).data('name'));
                $('#edit_mobile').val($(this).data('mobile'));
                $('#edit_email').val($(this).data('email'));
                $('#edit_address').val($(this).data('address'));
                $('#edit_source').val($(this).data('source'));
                $('#edit_assigned_name').val($(this).data('assigned_name'));
                $('#edit_status').val($(this).data('status'));
                $('#edit_purpose').val($(this).data('purpose'));
                $('#edit_remarks').val($(this).data('remarks'));

                // Fetch selected products via AJAX
                $.ajax({
                    url: `/admin/leads/${leadId}/products`,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            let selectedProducts = response.products;
                            $('#product_idss').val(selectedProducts).trigger(
                                'change'); // Set selected products
                        }
                    },
                    error: function(xhr) {
                        console.error("Error fetching products:", xhr.responseText);
                    }
                });

                $('#editLeadsModal').modal('show');
            });

            // Initialize Select2
            $('#product_idss').select2({
                placeholder: "Select Products",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#editLeadsModal')
            });


            // Handle View Button Click
            $('.view-lead').on('click', function() {
                $('#viewId').text($(this).data('id'));
                $('#viewName').text($(this).data('name'));
                $('#viewMobile').text($(this).data('mobile'));
                $('#viewEmail').text($(this).data('email'));
                $('#viewAddress').text($(this).data('address'));
                $('#viewAssignedName').text($(this).data('assigned_name'));
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
