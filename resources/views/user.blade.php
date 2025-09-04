@extends('master')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 ">
                    <div class="d-flex justify-content-end mb-2">
                        <button id="btnNewUser" class="btn btn-icon icon-left btn-primary" type="button" data-toggle="modal" data-target=".new-user">
                            <i class="fas fa-user-plus"></i> New User
                        </button>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">Users</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="users-table" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:140px">Action</th>
                                            <th>ID</th>
                                            <th>Kod</th>
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Bölüm</th>
                                            <th>Unvan</th>
                                            <th>Mail</th>
                                            <th>Kullanıcı Tip</th>
                                            <th>Bayi</th>
                                            <th>Bayi Kod</th>
                                            <th>Günlük Hedef</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <!-- New/Edit Modal -->
                            <div class="modal fade new-user" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary p-3">
                                            <h5 class="modal-title text-white" id="userModalTitle">New User</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="userForm">@csrf
                                                <input type="hidden" name="_method" value="POST">
                                                <input type="hidden" id="user_id">

                                                <div class="form-group"><label>Kod</label><input name="kod" class="form-control" required></div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6"><label>Ad</label><input name="ad" class="form-control" required></div>
                                                    <div class="form-group col-md-6"><label>Soyad</label><input name="soyad" class="form-control"></div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6"><label>Bölüm</label><input name="bolum" class="form-control"></div>
                                                    <div class="form-group col-md-6"><label>Unvan</label><input name="unvan" class="form-control"></div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6"><label>Mail</label><input name="mail" type="email" class="form-control"></div>
                                                    <div class="form-group col-md-6"><label>Kullanıcı Tip</label><input name="kullanici_tip" class="form-control" placeholder="admin / user"></div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6"><label>Bayi</label>
                                                        <select name="bayi" class="form-control select2">
                                                            <option value=""></option>
                                                            <option value="1">Evet</option>
                                                            <option value="0">Hayır</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6"><label>Bayi Kod</label><input name="bayi_kod" class="form-control"></div>
                                                </div>
                                                <div class="form-group"><label>Günlük Hedef</label><input name="gunluk_hedef" type="number" step="0.01" class="form-control"></div>

                                                <div class="d-flex"><button type="submit" class="btn btn-primary ml-auto">Kaydet</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /modal -->

                            <!-- View Modal -->
                            <div class="modal fade" id="userView" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info p-3">
                                            <h5 class="modal-title text-white">User Detail</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row mb-0" id="userViewBody"></dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection

@php
$userData = route('user.data');
$userStore = route('user.store');
@endphp

<script>
    $(function() {
        // Select2 in modal
        $('.new-user .select2').select2({
            width: '100%',
            allowClear: true,
            placeholder: 'Seçiniz',
            dropdownParent: $('.new-user')
        });

        const dt = $('#users-table').DataTable({
            destroy: true,
            pageLength: 25,
            data: [],
            order: [
                [1, 'desc']
            ],
            columns: [{
                    data: null,
                    orderable: false,
                    render: r => `
        <div class="btn-group btn-group-sm">
          <button class="btn btn-info   u-view" data-id="${r.id}">View</button>
          <button class="btn btn-warning u-edit" data-id="${r.id}">Edit</button>
          <button class="btn btn-danger  u-del"  data-id="${r.id}">Delete</button>
        </div>`
                },
                {
                    data: 'id'
                }, {
                    data: 'kod'
                }, {
                    data: 'ad'
                }, {
                    data: 'soyad'
                }, {
                    data: 'bolum'
                }, {
                    data: 'unvan'
                },
                {
                    data: 'mail'
                }, {
                    data: 'kullanici_tip'
                },
                {
                    data: 'bayi',
                    render: v => v == 1 ? 'Evet' : (v == 0 ? 'Hayır' : '-')
                },
                {
                    data: 'bayi_kod'
                }, {
                    data: 'gunluk_hedef'
                }
            ]
        });

        function loadUsers(q = '') {
            $.getJSON(@json($userData), {
                q
            }).done(rows => {
                dt.clear().rows.add(rows).draw();
            });
        }
        loadUsers();

        // New
        $('#btnNewUser').on('click', function() {
            $('#userModalTitle').text('New User');
            $('#userForm')[0].reset();
            $('#user_id').val('');
            $('[name=_method]').val('POST');
            $('.new-user').modal('show');
        });

        // View
        $(document).on('click', '.u-view', function() {
            const id = $(this).data('id');
            $.getJSON('{{ url("/user") }}/' + id).done(o => {
                const fmt = v => (v === null || v === undefined || v === '') ? '-' : v;
                const html = Object.entries(o).map(([k, v]) => `<dt class="col-4">${k}</dt><dd class="col-8">${fmt(v)}</dd>`).join('');
                $('#userViewBody').html(html);
                $('#userView').modal('show');
            });
        });

        // Edit
        $(document).on('click', '.u-edit', function() {
            const id = $(this).data('id');
            $.getJSON('{{ url("/user") }}/' + id).done(o => {
                $('#userModalTitle').text('Edit User');
                $('#user_id').val(o.id);
                $('[name=_method]').val('PUT');
                for (const [k, v] of Object.entries(o)) {
                    const $el = $('[name="' + k + '"]');
                    if (!$el.length) continue;
                    if ($el.is('select')) $el.val(String(v)).trigger('change');
                    else $el.val(v);
                }
                $('.new-user').modal('show');
            });
        });

        // Save
        $('#userForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#user_id').val();
            const method = $('[name=_method]').val();
            const url = method === 'PUT' ? ('{{ url("/user") }}/' + id) : @json($userStore);
            $.ajax({
                    url,
                    method: 'POST',
                    data: $(this).serialize()
                })
                .done(() => {
                    $('.new-user').modal('hide');
                    loadUsers();
                })
                .fail(xhr => alert(xhr.responseJSON?.message || 'Kaydedilemedi'));
        });

        // Delete
        $(document).on('click', '.u-del', function() {
            const id = $(this).data('id');
            if (!confirm('Silinsin mi?')) return;
            $.ajax({
                    url: '{{ url("/user") }}/' + id,
                    method: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: $('meta[name=csrf-token]').attr('content')
                    }
                })
                .done(() => loadUsers())
                .fail(xhr => alert(xhr.responseJSON?.message || 'Silinemedi'));
        });

    });
</script>