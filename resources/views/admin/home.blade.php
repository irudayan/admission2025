@extends('layouts.admin')
@section('title', __('cruds.userDashboard.title'))
@section('content')
    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row column_title">
                <div class="col-md-12">
                    <div class="page_title">
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </div>
            <div class="row column1">
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30 yellow_bg">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <p class="total_no">{{ $totalLeads }}</p>
                                <p class="head_couter">Total Leads</p>&nbsp;
                                <a href="{{ route('admin.leads.index') }}" class="small-box-footer">View All <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30 blue1_bg">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <p class="total_no">{{ $pendingLeads }}</p>
                                <p class="head_couter">Pending Leads</p>&nbsp;
                                <a href="{{ route('admin.leads.index') }}" class="small-box-footer">View All <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30 green_bg">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-cloud-download"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <p class="total_no">{{ $doneLeads }}</p>
                                <p class="head_couter">Done Leads</p>&nbsp;
                                <a href="{{ route('admin.leads.index') }}" class="small-box-footer">View All <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="full counter_section margin_bottom_30 red_bg">
                        <div class="couter_icon">
                            <div>
                                <i class="fa fa-comments-o"></i>
                            </div>
                        </div>
                        <div class="counter_no">
                            <div>
                                <p class="total_no">{{ $cancelLeads }}</p>
                                <p class="head_couter">Cancel Leads</p>&nbsp;
                                <a href="{{ route('admin.leads.index') }}" class="small-box-footer">View All <i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- table section -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Recent Leads in a CRM</h2>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table table-hover">
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
                                    </tr>
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
                                            <td>{{ optional(\Carbon\Carbon::parse($lead->created_at))->format('d-m-Y g:i A') }}
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table section -->

            <!-- progress bar -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Recent leads Bar </h2>
                        </div>
                    </div>
                    <div class="full progress_bar_inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="progress_bar">
                                    <!-- Skill Bars -->

                                    <span class="skill">Total Leads <span
                                            class="info_valume">&nbsp;{{ $totalLeads }}%</span></span>
                                    <div class="progress skill-bar ">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped"
                                            role="progressbar" aria-valuenow="{{ $totalLeads }}" aria-valuemin="0"
                                            aria-valuemax="100" style="width: {{ $totalLeads }}%;">
                                        </div>
                                    </div>

                                    <span class="skill">New Leads <span
                                            class="info_valume">&nbsp;{{ $newLeads }}%</span></span>
                                    <div class="progress skill-bar">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped"
                                            role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"
                                            style="width: {{ $newLeads }}%;">
                                        </div>
                                    </div>


                                    <span class="skill">Demo Leads <span
                                            class="info_valume">&nbsp;{{ $demoLeads }}%</span></span>
                                    <div class="progress skill-bar">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped"
                                            role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100"
                                            style="width: {{ $demoLeads }}%;">
                                        </div>
                                    </div>

                                    <span class="skill">Quotation Leads <span
                                            class="info_valume">&nbsp;{{ $quotationLeads }}%</span></span>
                                    <div class="progress skill-bar">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped"
                                            role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100"
                                            style="width: {{ $quotationLeads }}%;">
                                        </div>
                                    </div>

                                    <span class="skill">Pending Leads <span
                                            class="info_valume">&nbsp;{{ $pendingLeads }}%</span></span>
                                    <div class="progress skill-bar">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped"
                                            role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100"
                                            style="width: {{ $pendingLeads }}%;">
                                        </div>
                                    </div>

                                    <span class="skill">Done Leads <span
                                            class="info_valume">&nbsp;{{ $doneLeads }}%</span></span>
                                    <div class="progress skill-bar">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped"
                                            role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100"
                                            style="width: {{ $doneLeads }}%;">
                                        </div>
                                    </div>


                                    <span class="skill">Cancel Leads <span
                                            class="info_valume">&nbsp;{{ $cancelLeads }}%</span></span>
                                    <div class="progress skill-bar">
                                        <div class="progress-bar progress-bar-animated progress-bar-striped"
                                            role="progressbar" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"
                                            style="width: {{ $cancelLeads }}%;">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end progress bar -->



        </div>
        <!-- footer -->
        <div class="container-fluid">
            <div class="footer">
                <p>Copyright © 2025 All rights reserved | Desigined and hosted
                    <a href="https://isaral.in/">by iSaral Business
                        Solutions Pvt Ltd</a>
                </p>
            </div>
        </div>
    </div>
@endsection
