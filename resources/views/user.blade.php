{{-- resources/views/admin/user/index.blade.php --}}
@extends('master')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">

            {{-- Add / Edit (inline) --}}
            <div class="card mb-4">
                <div class="card-header bg-primary d-flex align-items-center justify-content-between">
                    <h4 class="text-white mb-0" id="formTitle">New User</h4>
                    <button type="button" class="btn btn-light btn-sm" id="btnReset">Reset</button>
                </div>
                <div class="card-body">
                    <form id="userForm" autocomplete="off">
                        @csrf
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" id="user_id">

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Kod <span class="text-danger">*</span></label>
                                <input name="kod" class="form-control" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Ad <span class="text-danger">*</span></label>
                                <input name="ad" class="form-control" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Soyad</label>
                                <input name="soyad" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Mail</label>
                                <input name="mail" type="email" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Bölüm</label>
                                <input name="bolum" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Unvan</label>
                                <input name="unvan" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Kullanıcı Tip <span class="text-danger">*</span></label>
                                <select name="kullanici_tip" class="form-control" required>
                                    <option value="">Seçiniz</option>
                                    <option value="0">Admin</option>
                                    <option value="1">User</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Günlük Hedef</label>
                                <input name="gunluk_hedef" type="number" step="0.01" class="form-control">
                            </div>
                        </div>

                        {{-- NEW: Şifre field --}}
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Şifre</label>
                                <div class="input-group">
                                    <input name="sifre" id="sifre" type="password" class="form-control" placeholder="Yeni şifre">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePwd">Göster</button>
                                    </div>
                                </div>
                                <small class="form-text text-muted" id="pwdHint">
                                    Düzenlemede boş bırakırsanız mevcut şifre korunur.
                                </small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Bayi</label>
                                <select name="bayi" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Evet</option>
                                    <option value="0">Hayır</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Bayi Kod</label>
                                <input name="bayi_kod" class="form-control">
                            </div>
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ml-auto" id="btnSave">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- List --}}
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white mb-0">Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
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
                            <tbody id="users-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection

@php
$userData = route('user.data'); // returns array of rows
$userShow = url('/user'); // /user/{id}
$userStore = route('user.store'); // POST create
@endphp

@push('scripts')
<script>
    (function() {
        const csrf = $('meta[name="csrf-token"]').attr('content');
        const $body = $('#users-body');
        const $form = $('#userForm');
        const $formTitle = $('#formTitle');
        const $pwd = $('#sifre');

        function fmt(v) {
            return (v === null || v === undefined || v === '') ? '-' : v;
        }

        function resetForm() {
            $form[0].reset();
            $('#user_id').val('');
            $('[name=_method]').val('POST');
            $formTitle.text('New User');
            $('#btnSave').text('Kaydet');
            $('#pwdHint').text('Oluşturmada şifre isteğe bağlıdır.');
            $pwd.attr('placeholder', 'Yeni şifre');
            $form.find('input[name="kod"]').trigger('focus');
        }

        async function loadUsers() {
            try {
                const rows = await $.getJSON(@json($userData));
                $body.empty();
                rows.forEach(r => {
                    $body.append(`
          <tr>
            <td>
              <div class="btn-group btn-group-sm">
                <button class="btn btn-warning u-edit" data-id="${r.id}">Edit</button>
                <button class="btn btn-danger  u-del"  data-id="${r.id}">Delete</button>
              </div>
            </td>
            <td>${fmt(r.id)}</td>
            <td>${fmt(r.kod)}</td>
            <td>${fmt(r.ad)}</td>
            <td>${fmt(r.soyad)}</td>
            <td>${fmt(r.bolum)}</td>
            <td>${fmt(r.unvan)}</td>
            <td>${fmt(r.mail)}</td>
            <td>${fmt(r.kullanici_tip)}</td>
            <td>${r.bayi==1?'Evet':(r.bayi==0?'Hayır':'-')}</td>
            <td>${fmt(r.bayi_kod)}</td>
            <td>${fmt(r.gunluk_hedef)}</td>
          </tr>
        `);
                });
            } catch (e) {
                console.error(e);
                alert('Liste yüklenemedi');
            }
        }

        // Create / Update
        $form.on('submit', async function(e) {
            e.preventDefault();
            const id = $('#user_id').val();
            const method = $('[name=_method]').val();
            const url = method === 'PUT' ? (@json($userShow) + '/' + id) : @json($userStore);

            // Serialize, but drop 'sifre' if empty on PUT
            let data = $form.serializeArray();
            if (method === 'PUT') {
                data = data.filter(p => !(p.name === 'sifre' && (!p.value || p.value.trim() === '')));
            }
            const payload = $.param(data);

            try {
                await $.ajax({
                    url,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    data: payload
                });
                resetForm();
                loadUsers();
            } catch (xhr) {
                console.error(xhr);
                alert(xhr.responseJSON?.message || 'Kaydedilemedi');
            }
        });

        // Edit (load then fill form)
        $(document).on('click', '.u-edit', async function() {
            const id = $(this).data('id');
            try {
                const o = await $.getJSON(@json($userShow) + '/' + id);
                $('#user_id').val(o.id);
                $('[name=_method]').val('PUT');
                $formTitle.text('Edit User');
                $('#btnSave').text('Güncelle');
                $('#pwdHint').text('Şifreyi değiştirmek istemiyorsanız boş bırakın.');
                $pwd.val('').attr('placeholder', 'Yeni şifre (isteğe bağlı)');

                for (const [k, v] of Object.entries(o)) {
                    const $el = $form.find('[name="' + k + '"]');
                    if ($el.length) {
                        if ($el.attr('name') === 'sifre') continue; // never prefill password
                        if ($el.is('select')) $el.val(String(v));
                        else $el.val(v);
                    }
                }
                $('html, body').animate({
                    scrollTop: $form.offset().top - 80
                }, 200);
                $form.find('input[name="kod"]').trigger('focus');
            } catch (e) {
                console.error(e);
                alert('Kayıt getirilemedi');
            }
        });

        // Delete
        $(document).on('click', '.u-del', async function() {
            const id = $(this).data('id');
            if (!confirm('Silinsin mi?')) return;
            try {
                await $.post(@json($userShow) + '/' + id, {
                    _method: 'DELETE',
                    _token: csrf
                });
                loadUsers();
            } catch (xhr) {
                console.error(xhr);
                alert(xhr.responseJSON?.message || 'Silinemedi');
            }
        });

        // Show/Hide password
        $('#togglePwd').on('click', function() {
            const type = $pwd.attr('type') === 'password' ? 'text' : 'password';
            $pwd.attr('type', type);
            $(this).text(type === 'password' ? 'Göster' : 'Gizle');
        });

        $('#btnReset').on('click', resetForm);

        // init
        resetForm();
        loadUsers();
    })();
</script>
@endpush