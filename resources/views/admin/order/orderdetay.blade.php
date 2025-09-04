<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Order Detay</title>

    <link rel="stylesheet" href="{{asset('assets/admin/assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/css/components.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/css/custom.css')}}">
    <link rel='shortcut icon' type='image/x-icon' href="{{asset('assets/admin/assets/img/favicon.ico')}}" />
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
                            <h3 class="m-0 nav-link nav-link-lg text-dark">ORDER DETAY</h3>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li><a href="#" class="nav-link nav-link-lg fullscreen-btn"><i data-feather="maximize"></i></a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/admin/assets/img/user.png')}}" class="user-img-radious-style">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Hello</div>
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
                        <a href="{{url('/')}}"><img alt="image" src="{{asset('assets/admin/assets/img/logo.png')}}" class="header-logo" /></a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Main</li>
                        <li class="dropdown"><a href="{{url('/')}}" class="nav-link"><i class="fas fa-desktop"></i><span>Dashboard</span></a></li>
                        <li class="dropdown"><a href="{{url('order')}}" class="nav-link"><i class="fas fa-shopping-cart"></i><span>Orders</span></a></li>
                        <li class="dropdown active"><a href="{{url('orderdetay')}}" class="nav-link"><i class="fas fa-list"></i><span>Order Detay</span></a></li>
                        <li class="dropdown"><a href="{{url('user')}}" class="nav-link"><i class="fas fa-user"></i><span>Users</span></a></li>
                    </ul>
                </aside>
            </div>

            <!-- CONTENT -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end mb-2">
                                    <button class="btn btn-icon icon-left btn-dark" type="button" data-toggle="collapse" data-target="#filterWrap" aria-expanded="false" aria-controls="filterWrap">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <button id="btnNewOrder" class="btn btn-icon icon-left btn-primary ml-2" type="button" data-toggle="modal" data-target=".new-order">
                                        <i class="fas fa-plus-circle"></i> New Detail
                                    </button>
                                </div>
                            </div>

                            <!-- FILTERS -->
                            <div class="col-12 collapse" id="filterWrap">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h4 class="text-white">Filters</h4>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>Fis No</label>
                                                    <input id="f_fis" type="text" class="form-control" placeholder="486031">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>Mekanizma Yön</label>
                                                    <select id="f_mek" class="form-control select2">
                                                        <option value=""></option>
                                                        <option value="SOL">SOL</option>
                                                        <option value="SAĞ">SAĞ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>Cam</label>
                                                    <select id="f_cam" class="form-control select2">
                                                        <option value=""></option>
                                                        <option value="Var">Var</option>
                                                        <option value="Yok">Yok</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>Sistem</label>
                                                    <input id="f_sistem" type="text" class="form-control" placeholder="Zincirli">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>Renk</label>
                                                    <input id="f_renk" type="text" class="form-control" placeholder="#000 / Beyaz">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>Poz</label>
                                                    <input id="f_poz" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>En (min)</label>
                                                    <input id="f_en_min" type="number" step="0.01" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>En (max)</label>
                                                    <input id="f_en_max" type="number" step="0.01" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>Boy (min)</label>
                                                    <input id="f_boy_min" type="number" step="0.01" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>Boy (max)</label>
                                                    <input id="f_boy_max" type="number" step="0.01" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>M2 Fiyat (min)</label>
                                                    <input id="f_fiyat_min" type="number" step="0.01" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>M2 Fiyat (max)</label>
                                                    <input id="f_fiyat_max" type="number" step="0.01" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>Tutar Döviz (min)</label>
                                                    <input id="f_tutar_min" type="number" step="0.01" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-2">
                                                    <label>Tutar Döviz (max)</label>
                                                    <input id="f_tutar_max" type="number" step="0.01" class="form-control">
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

                            <!-- DETAILS TABLE -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h4 class="text-white">Order Detay</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="dt-detay" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width:160px">Action</th>
                                                        <th>Fis No</th>
                                                        <th>En</th>
                                                        <th>Boy</th>
                                                        <th>Miktar</th>
                                                        <th>M2</th>
                                                        <th>M2 Fiyatı</th>
                                                        <th>Tutar Döviz</th>
                                                        <th>Renk</th>
                                                        <th>Mekanizma Yön</th>
                                                        <th>Sistem</th>
                                                        <th>Slayt</th>
                                                        <th>Cam</th>
                                                        <th>İç Cam</th>
                                                        <th>Dış Cam</th>
                                                        <th>Kasa Renk</th>
                                                        <th>Alt Kasa</th>
                                                        <th>Cam Çıtası</th>
                                                        <th>Poz</th>
                                                        <th>Açıklama</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
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
                            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme"><i class="fas fa-undo"></i> Restore Default</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="main-footer">
                <div class="footer-left"><a href="#">Templateshub</a></div>
                <div class="footer-right"></div>
            </footer>
        </div>
    </div>

    <!-- Create Detail Modal (uses your working order.store) -->
    <div class="modal fade new-order" tabindex="-1" role="dialog" aria-labelledby="newOrderModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary p-3">
                    <h5 class="modal-title text-white">New Detail</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>

                <div class="modal-body">
                    <form id="orderForm">@csrf
                        <div class="form-row">
                            <div class="form-group col-md-3"><label>En</label><input name="en" class="form-control" type="number" step="0.01" required></div>
                            <div class="form-group col-md-3"><label>Boy</label><input name="boy" class="form-control" type="number" step="0.01" required></div>
                            <div class="form-group col-md-3"><label>Miktar</label><input name="miktar" class="form-control" type="number" step="1" value="1" required></div>
                            <div class="form-group col-md-3"><label>M2 Fiyatı</label><input name="m2_fiyat" class="form-control" type="number" step="0.01" required></div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6"><label>Açıklama</label><input name="aciklama" class="form-control"></div>
                            <div class="form-group col-md-6"><label>Poz</label><input name="poz" class="form-control"></div>
                        </div>

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

                        <button type="button" class="btn btn-light mb-2" data-toggle="collapse" data-target="#moreFields">Diğer Alanlar</button>
                        <div id="moreFields" class="collapse">
                            <div class="form-row">
                                <div class="form-group col-md-3"><label>Renk</label><input name="renk" type="text" class="form-control" placeholder="#000 / Beyaz"></div>
                                <div class="form-group col-md-3"><label>Mekanizma Yön</label><select name="mekanizma_yon" class="form-control">
                                        <option></option>
                                        <option>SOL</option>
                                        <option>SAĞ</option>
                                    </select></div>
                                <div class="form-group col-md-3"><label>Sistem</label><input name="sistem" class="form-control" placeholder="Zincirli"></div>
                                <div class="form-group col-md-3"><label>Slayt</label><input name="slayt" class="form-control"></div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3"><label>Cam</label><select name="cam" class="form-control" required>
                                        <option></option>
                                        <option>Var</option>
                                        <option>Yok</option>
                                    </select></div>
                                <div class="form-group col-md-3"><label>İç Cam</label><input name="ic_cam" class="form-control"></div>
                                <div class="form-group col-md-3"><label>Dış Cam</label><input name="dis_cam" class="form-control"></div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3"><label>Kasa Renk</label><input name="kasa_renk" class="form-control"></div>
                                <div class="form-group col-md-3"><label>Alt Kasa</label><input name="alt_kasa_renk" class="form-control"></div>
                                <div class="form-group col-md-3"><label>Cam Çıtası</label><input name="cam_cita_renk" class="form-control"></div>
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

    <!-- VIEW MODAL -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info p-3">
                    <h5 class="modal-title text-white">Detay Görüntüle</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <dl class="row mb-0" id="viewBody"></dl>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning p-3">
                    <h5 class="modal-title text-white">Detay Düzenle</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="editForm">@csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="e_id">
                        <div class="form-row">
                            <div class="form-group col-md-3"><label>Fis No</label><input id="e_fis" class="form-control" readonly></div>
                            <div class="form-group col-md-3"><label>En</label><input name="en" id="e_en" type="number" step="0.01" class="form-control" required></div>
                            <div class="form-group col-md-3"><label>Boy</label><input name="boy" id="e_boy" type="number" step="0.01" class="form-control" required></div>
                            <div class="form-group col-md-3"><label>Miktar</label><input name="miktar" id="e_miktar" type="number" step="1" class="form-control" required></div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3"><label>M2</label><input id="e_m2_view" class="form-control" readonly><input type="hidden" name="m2" id="e_m2_hidden"></div>
                            <div class="form-group col-md-3"><label>M2 Fiyat</label><input name="m2_fiyat" id="e_fiyat" type="number" step="0.01" class="form-control" required></div>
                            <div class="form-group col-md-3"><label>Tutar Döviz</label><input id="e_tutar_view" class="form-control" readonly><input type="hidden" name="tutar_doviz" id="e_tutar_hidden"></div>
                            <div class="form-group col-md-3"><label>Poz</label><input name="poz" id="e_poz" class="form-control"></div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3"><label>Renk</label><input name="renk" id="e_renk" class="form-control"></div>
                            <div class="form-group col-md-3"><label>Mekanizma Yön</label><select name="mekanizma_yon" id="e_mek" class="form-control">
                                    <option></option>
                                    <option>SOL</option>
                                    <option>SAĞ</option>
                                </select></div>
                            <div class="form-group col-md-3"><label>Sistem</label><input name="sistem" id="e_sistem" class="form-control"></div>
                            <div class="form-group col-md-3"><label>Slayt</label><input name="slayt" id="e_slayt" class="form-control"></div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3"><label>Cam</label><select name="cam" id="e_cam" class="form-control">
                                    <option></option>
                                    <option>Var</option>
                                    <option>Yok</option>
                                </select></div>
                            <div class="form-group col-md-3"><label>İç Cam</label><input name="ic_cam" id="e_ic" class="form-control"></div>
                            <div class="form-group col-md-3"><label>Dış Cam</label><input name="dis_cam" id="e_dis" class="form-control"></div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3"><label>Kasa Renk</label><input name="kasa_renk" id="e_kasa" class="form-control"></div>
                            <div class="form-group col-md-3"><label>Alt Kasa</label><input name="alt_kasa_renk" id="e_altkasa" class="form-control"></div>
                            <div class="form-group col-md-3"><label>Cam Çıtası</label><input name="cam_cita_renk" id="e_cita" class="form-control"></div>
                            <div class="form-group col-md-12"><label>Açıklama</label><textarea name="aciklama" id="e_aciklama" class="form-control" rows="2"></textarea></div>
                        </div>

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
            const dt = $('#dt-detay').DataTable({
                destroy: true,
                pageLength: 25,
                order: [
                    [1, 'desc']
                ], // newest by Fis No (col 1)
                data: [],
                columns: [{
                        data: null,
                        orderable: false,
                        render: r => `
              <div class="btn-group btn-group-sm">
                <button class="btn btn-info act-view"  data-id="${r.id}">View</button>
                <button class="btn btn-warning act-edit" data-id="${r.id}">Edit</button>
                <button class="btn btn-danger act-del"   data-id="${r.id}">Delete</button>
              </div>`
                    },
                    {
                        data: 'fis_no',
                        title: 'Fis No',
                        render: d => Number(d)
                    },
                    {
                        data: 'en',
                        title: 'En',
                        render: v => num(v)
                    },
                    {
                        data: 'boy',
                        title: 'Boy',
                        render: v => num(v)
                    },
                    {
                        data: 'miktar',
                        title: 'Miktar',
                        render: v => num(v, 0)
                    },
                    {
                        data: 'm2',
                        title: 'M2',
                        render: (v, _, row) => num(row.m2 ?? calcM2(row.en, row.boy))
                    },
                    {
                        data: 'm2_fiyat',
                        title: 'M2 Fiyatı',
                        render: v => num(v)
                    },
                    {
                        data: 'tutar_doviz',
                        title: 'Tutar Döviz',
                        render: v => num(v)
                    },
                    {
                        data: 'renk',
                        title: 'Renk',
                        defaultContent: '-'
                    },
                    {
                        data: 'mekanizma_yon',
                        title: 'Mekanizma Yön',
                        defaultContent: '-'
                    },
                    {
                        data: 'sistem',
                        title: 'Sistem',
                        defaultContent: '-'
                    },
                    {
                        data: 'slayt',
                        title: 'Slayt',
                        defaultContent: '-'
                    },
                    {
                        data: 'cam',
                        title: 'Cam',
                        defaultContent: '-'
                    },
                    {
                        data: 'ic_cam',
                        title: 'İç Cam',
                        defaultContent: '-'
                    },
                    {
                        data: 'dis_cam',
                        title: 'Dış Cam',
                        defaultContent: '-'
                    },
                    {
                        data: 'kasa_renk',
                        title: 'Kasa Renk',
                        defaultContent: '-'
                    },
                    {
                        data: 'alt_kasa_renk',
                        title: 'Alt Kasa',
                        defaultContent: '-'
                    },
                    {
                        data: 'cam_cita_renk',
                        title: 'Cam Çıtası',
                        defaultContent: '-'
                    },
                    {
                        data: 'poz',
                        title: 'Poz',
                        defaultContent: '-'
                    },
                    {
                        data: 'aciklama',
                        title: 'Açıklama',
                        render: v => (v ? esc(v).slice(0, 60) + (v.length > 60 ? '…' : '') : '-')
                    }
                ]
            });

            // Helpers
            const esc = s => (s ?? '').toString().replace(/[&<>]/g, c => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;'
            } [c]));
            const num = (v, dec = 2) => (v == null || v === '') ? '-' : Number(v).toLocaleString('tr-TR', {
                minimumFractionDigits: dec,
                maximumFractionDigits: dec
            });
            const calcM2 = (en, boy) => {
                const e = parseFloat(en) || 0,
                    b = parseFloat(boy) || 0;
                let m2 = e * b;
                if (m2 > 0 && m2 < 1) m2 = 1;
                return m2;
            };

            // ---------- Fetch + client filtering ----------
            function loadDetails(filters = null) {
                $.getJSON('{{ route("orderdetay.data") }}').done(rows => {
                    if (filters) {
                        rows = rows.filter(r => {
                            const toNum = x => parseFloat(x || '');
                            // text contains/equals
                            if (filters.fis && !String(r.fis_no || '').includes(filters.fis)) return false;
                            if (filters.mek && (r.mekanizma_yon || '') !== filters.mek) return false;
                            if (filters.cam && (r.cam || '') !== filters.cam) return false;
                            if (filters.sistem && !(r.sistem || '').toLowerCase().includes(filters.sistem)) return false;
                            if (filters.renk && !(r.renk || '').toLowerCase().includes(filters.renk)) return false;
                            if (filters.poz && !(r.poz || '').toLowerCase().includes(filters.poz)) return false;
                            // numeric ranges
                            if (filters.en_min != null && toNum(r.en) < filters.en_min) return false;
                            if (filters.en_max != null && toNum(r.en) > filters.en_max) return false;
                            if (filters.boy_min != null && toNum(r.boy) < filters.boy_min) return false;
                            if (filters.boy_max != null && toNum(r.boy) > filters.boy_max) return false;
                            if (filters.fiyat_min != null && toNum(r.m2_fiyat) < filters.fiyat_min) return false;
                            if (filters.fiyat_max != null && toNum(r.m2_fiyat) > filters.fiyat_max) return false;
                            if (filters.tutar_min != null && toNum(r.tutar_doviz) < filters.tutar_min) return false;
                            if (filters.tutar_max != null && toNum(r.tutar_doviz) > filters.tutar_max) return false;
                            return true;
                        });
                    }
                    // newest first by fis_no then id
                    rows.sort((a, b) => (Number(b.fis_no) - Number(a.fis_no)) || (Number(b.id || 0) - Number(a.id || 0)));
                    dt.clear().rows.add(rows).draw();
                });
            }
            loadDetails();

            // ---------- Filters ----------
            $('#btnSearch').on('click', function() {
                const parse = v => v === '' ? null : parseFloat(v);
                loadDetails({
                    fis: $('#f_fis').val().trim(),
                    mek: $('#f_mek').val(),
                    cam: $('#f_cam').val(),
                    sistem: $('#f_sistem').val().trim().toLowerCase(),
                    renk: $('#f_renk').val().trim().toLowerCase(),
                    poz: $('#f_poz').val().trim().toLowerCase(),
                    en_min: parse($('#f_en_min').val()),
                    en_max: parse($('#f_en_max').val()),
                    boy_min: parse($('#f_boy_min').val()),
                    boy_max: parse($('#f_boy_max').val()),
                    fiyat_min: parse($('#f_fiyat_min').val()),
                    fiyat_max: parse($('#f_fiyat_max').val()),
                    tutar_min: parse($('#f_tutar_min').val()),
                    tutar_max: parse($('#f_tutar_max').val()),
                });
            });
            $('#btnReset').on('click', function() {
                $('#filterWrap').find('input').val('');
                $('#f_mek,#f_cam').val('').trigger('change');
                loadDetails();
            });

            // ---------- Create (uses your existing route) ----------
            function recalcCreate() {
                const en = parseFloat(($('[name="en"]').val() || '').replace(',', '.')) || 0;
                const boy = parseFloat(($('[name="boy"]').val() || '').replace(',', '.')) || 0;
                const miktar = parseFloat(($('[name="miktar"]').val() || '').replace(',', '.')) || 0;
                const fiyat = parseFloat(($('[name="m2_fiyat"]').val() || '').replace(',', '.')) || 0;
                let m2 = en * boy;
                if (m2 > 0 && m2 < 1) m2 = 1;
                const tutar = miktar * m2 * fiyat;
                $('#m2_view').val(m2 ? m2.toFixed(2) : '');
                $('#m2_hidden').val(m2 ? m2.toFixed(2) : '');
                $('#tutar_view').val(tutar ? tutar.toFixed(2) : '');
                $('#tutar_hidden').val(tutar ? tutar.toFixed(2) : '');
            }
            $(document).on('input change', '[name="en"],[name="boy"],[name="miktar"],[name="m2_fiyat"]', recalcCreate);

            $(document).on('shown.bs.modal', '.new-order', function() {
                const f = document.getElementById('orderForm');
                if (f) f.reset();
                $('#m2_view,#tutar_view,#m2_hidden,#tutar_hidden').val('');
            });

            $('#orderForm').on('submit', function(e) {
                e.preventDefault();
                recalcCreate();
                $.post('{{ route("order.store") }}', $(this).serialize())
                    .done(() => {
                        $('.new-order').modal('hide');
                        loadDetails();
                    })
                    .fail(xhr => alert('Hata: ' + (xhr.responseJSON?.message || 'Kaydedilemedi')));
            });

            // ---------- View ----------
            $(document).on('click', '.act-view', function() {
                const id = $(this).data('id');
                $.getJSON('{{ url("/orderdetay") }}/' + id).done(r => {
                    const br = s => esc(s || '').replace(/\n/g, '<br>');
                    const html = `
            <dt class="col-4">ID</dt><dd class="col-8">${r.id ?? '-'}</dd>
            <dt class="col-4">Fis No</dt><dd class="col-8">${r.fis_no ?? '-'}</dd>
            <dt class="col-4">En</dt><dd class="col-8">${r.en ?? '-'}</dd>
            <dt class="col-4">Boy</dt><dd class="col-8">${r.boy ?? '-'}</dd>
            <dt class="col-4">Miktar</dt><dd class="col-8">${r.miktar ?? '-'}</dd>
            <dt class="col-4">M2</dt><dd class="col-8">${r.m2 ?? '-'}</dd>
            <dt class="col-4">M2 Fiyat</dt><dd class="col-8">${r.m2_fiyat ?? '-'}</dd>
            <dt class="col-4">Tutar Döviz</dt><dd class="col-8">${r.tutar_doviz ?? '-'}</dd>
            <dt class="col-4">Renk</dt><dd class="col-8">${esc(r.renk)}</dd>
            <dt class="col-4">Mekanizma Yön</dt><dd class="col-8">${esc(r.mekanizma_yon)}</dd>
            <dt class="col-4">Sistem</dt><dd class="col-8">${esc(r.sistem)}</dd>
            <dt class="col-4">Slayt</dt><dd class="col-8">${esc(r.slayt)}</dd>
            <dt class="col-4">Cam</dt><dd class="col-8">${esc(r.cam)}</dd>
            <dt class="col-4">İç Cam</dt><dd class="col-8">${esc(r.ic_cam)}</dd>
            <dt class="col-4">Dış Cam</dt><dd class="col-8">${esc(r.dis_cam)}</dd>
            <dt class="col-4">Kasa Renk</dt><dd class="col-8">${esc(r.kasa_renk)}</dd>
            <dt class="col-4">Alt Kasa</dt><dd class="col-8">${esc(r.alt_kasa_renk)}</dd>
            <dt class="col-4">Cam Çıtası</dt><dd class="col-8">${esc(r.cam_cita_renk)}</dd>
            <dt class="col-4">Poz</dt><dd class="col-8">${esc(r.poz)}</dd>
            <dt class="col-4">Açıklama</dt><dd class="col-8">${br(r.aciklama)}</dd>
          `;
                    $('#viewBody').html(html);
                    $('#viewModal').modal('show');
                });
            });

            // ---------- Edit ----------
            function recalcEdit() {
                const en = parseFloat($('#e_en').val() || '') || 0;
                const boy = parseFloat($('#e_boy').val() || '') || 0;
                const miktar = parseFloat($('#e_miktar').val() || '') || 0;
                const fiyat = parseFloat($('#e_fiyat').val() || '') || 0;
                let m2 = en * boy;
                if (m2 > 0 && m2 < 1) m2 = 1;
                const tutar = miktar * m2 * fiyat;
                $('#e_m2_view').val(m2 ? m2.toFixed(2) : '');
                $('#e_m2_hidden').val(m2 ? m2.toFixed(2) : '');
                $('#e_tutar_view').val(tutar ? tutar.toFixed(2) : '');
                $('#e_tutar_hidden').val(tutar ? tutar.toFixed(2) : '');
            }
            $(document).on('input change', '#e_en,#e_boy,#e_miktar,#e_fiyat', recalcEdit);

            $(document).on('click', '.act-edit', function() {
                const id = $(this).data('id');
                $.getJSON('{{ url("/orderdetay") }}/' + id).done(r => {
                    $('#e_id').val(r.id || '');
                    $('#e_fis').val(r.fis_no || '');
                    $('#e_en').val(r.en || '');
                    $('#e_boy').val(r.boy || '');
                    $('#e_miktar').val(r.miktar || 1);
                    $('#e_fiyat').val(r.m2_fiyat || '');
                    $('#e_poz').val(r.poz || '');
                    $('#e_renk').val(r.renk || '');
                    $('#e_mek').val(r.mekanizma_yon || '');
                    $('#e_sistem').val(r.sistem || '');
                    $('#e_slayt').val(r.slayt || '');
                    $('#e_cam').val(r.cam || '');
                    $('#e_ic').val(r.ic_cam || '');
                    $('#e_dis').val(r.dis_cam || '');
                    $('#e_kasa').val(r.kasa_renk || '');
                    $('#e_altkasa').val(r.alt_kasa_renk || '');
                    $('#e_cita').val(r.cam_cita_renk || '');
                    $('#e_aciklama').val(r.aciklama || '');
                    // derived
                    $('#e_m2_view').val(r.m2 || '');
                    $('#e_m2_hidden').val(r.m2 || '');
                    $('#e_tutar_view').val(r.tutar_doviz || '');
                    $('#e_tutar_hidden').val(r.tutar_doviz || '');
                    $('#editModal').modal('show');
                });
            });

            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                recalcEdit();
                const id = $('#e_id').val();
                $.ajax({
                        url: '{{ url("/orderdetay") }}/' + encodeURIComponent(id),
                        method: 'PUT',
                        data: $(this).serialize()
                    }).done(() => {
                        $('#editModal').modal('hide');
                        loadDetails();
                    })
                    .fail(xhr => alert(xhr.responseJSON?.message || 'Güncellenemedi'));
            });

            // ---------- Delete ----------
            $(document).on('click', '.act-del', function() {
                const id = $(this).data('id');
                if (!confirm('Bu detay satırını silmek istiyor musunuz? ID: ' + id)) return;
                $.ajax({
                        url: '{{ url("/orderdetay") }}/' + encodeURIComponent(id),
                        method: 'DELETE'
                    }).done(() => loadDetails())
                    .fail(xhr => alert(xhr.responseJSON?.message || 'Silinemedi'));
            });

        });
    </script>
</body>

</html>