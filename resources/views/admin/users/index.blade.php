@extends('layouts.admin')
@section('title', __('cruds.user.title_singular'))
@section('content')
    <p>&nbsp;</p>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                    <h5> {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}</h5>
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 text-right">
                    @can('user_create')
                        <div style="margin-bottom: 10px;" class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-sm btn-dark" href="{{ route('admin.users.create') }}" style="float:right;"
                                    title="{{ trans('global.add') }}">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            {{-- <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th> --}}
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            {{-- <th>
                                {{ trans('cruds.user.fields.email_verified_at') }}
                            </th> --}}
                            <th>
                                {{ trans('cruds.user.fields.approved') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.verified') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.roles') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                        <tr>
                            {{-- <td>
                            </td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td> --}}
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            {{-- <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td> --}}
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach ($roles as $key => $item)
                                        <option value="{{ $item->title }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr data-entry-id="{{ $user->id }}">
                                {{-- <td>

                                </td>
                                <td>
                                    {{ $user->id ?? '' }}
                                </td> --}}
                                <td>
                                    {{ $user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                                {{-- <td>
                                    {{ $user->email_verified_at ?? '' }}
                                </td> --}}
                                <td>
                                    <span style="display:none">{{ $user->approved ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $user->verified ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @foreach ($user->roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('user_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endcan

                                    @can('user_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('user_delete')
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-xs btn-danger"
                                                title="{{ trans('global.delete') }}">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
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
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-User:not(.ajaxTable)').DataTable({
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
        })
    </script>
@endsection
