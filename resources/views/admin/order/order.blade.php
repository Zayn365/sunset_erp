<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/admin/assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/css/components.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/css/custom.css')}}">
    <link rel='shortcut icon' type='image/x-icon' href="{{asset('assets/admin/assets/img/logo.png')}}" />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <!-- NAVBAR -->
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"><i data-feather="align-justify"></i></a></li>
                        <li>
                            <h3 class="m-0 nav-link nav-link-lg text-dark">ORDERS</h3>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li><a href="#" class="nav-link nav-link-lg fullscreen-btn"><i data-feather="maximize"></i></a></li>
                    <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">Notifications <div class="float-right"><a href="#">Mark All As Read</a></div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread"><span class="dropdown-item-icon bg-primary text-white"><i class="fas fa-code"></i></span><span class="dropdown-item-desc">Template update is available now! <span class="time">2 Min Ago</span></span></a>
                                <a href="#" class="dropdown-item"><span class="dropdown-item-icon bg-info text-white"><i class="far fa-user"></i></span><span class="dropdown-item-desc"><b>You</b> and <b>Dedik Sugiharto</b> are now friends <span class="time">10 Hours Ago</span></span></a>
                                <a href="#" class="dropdown-item"><span class="dropdown-item-icon bg-success text-white"><i class="fas fa-check"></i></span><span class="dropdown-item-desc"><b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12 Hours Ago</span></span></a>
                                <a href="#" class="dropdown-item"><span class="dropdown-item-icon bg-danger text-white"><i class="fas fa-exclamation-triangle"></i></span><span class="dropdown-item-desc">Low disk space. Let's clean it! <span class="time">17 Hours Ago</span></span></a>
                                <a href="#" class="dropdown-item"><span class="dropdown-item-icon bg-info text-white"><i class="fas fa-bell"></i></span><span class="dropdown-item-desc">Welcome to Otika template! <span class="time">Yesterday</span></span></a>
                            </div>
                            <div class="dropdown-footer text-center"><a href="#">View All <i class="fas fa-chevron-right"></i></a></div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/admin/assets/img/user.png')}}" class="user-img-radious-style">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Hello Sarah Smith</div>
                            <a href="profile.html" class="dropdown-item has-icon"><i class="far fa-user"></i> Profile</a>
                            <a type="button" onclick="logout()" class="dropdown-item has-icon text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- SIDEBAR -->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html"><img alt="image" src="{{asset('assets/admin/assets/img/logo.png')}}" class="header-logo" /></a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Main</li>
                        <li class="dropdown "><a href="{{url('/')}}" class="nav-link"><i class="fas fa-desktop"></i><span>Dashboard</span></a></li>
                        <li class="dropdown active"><a href="{{url('order')}}" class="nav-link"><i class="fas fa-shopping-cart"></i><span>Orders</span></a></li>
                        <li class="dropdown ">
                            <a href="{{url('orderdetay')}}" class="nav-link">
                                <i class="fas fa-list-alt"></i>
                                <span>Orders Detay</span></a>
                        </li>
                        <li class="dropdown"><a href="{{url('user')}}" class="nav-link"><i class="fas fa-user"></i><span>Users</span></a></li>
                    </ul>
                </aside>
            </div>

            <!-- CONTENT -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="d-flex justify-content-end mb-2">
                                    <button class="btn btn-icon icon-left btn-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <button id="btnNewOrder" class="btn btn-icon icon-left btn-primary" style="margin-left: 20px;" type="button" data-toggle="modal" data-target=".new-order">
                                        <i class="fas fa-plus-circle"></i> New Order
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 collapse" id="collapseExample">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h4 class="text-white">Filters</h4>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <label>Fis No</label>
                                                    <input id="f_fis" type="text" class="form-control" placeholder="485986">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <label>Tarih (Başlangıç)</label>
                                                    <input id="f_date_from" type="date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <label>Tarih (Bitiş)</label>
                                                    <input id="f_date_to" type="date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <label>Marka</label>
                                                    <input id="f_marka" type="text" class="form-control" placeholder="SUNSET ELİTE">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <label>Teslimat Tipi</label>
                                                    <select id="f_teslim" class="form-control select2">
                                                        <option value=""></option>
                                                        <option value="KARGO">KARGO</option>
                                                        <option value="SEVK">SEVK</option>
                                                        <option value="ELDEN">ELDEN</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <label>Kargo No</label>
                                                    <input id="f_kargo" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group mb-2">
                                                    <label>Dolgu</label>
                                                    <input id="f_dolgu" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-6 col-sm-12 pt-2">
                                                <div class="h-100 d-flex justify-content-end align-items-center">
                                                    <button id="btnReset" class="btn btn-icon icon-left btn-dark" type="button">
                                                        <i class="fas fa-times"></i> Reset
                                                    </button>
                                                    <button id="btnSearch" class="btn btn-icon icon-left btn-primary ml-2" type="button">
                                                        <i class="fas fa-search"></i> Search
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- ORDERS TABLE -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h4 class="text-white">Sale Orders</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width:140px">Action</th>
                                                        <th>Fis No</th>
                                                        <th>Sipariş Tarih</th>
                                                        <th>Konu</th>
                                                        <th>Marka</th>
                                                        <th>Teslimat Tipi</th>
                                                        <th>Kargo No</th>
                                                        <th>Dolgu</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="orders-body"></tbody>
                                            </table>
                                        </div>

                                        <div class="collapse mt-4" id="items">
                                            <div class="table-responsive">
                                                <table class="table table-md">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-dark bg-secondary" style="border-top-left-radius:10px;">#</th>
                                                            <th class="text-dark bg-secondary">Item</th>
                                                            <th class="text-dark bg-secondary">Price</th>
                                                            <th class="text-dark bg-secondary">Quantity</th>
                                                            <th class="text-dark bg-secondary">Discount %</th>
                                                            <th class="text-dark bg-secondary" style="border-top-right-radius:10px;">Total Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="4"></th>
                                                            <th>Total Quantity</th>
                                                            <th>0</th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="4"></th>
                                                            <th>Total Price</th>
                                                            <th>0</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <!-- Settings sidebar (unchanged) -->
                <div class="settingSidebar">
                    <a href="javascript:void(0)" class="settingPanelToggle"><i class="fa fa-spin fa-cog"></i></a>
                    <div class="settingSidebar-body ps-container ps-theme-default">
                        <div class="fade show active">
                            <div class="setting-panel-header">Setting Panel</div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Select Layout</h6>
                                <div class="selectgroup layout-color w-50">
                                    <label class="selectgroup-item"><input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked><span class="selectgroup-button">Light</span></label>
                                    <label class="selectgroup-item"><input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout"><span class="selectgroup-button">Dark</span></label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                                <div class="selectgroup selectgroup-pills sidebar-color">
                                    <label class="selectgroup-item"><input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar"><span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span></label>
                                    <label class="selectgroup-item"><input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked><span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span></label>
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
                                    <label class="m-b-0"><input type="checkbox" class="custom-switch-input" id="mini_sidebar_setting"><span class="custom-switch-indicator"></span><span class="control-label p-l-10">Mini Sidebar</span></label>
                                </div>
                            </div>
                            <div class="p-15 border-bottom">
                                <div class="theme-setting-options">
                                    <label class="m-b-0"><input type="checkbox" class="custom-switch-input" id="sticky_header_setting"><span class="custom-switch-indicator"></span><span class="control-label p-l-10">Sticky Header</span></label>
                                </div>
                            </div>
                            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme"><i class="fas fa-undo"></i> Restore Default</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="main-footer">
                <div class="footer-left"><a href="templateshub.net">Templateshub</a></div>
                <div class="footer-right"></div>
            </footer>
        </div>
    </div>

    <!-- New Order Modal -->
    <div class="modal fade new-order" tabindex="-1" role="dialog" aria-labelledby="newOrderModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary p-3">
                    <h5 class="modal-title text-white">New Order</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <form id="orderForm">@csrf
                        <!-- Typing fields -->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>En</label>
                                <input name="en" class="form-control" type="number" step="0.01" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Boy</label>
                                <input name="boy" class="form-control" type="number" step="0.01" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Miktar</label>
                                <input name="miktar" class="form-control" type="number" step="1" value="1" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>M2 Fiyatı</label>
                                <input name="m2_fiyat" class="form-control" type="number" step="0.01" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Açıklama</label>
                                <input name="aciklama" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Poz</label>
                                <input name="poz" class="form-control">
                            </div>
                        </div>

                        <!-- Derived (read-only) -->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>M2 (otomatik)</label>
                                <input id="m2_view" class="form-control" readonly>
                                <input type="hidden" name="m2" id="m2_hidden">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Tutar Döviz (otomatik)</label>
                                <input id="tutar_view" class="form-control" readonly>
                                <input type="hidden" name="tutar_doviz" id="tutar_hidden">
                            </div>
                        </div>

                        <hr>
                        <!-- Popup fields -->
                        <!-- Popup fields -->
                        <button type="button" class="btn btn-light mb-2" data-toggle="collapse" data-target="#moreFields">Diğer Alanlar</button>
                        <div id="moreFields" class="collapse">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Renk</label>
                                    <select name="renk" id="renk" class="form-control select2"></select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Mekanizma Yön</label>
                                    <select name="mekanizma_yon" id="mekanizma_yon" class="form-control select2"></select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Sistem</label>
                                    <select name="sistem" id="sistem" class="form-control select2"></select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Slayt <sup>(optional)</sup></label>
                                    <select name="slayt" id="slayt" class="form-control select2"></select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Cam</label>
                                    <select name="cam" id="cam" class="form-control select2"></select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>İç Cam</label>
                                    <select name="ic_cam" id="ic_cam" class="form-control select2"></select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Dış Cam</label>
                                    <select name="dis_cam" id="dis_cam" class="form-control select2"></select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Kasa Rengi</label>
                                    <select name="kasa_renk" id="kasa_renk" class="form-control select2"></select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Alt Kasa Rengi</label>
                                    <select name="alt_kasa_renk" id="alt_kasa_renk" class="form-control select2"></select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Cam Çıtası Rengi</label>
                                    <select name="cam_cita_renk" id="cam_cita_renk" class="form-control select2"></select>
                                </div>
                            </div>
                        </div>


                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ml-auto">Kaydet</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- /New Order Modal -->
    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info p-3">
                    <h5 class="modal-title text-white">Order Detail</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <dl class="row mb-0" id="viewBody"></dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning p-3">
                    <h5 class="modal-title text-white">Edit Order</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="editForm">@csrf
                    <div class="modal-body">
                        <input type="hidden" name="fis_no" id="e_fis">
                        <div class="form-group"><label>Sipariş Tarih</label><input name="tarih" id="e_tarih" type="date" class="form-control"></div>
                        <div class="form-group"><label>Konu</label><input name="konu" id="e_konu" class="form-control"></div>
                        <div class="form-group"><label>Marka</label><input name="marka" id="e_marka" class="form-control"></div>
                        <div class="form-group"><label>Teslimat Tipi</label>
                            <select name="teslimat_tipi" id="e_teslim" class="form-control">
                                <option value=""></option>
                                <option>KARGO</option>
                                <option>SEVK</option>
                                <option>ELDEN</option>
                            </select>
                        </div>
                        <div class="form-group"><label>Kargo No</label><input name="kargo_no" id="e_kargo" class="form-control"></div>
                        <div class="form-group"><label>Dolgu</label><input name="dolgu" id="e_dolgu" class="form-control"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/admin/assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/admin/assets/js/app.min.js')}}"></script>
    <script src="{{asset('assets/admin/assets/js/page/forms-advanced-forms.js')}}"></script>
    <script src="{{asset('assets/admin/assets/bundles/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/admin/assets/js/page/datatables.js')}}"></script>
    <script src="{{asset('assets/admin/assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/admin/assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/admin/assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // ---------- DataTable ----------
            const dt = $('#save-stage').DataTable({
                destroy: true,
                pageLength: 25,
                order: [
                    [0, 'asc']
                ], // newest by fis_no on top (col 1)
                data: [],
                columns: [{
                        data: null,
                        orderable: false,
                        render: r => `
          <div class="btn-group btn-group-sm">
            <button class="btn btn-info act-view"  data-fis="${r.fis_no}">View</button>
            <button class="btn btn-warning act-edit" data-fis="${r.fis_no}">Edit</button>
            <button class="btn btn-danger act-del"   data-fis="${r.fis_no}">Delete</button>
          </div>`
                    },
                    {
                        data: 'fis_no',
                        title: 'Fis No',
                        render: d => Number(d)
                    }, // numeric for proper sort
                    {
                        data: 'tarih',
                        title: 'Sipariş Tarih',
                        render: v => v ? new Date(v).toLocaleDateString('tr-TR') : '-'
                    },
                    {
                        data: 'konu',
                        title: 'Konu',
                        defaultContent: '-'
                    },
                    {
                        data: 'marka',
                        title: 'Marka',
                        defaultContent: '-'
                    },
                    {
                        data: 'teslimat_tipi',
                        title: 'Teslimat Tipi',
                        defaultContent: '-'
                    },
                    {
                        data: 'kargo_no',
                        title: 'Kargo No',
                        defaultContent: '-'
                    },
                    {
                        data: 'dolgu',
                        title: 'Dolgu',
                        defaultContent: '-'
                    },
                ]
            });

            // ---------- Fetch + client filtering + force newest on top ----------
            function loadOrders(filters = null) {
                $.getJSON('{{ route("orders.data") }}').done(rows => {
                    if (filters) {
                        rows = rows.filter(r => {
                            const d = r.tarih ? new Date(r.tarih) : null;
                            if (filters.fis && !String(r.fis_no).includes(filters.fis)) return false;
                            if (filters.marka && !(r.marka || '').toLowerCase().includes(filters.marka)) return false;
                            if (filters.teslim && (r.teslimat_tipi || '') !== filters.teslim) return false;
                            if (filters.kargo && !(r.kargo_no || '').includes(filters.kargo)) return false;
                            if (filters.dolgu && !(r.dolgu || '').toLowerCase().includes(filters.dolgu)) return false;
                            if (filters.date_from && d && d < new Date(filters.date_from)) return false;
                            if (filters.date_to && d && d > new Date(filters.date_to + 'T23:59:59')) return false;
                            return true;
                        });
                    }
                    rows.sort((a, b) => Number(b.fis_no) - Number(a.fis_no)); // newest first
                    dt.clear().rows.add(rows).draw();
                });
            }
            loadOrders();

            // ---------- Filters ----------
            $('#btnSearch').on('click', function() {
                loadOrders({
                    fis: $('#f_fis').val().trim(),
                    date_from: $('#f_date_from').val(),
                    date_to: $('#f_date_to').val(),
                    marka: $('#f_marka').val().trim().toLowerCase(),
                    teslim: $('#f_teslim').val(),
                    kargo: $('#f_kargo').val().trim(),
                    dolgu: $('#f_dolgu').val().trim().toLowerCase(),
                });
            });
            $('#btnReset').on('click', function() {
                $('#f_fis,#f_date_from,#f_date_to,#f_marka,#f_teslim,#f_kargo,#f_dolgu').val('');
                loadOrders();
            });

            // ---------- View ----------
            $(document).on('click', '.act-view', function() {
                const fis = $(this).data('fis');

                // helpers
                const fmt = v => (v === null || v === undefined || v === '' ? '-' : v);
                const fmtDate = v => (v && v !== '0001-01-01' ? new Date(v).toLocaleDateString('tr-TR') : '-');
                const fmtNum = v => (v === null || v === undefined || v === '' ? '-' : Number(v).toLocaleString('tr-TR'));
                const yesno = v => (v === null || v === undefined || v === '' ? '-' : (Number(v) ? 'Evet' : 'Hayır'));
                const esc = s => fmt(s).toString().replace(/[&<>]/g, c => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;'
                } [c]));
                const br = s => esc(s).replace(/\n/g, '<br>');

                $.getJSON('{{ url("/order") }}/' + encodeURIComponent(fis)).done(o => {
                    const html = `
      <h6 class="col-12 mt-1 mb-2">Özet</h6>
      <dt class="col-4">Fis No</dt><dd class="col-8">${fmt(o.fis_no)}</dd>
      <dt class="col-4">Tarih</dt><dd class="col-8">${fmtDate(o.tarih)}</dd>
      <dt class="col-4">Termin Tarihi</dt><dd class="col-8">${fmtDate(o.termin_tarih)}</dd>
      <dt class="col-4">Şirket / Şube</dt><dd class="col-8">${esc(o.sirket)} / ${esc(o.sube)}</dd>
      <dt class="col-4">Marka</dt><dd class="col-8">${esc(o.marka)}</dd>
      <dt class="col-4">Konu</dt><dd class="col-8">${esc(o.konu)}</dd>
      <dt class="col-4">Teslimat Tipi</dt><dd class="col-8">${esc(o.teslimat_tipi)}</dd>
      <dt class="col-4">Kargo No</dt><dd class="col-8">${esc(o.kargo_no)}</dd>

      <h6 class="col-12 mt-3 mb-2">Müşteri</h6>
      <dt class="col-4">Cari Kod</dt><dd class="col-8">${esc(o.cari_kod)}</dd>
      <dt class="col-4">Cari Açıklama</dt><dd class="col-8">${esc(o.cari_aciklama)}</dd>
      <dt class="col-4">Yetkili</dt><dd class="col-8">${esc(o.yetkili)}</dd>
      <dt class="col-4">Sevk Adresi</dt><dd class="col-8">${br(o.sevk_adres)}</dd>
      <dt class="col-4">E-posta</dt><dd class="col-8">${esc(o.mail)}</dd>
      <dt class="col-4">Ödeme</dt><dd class="col-8">${br(o.odeme)}</dd>

      <h6 class="col-12 mt-3 mb-2">Açıklamalar</h6>
      <dt class="col-4">Açıklama</dt><dd class="col-8">${br(o.aciklama)}</dd>
      <dt class="col-4">Teklif Açıklama</dt><dd class="col-8">${br(o.teklif_aciklama)}</dd>

      <h6 class="col-12 mt-3 mb-2">Teklif</h6>
      <dt class="col-4">Döviz</dt><dd class="col-8">${esc(o.teklif_doviz)}</dd>
      <dt class="col-4">Kur</dt><dd class="col-8">${fmtNum(o.teklif_kur)}</dd>
      <dt class="col-4">Döviz Tutar</dt><dd class="col-8">${fmtNum(o.teklif_doviz_tutar)}</dd>
      <dt class="col-4">TL Tutar</dt><dd class="col-8">${fmtNum(o.teklif_tl_tutar)}</dd>
      <dt class="col-4">Ara Toplam</dt><dd class="col-8">${fmtNum(o.teklif_ara_toplam)}</dd>
      <dt class="col-4">Genel İskonto</dt><dd class="col-8">${fmtNum(o.genel_iskonto)}</dd>
      <dt class="col-4">İskonto Tip</dt><dd class="col-8">${fmtNum(o.iskonto_tip)}</dd>
      <dt class="col-4">İskonto</dt><dd class="col-8">${fmtNum(o.iskonto)}</dd>
      <dt class="col-4">Müşteri Teklif No</dt><dd class="col-8">${fmtNum(o.musteri_teklif_no)}</dd>
      <dt class="col-4">Müşteri Sipariş No</dt><dd class="col-8">${fmtNum(o.musteri_siparis_no)}</dd>
      <dt class="col-4">Teklif Durum</dt><dd class="col-8">${fmt(o.teklif_durum)}</dd>
      <dt class="col-4">Teklif Grubu</dt><dd class="col-8">${esc(o.teklif_grubu)}</dd>

      <h6 class="col-12 mt-3 mb-2">Onay / Durum</h6>
      <dt class="col-4">Sipariş Durum</dt><dd class="col-8">${esc(o.siparis_durum)}</dd>
      <dt class="col-4">Sipariş Durum (kod)</dt><dd class="col-8">${fmtNum(o.siparisDurum)}</dd>
      <dt class="col-4">Onay Durum</dt><dd class="col-8">${yesno(o.onay_durum)}</dd>
      <dt class="col-4">Onaylayan</dt><dd class="col-8">${esc(o.onaylayan)}</dd>
      <dt class="col-4">Onay Tarih</dt><dd class="col-8">${fmtDate(o.onay_tarih)}</dd>
      <dt class="col-4">Onay Not</dt><dd class="col-8">${esc(o.onay_not)}</dd>

      <h6 class="col-12 mt-3 mb-2">Yazdırma / Üretim</h6>
      <dt class="col-4">Sipariş Form Yazdır</dt><dd class="col-8">${yesno(o.siparis_form_yazdir_durum)}</dd>
      <dt class="col-4">Çıta Kesim Yazdır</dt><dd class="col-8">${yesno(o.cita_kesim_yazdir_durum)}</dd>
      <dt class="col-4">Mil Kesim Yazdır</dt><dd class="col-8">${yesno(o.mil_kesim_yazdir_durum)}</dd>
      <dt class="col-4">Kasa Kesim Yazdır</dt><dd class="col-8">${yesno(o.kasa_kesim_yazdir_durum)}</dd>
      <dt class="col-4">Büyük Etiket Yazdır</dt><dd class="col-8">${yesno(o.buyuk_etiket_yazdir_durum)}</dd>
      <dt class="col-4">Küçük Etiket Yazdır</dt><dd class="col-8">${yesno(o.kucuk_etiket_yazdir_durum)}</dd>
      <dt class="col-4">Üretim Fiş No</dt><dd class="col-8">${fmtNum(o.uretim_fis_no)}</dd>

      <h6 class="col-12 mt-3 mb-2">Muhasebe / Fatura</h6>
      <dt class="col-4">Fatura Durum</dt><dd class="col-8">${fmtNum(o.fatura_durum)}</dd>
      <dt class="col-4">Fatura Belge No</dt><dd class="col-8">${esc(o.fatura_belge_no)}</dd>
      <dt class="col-4">Ödeme Günü</dt><dd class="col-8">${fmtNum(o.odemeGunSayisi)}</dd>
      <dt class="col-4">Ödeme Türü</dt><dd class="col-8">${esc(o.odemeTuru)}</dd>

      <h6 class="col-12 mt-3 mb-2">Teknik / Diğer</h6>
      <dt class="col-4">İşlem Tarihi</dt><dd class="col-8">${fmtDate(o.islem_tarih)}</dd>
      <dt class="col-4">Hazırlayan</dt><dd class="col-8">${esc(o.hazirlayan)}</dd>
      <dt class="col-4">Kontrol Eden</dt><dd class="col-8">${esc(o.kontrol_eden)}</dd>
      <dt class="col-4">Alt Firma</dt><dd class="col-8">${esc(o.alt_firma)}</dd>
      <dt class="col-4">Depo</dt><dd class="col-8">${esc(o.depo)}</dd>
      <dt class="col-4">Bölüm</dt><dd class="col-8">${esc(o.bolum)}</dd>
      <dt class="col-4">Kopya No</dt><dd class="col-8">${fmtNum(o.kopya_no)}</dd>
      <dt class="col-4">Revize No</dt><dd class="col-8">${fmtNum(o.revize_no)}</dd>
      <dt class="col-4">Fiş Key</dt><dd class="col-8">${esc(o.fis_key)}</dd>
      <dt class="col-4">Sipariş No</dt><dd class="col-8">${fmtNum(o.siparisNo)}</dd>
      <dt class="col-4">Sipariş Durum Yedek</dt><dd class="col-8">${fmtNum(o.siparis_durum_yedek)}</dd>
      <dt class="col-4">Aktarım</dt><dd class="col-8">${yesno(o.aktarim)}</dd>
      <dt class="col-4">Aktarım Güncelle</dt><dd class="col-8">${yesno(o.aktarim_guncelle)}</dd>
      <dt class="col-4">ID</dt><dd class="col-8">${fmtNum(o.id)}</dd>
    `;

                    $('#viewBody').html(html);
                    $('#viewModal').modal('show');
                });
            });

            // ---------- Edit ----------
            $(document).on('click', '.act-edit', function() {
                const fis = $(this).data('fis');
                $.getJSON('{{ url("/order") }}/' + encodeURIComponent(fis)).done(o => {
                    $('#e_fis').val(o.fis_no || '');
                    $('#e_tarih').val((o.tarih || '').substring(0, 10));
                    $('#e_konu').val(o.konu || '');
                    $('#e_marka').val(o.marka || '');
                    $('#e_teslim').val(o.teslimat_tipi || '');
                    $('#e_kargo').val(o.kargo_no || '');
                    $('#e_dolgu').val(o.dolgu || '');
                    $('#editModal').modal('show');
                });
            });

            function fillSelect($select, options, placeholder = 'Seçiniz') {
                // If select2 already attached, destroy first so it picks up new options
                if ($select.data('select2')) {
                    $select.select2('destroy');
                }

                // Clear and add placeholder
                $select.empty();
                $select.append(new Option(placeholder, '', true, false)); // placeholder option

                // Fill options (array or map)
                if (Array.isArray(options)) {
                    options.forEach(v => $select.append(new Option(v, v)));
                } else if (options && typeof options === 'object') {
                    Object.entries(options).forEach(([value, text]) => {
                        $select.append(new Option(text, value));
                    });
                }

                // Re-init select2 AFTER options are in the DOM
                $select.select2({
                    width: '100%',
                    placeholder,
                    allowClear: true,
                    dropdownParent: $('.new-order') // important for modals
                });

                // reset selection
                $select.val(null).trigger('change'); // normal 'change' event
            }


            function fillFixed(name, arr) {
                const $s = $(`[name="${name}"]`).empty().append('<option value=""></option>');
                (arr || []).forEach(v => $s.append(`<option value="${v}">${v}</option>`));
            }
            let __REF_CACHE__ = null;

            function getRefData() {
                if (__REF_CACHE__) return $.Deferred().resolve(__REF_CACHE__).promise();
                return $.getJSON('{{ route("orders.ref") }}') // <-- use orderdetay.ref
                    .then(ref => (__REF_CACHE__ = ref || {}))
                    .fail(() => ({
                        mekanizma_yon: ['SOL', 'SAĞ'],
                        sistem: ['Zincirli', 'Doğrama Üzeri'],
                        slayt: ['Var', 'Yok'],
                        cam: ['Var', 'Yok'],
                        camkalinlik: [4, 6, 8, 10],
                        kasarenk: ['Siyah', 'Beyaz', 'Gri'],
                        renk: ['Siyah', 'Beyaz', 'Gri']
                    }));
            }


            function loadRefDataIntoForm() {
                const $renk = $('#renk');
                const $mekYon = $('#mekanizma_yon');
                const $sistem = $('#sistem');
                const $slayt = $('#slayt');
                const $cam = $('#cam');
                const $icCam = $('#ic_cam');
                const $disCam = $('#dis_cam');
                const $kasaRenk = $('#kasa_renk');
                const $altKasaRenk = $('#alt_kasa_renk');
                const $camCitaRenk = $('#cam_cita_renk');

                getRefData().then(ref => {
                    // adapt to your controller's keys; these are common names
                    fillSelect($renk, ref.renk);
                    fillSelect($mekYon, ref.mekanizma_yon);
                    fillSelect($sistem, ref.sistem);
                    fillSelect($slayt, ref.slayt);

                    fillSelect($cam, ref.cam);
                    fillSelect($icCam, ref.camkalinlik);
                    fillSelect($disCam, ref.camkalinlik);

                    fillSelect($kasaRenk, ref.kasarenk || ref.kasa_renk);
                    fillSelect($altKasaRenk, ref.kasarenk || ref.kasa_renk);
                    fillSelect($camCitaRenk, ref.kasarenk || ref.kasa_renk);
                });
            }

            // ---- Calculations ----
            function recalc() {
                const en = parseFloat(($('[name="en"]').val() || '').replace(',', '.')) || 0;
                const boy = parseFloat(($('[name="boy"]').val() || '').replace(',', '.')) || 0;
                const miktar = parseFloat(($('[name="miktar"]').val() || '').replace(',', '.')) || 0;
                const m2_fiyat = parseFloat(($('[name="m2_fiyat"]').val() || '').replace(',', '.')) || 0;

                let m2 = en * boy;
                if (m2 > 0 && m2 < 1) m2 = 1; // min 1 m2
                const tutar = miktar * m2 * m2_fiyat;

                $('#m2_view').val(m2 ? m2.toFixed(2) : '');
                $('#m2_hidden').val(m2 ? m2.toFixed(2) : '');
                $('#tutar_view').val(tutar ? tutar.toFixed(2) : '');
                $('#tutar_hidden').val(tutar ? tutar.toFixed(2) : '');
            }
            $(document).on('input change', '[name="en"],[name="boy"],[name="miktar"],[name="m2_fiyat"]', recalc);

            // Modal init
            $(document).on('shown.bs.modal', '.new-order', function() {
                const f = document.getElementById('orderForm');
                if (f) f.reset();
                $('#m2_view,#tutar_view,#m2_hidden,#tutar_hidden').val('');

                // 1) load dropdown options (this will also (re)initialize select2)
                loadRefDataIntoForm();

                // 2) (No need to init .select2() here anymore; fillSelect handles it)
            });

            // Submit
            $('#orderForm').on('submit', function(e) {
                e.preventDefault();
                recalc();
                $.post('{{ route("order.store") }}', $(this).serialize())
                    .done(() => {
                        $('.new-order').modal('hide');
                        loadOrders();
                    })
                    .fail(xhr => alert('Hata: ' + (xhr.responseJSON?.message || 'Kaydedilemedi')));
            });
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                const fis = $('#e_fis').val();
                $.ajax({
                    url: '{{ url("/order") }}/' + encodeURIComponent(fis),
                    method: 'PUT',
                    data: $(this).serialize()
                }).done(() => {
                    $('#editModal').modal('hide');
                    loadOrders(); // refresh list
                }).fail(xhr => alert(xhr.responseJSON?.message || 'Güncellenemedi'));
            });

            // ---------- Delete ----------
            $(document).on('click', '.act-del', function() {
                const fis = $(this).data('fis');
                if (!confirm('Silmek istediğinize emin misiniz? Fis: ' + fis)) return;
                $.ajax({
                    url: '{{ url("/order") }}/' + encodeURIComponent(fis),
                    method: 'DELETE'
                }).done(() => {
                    loadOrders();
                }).fail(xhr => alert(xhr.responseJSON?.message || 'Silinemedi'));
            });
        });
    </script>

</body>

</html>