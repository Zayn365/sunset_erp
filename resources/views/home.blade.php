@extends('master')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">

            <div class="row">
                <div class="col-8"></div>
                <div class="col-4">

                    <div class="form-group">
                        <label>Date Range Picker</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>
                            <form method="GET" action="{{ route('home') }}">
                                <div class="input-group mb-3">
                                    <input type="text" name="daterange" class="form-control daterange-cus"
                                        value="{{ request('daterange') }}" autocomplete="off" />

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8 col-md-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Revenue Chart</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-inline text-center">
                                <li class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                        class="col-green"></i>
                                    <h5 class="m-b-0">&euro;675</h5>
                                    <p class="text-muted font-14 m-b-0">Weekly Earnings</p>
                                </li>
                                <li class="list-inline-item p-r-30"><i data-feather="arrow-down-circle"
                                        class="col-orange"></i>
                                    <h5 class="m-b-0">&euro;1,587</h5>
                                    <p class="text-muted font-14 m-b-0">Monthly Earnings</p>
                                </li>
                                <li class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                        class="col-green"></i>
                                    <h5 class="mb-0 m-b-0">&euro;45,965</h5>
                                    <p class="text-muted font-14 m-b-0">Yearly Earnings</p>
                                </li>
                            </ul>
                            <div id="revenue"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 col-lg-4">
                    <div class="card l-bg-orange">
                        <div class="card-body">
                            <div class="text-white">
                                <div class="row">
                                    <div class="col-md-6 col-lg-5">
                                        <h4 class="mb-0 font-26">₺1,235</h4>
                                        <p class="mb-2">Avg Sales Per Month</p>
                                        <p class="mb-0">
                                            <span class="font-20">+11.25% </span>Increase
                                        </p>
                                    </div>
                                    <div class="col-md-6 col-lg-7">
                                        <div class="sparkline-bar p-t-50"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card l-bg-cyan">
                        <div class="card-body">
                            <div class="text-white">
                                <div class="row">
                                    <div class="col-md-6 col-lg-5">
                                        <h4 class="mb-0 font-26">758</h4>
                                        <p class="mb-2">Avg new Cust Per Month</p>
                                        <p class="mb-0">
                                            <span class="font-20">+25.11%</span> Increase
                                        </p>
                                    </div>
                                    <div class="col-md-6 col-lg-7">
                                        <div class="sparkline-line-chart2 p-t-50"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Top 10 Offers</h4>
                            <div class="card-header-action">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped" id="sortable-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <i class="fas fa-th"></i>
                                            </th>
                                            <th>Customer Code</th>
                                            <th>Email</th>
                                            <th>Offer Currency</th>
                                            <th>Offer Rate</th>
                                            <th>Foreign Total</th>
                                            <th>Description</th>
                                            <th>Approval Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                <div class="sort-handler">
                                                    <i class="fas fa-th"></i>
                                                </div>
                                            </td>
                                            <td>{{ $order->cari_kod }}</td>
                                            <td>{{ $order->mail }}</td>
                                            <td>{{ $order->teklif_doviz }}</td>
                                            <td>{{ $order->teklif_kur }}</td>
                                            <td>{{ $order->teklif_tl_tutar }}</td>
                                            <td>{{ $order->aciklama }}</td>
                                            <td>
                                                <div class="badge badge-success">{{ $order->siparis_durum }}</div>
                                            </td>
                                            <td>{{ $order->tarih }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Top 10 Orders</h4>
                            <div class="card-header-action">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped" id="sortable-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <i class="fas fa-th"></i>
                                            </th>
                                            <th>Invoice #</th>
                                            <th>Width</th>
                                            <th>Height</th>
                                            <th>Color</th>
                                            <th>Glass Type</th>
                                            <th>Inner Glass</th>
                                            <th>Outer Glass</th>
                                            <th>Total Amount</th>
                                            <th>Order Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderdetail as $detail)
                                        <tr>
                                            <td>
                                                <div class="sort-handler"><i class="fas fa-th"></i></div>
                                            </td>
                                            <td>{{ $detail->fis_no }}</td>
                                            <td>{{ $detail->en }}</td>
                                            <td>{{ $detail->body }}</td>
                                            <td>{{ $detail->renk }}</td>
                                            <td>{{ $detail->cam }}</td>
                                            <td>{{ $detail->ic_cam }}</td>
                                            <td>{{ $detail->dis_cam }}</td>
                                            <td>{{ $detail->tutar }}</td>

                                            <td>
                                                <div class="badge badge-success">Completed</div>
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
    </section>
    <div class="settingSidebar">
        <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
        </a>
        <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
                <div class="setting-panel-header">Setting Panel
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Select Layout</h6>
                    <div class="selectgroup layout-color w-50">
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="1"
                                class="selectgroup-input-radio select-layout" checked>
                            <span class="selectgroup-button">Light</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="value" value="2"
                                class="selectgroup-input-radio select-layout">
                            <span class="selectgroup-button">Dark</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Sidebar Color</h6>
                    <div class="selectgroup selectgroup-pills sidebar-color">
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="1"
                                class="selectgroup-input select-sidebar">
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="icon-input" value="2"
                                class="selectgroup-input select-sidebar" checked>
                            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <h6 class="font-medium m-b-10">Color Theme</h6>
                    <div class="theme-setting-options">
                        <ul class="choose-theme list-unstyled mb-0">
                            <li title="white" class="active">
                                <div class="white"></div>
                            </li>
                            <li title="cyan">
                                <div class="cyan"></div>
                            </li>
                            <li title="black">
                                <div class="black"></div>
                            </li>
                            <li title="purple">
                                <div class="purple"></div>
                            </li>
                            <li title="orange">
                                <div class="orange"></div>
                            </li>
                            <li title="green">
                                <div class="green"></div>
                            </li>
                            <li title="red">
                                <div class="red"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                id="mini_sidebar_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Mini Sidebar</span>
                        </label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <div class="theme-setting-options">
                        <label class="m-b-0">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                id="sticky_header_setting">
                            <span class="custom-switch-indicator"></span>
                            <span class="control-label p-l-10">Sticky Header</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                    <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                        <i class="fas fa-undo"></i> Restore Default
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        const $i = $('.daterange-cus');

        // Destroy jQuery UI Datepicker if it exists on this input
        if ($.fn.datepicker && $i.data('datepicker')) {
            try {
                $i.datepicker('destroy');
            } catch (e) {}
        }

        // Default date range: last 7 days
        let start = moment().subtract(6, 'days');
        let end = moment();

        // If input already has a date range from request, parse it
        const current = ($i.val() || '').trim();
        if (current.includes(' - ')) {
            const [a, b] = current.split(' - ');
            const ma = moment(a, ['YYYY-MM-DD', 'MM/DD/YYYY'], true);
            const mb = moment(b, ['YYYY-MM-DD', 'MM/DD/YYYY'], true);
            if (ma.isValid() && mb.isValid()) {
                start = ma;
                end = mb;
            }
        }

        // Initialize Daterangepicker
        $i.daterangepicker({
            startDate: start,
            endDate: end,
            autoUpdateInput: true, // Write value automatically
            opens: 'left',
            locale: {
                format: 'YYYY-MM-DD',
                applyLabel: 'Apply',
                cancelLabel: 'Clear',
                daysOfWeek: moment.weekdaysMin(),
                monthNames: moment.months()
            }
        });

        // Update input when date range selected
        $i.on('apply.daterangepicker', function(ev, picker) {
            $(this).val(
                picker.startDate.format('YYYY-MM-DD') + ' - ' +
                picker.endDate.format('YYYY-MM-DD')
            );
        });

        // Clear input on cancel
        $i.on('cancel.daterangepicker', function() {
            $(this).val('');
        });
    });
</script>

@endsection

{{-- REQUIRED: daterangepicker assets (keep everything else as-is) --}}