@extends('master')
@section('content')
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="d-flex justify-content-end mb-2">
                                    <button class="btn btn-icon icon-left btn-dark" type="button" data-toggle="collapse"
                                        data-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        <i class="fas fa-filter"></i>
                                        Filter
                                    </button>
                                    <a href="#" class="btn btn-icon icon-left btn-primary" style="margin-left: 20px;"
                                        type="button"><i class="fas fa-plus-circle"></i>
                                        Add User
                                    </a>
                                    <!-- data-toggle="modal" data-target=".new-order"  -->
                                </div>
                            </div>
                            <div class="col-12 collapse" id="collapseExample">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h4 class="text-white">Filters</h4>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label>User Id</label>
                                                    <input type="text" placeholder="User Id" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label>User Name</label>
                                                    <select class="form-control select2">
                                                        <option selected disabled>User Name</option>
                                                        <option>John Doe</option>
                                                        <option>Jane Smith</option>
                                                        <option>Ali Khan</option>
                                                        <option>Maria Garcia</option>
                                                        <option>David Patel</option>
                                                        <option>Linda Lee</option>
                                                        <option>Ahmed Omar</option>
                                                        <option>Emily Zhang</option>
                                                        <option>Sachin Mehta</option>
                                                        <option>Ayesha Noor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label>Status</label>
                                                    <select class="form-control select2">
                                                        <option selected disabled>Status</option>
                                                        <option>Active</option>
                                                        <option>In Progress</option>
                                                        <option>Banned</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-6 col-sm-12 pt-2">
                                                <div class="h-100 d-flex justify-content-end align-items-center">
                                                    <button class="btn btn-icon icon-left btn-dark"
                                                        style="margin-left: 20px;" type="button">
                                                        <i class="fas fa-times"></i>
                                                        Reset
                                                    </button>
                                                    <button class="btn btn-icon icon-left btn-primary"
                                                        style="margin-left: 20px;" type="button">
                                                        <i class="fas fa-search"></i>
                                                        Search
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h4 class="text-white">Users</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="save-stage"
                                                style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Action</th>
                                                        <th>User Id</th>
                                                        <th>User Name</th>
                                                        <th>Phone #</th>
                                                        <th>Status</th>
                                                        <th>Created Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a href="profile.html" class="dropdown-item has-icon"><i
                                                                    class="far fa-edit"></i></a></td>
                                                        <td>1003</td>
                                                        <td>John Doe</td>
                                                        <td>9876543210</td>
                                                        <td>
                                                            <div class="badge badge-warning badge-shadow">In Progress
                                                            </div>
                                                        </td>
                                                        <td>06/06/2025</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="profile.html" class="dropdown-item has-icon"><i
                                                                    class="far fa-edit"></i></a></td>
                                                        <td>1004</td>
                                                        <td>Jane Smith</td>
                                                        <td>9123456789</td>
                                                        <td>
                                                            <div class="badge badge-success badge-shadow">Active</div>
                                                        </td>
                                                        <td>02/06/2025</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="profile.html" class="dropdown-item has-icon"><i
                                                                    class="far fa-edit"></i></a></td>
                                                        <td>1005</td>
                                                        <td>Ali Khan</td>
                                                        <td>9988776655</td>
                                                        <td>
                                                            <div class="badge badge-danger badge-shadow">Banned</div>
                                                        </td>
                                                        <td>01/06/2025</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="profile.html" class="dropdown-item has-icon"><i
                                                                    class="far fa-edit"></i></a></td>
                                                        <td>1006</td>
                                                        <td>Maria Garcia</td>
                                                        <td>8877665544</td>
                                                        <td>
                                                            <div class="badge badge-success badge-shadow">Active</div>
                                                        </td>
                                                        <td>04/06/2025</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="profile.html" class="dropdown-item has-icon"><i
                                                                    class="far fa-edit"></i></a></td>
                                                        <td>1007</td>
                                                        <td>David Patel</td>
                                                        <td>9001122334</td>
                                                        <td>
                                                            <div class="badge badge-warning badge-shadow">In Progress
                                                            </div>
                                                        </td>
                                                        <td>03/06/2025</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="profile.html" class="dropdown-item has-icon"><i
                                                                    class="far fa-edit"></i></a></td>
                                                        <td>1008</td>
                                                        <td>Linda Lee</td>
                                                        <td>9911223344</td>
                                                        <td>
                                                            <div class="badge badge-success badge-shadow">Active</div>
                                                        </td>
                                                        <td>05/06/2025</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="profile.html" class="dropdown-item has-icon"><i
                                                                    class="far fa-edit"></i></a></td>
                                                        <td>1009</td>
                                                        <td>Ahmed Omar</td>
                                                        <td>9345678901</td>
                                                        <td>
                                                            <div class="badge badge-danger badge-shadow">Banned</div>
                                                        </td>
                                                        <td>07/06/2025</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="profile.html" class="dropdown-item has-icon"><i
                                                                    class="far fa-edit"></i></a></td>
                                                        <td>1010</td>
                                                        <td>Emily Zhang</td>
                                                        <td>9765432109</td>
                                                        <td>
                                                            <div class="badge badge-success badge-shadow">Active</div>
                                                        </td>
                                                        <td>08/06/2025</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="profile.html" class="dropdown-item has-icon"><i
                                                                    class="far fa-edit"></i></a></td>
                                                        <td>1011</td>
                                                        <td>Sachin Mehta</td>
                                                        <td>9223344556</td>
                                                        <td>
                                                            <div class="badge badge-info badge-shadow">Pending</div>
                                                        </td>
                                                        <td>09/06/2025</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="profile.html" class="dropdown-item has-icon"><i
                                                                    class="far fa-edit"></i></a></td>
                                                        <td>1012</td>
                                                        <td>Ayesha Noor</td>
                                                        <td>9334455667</td>
                                                        <td>
                                                            <div class="badge badge-success badge-shadow">Active</div>
                                                        </td>
                                                        <td>10/06/2025</td>
                                                    </tr>
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

</body>


<!-- widget-chart.html  21 Nov 2019 03:50:03 GMT -->

</html>
@endsection