@extends('master')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 ">
                    <div class="d-flex justify-content-end mb-2">
                        <button id="btnNewOffer" class="btn btn-icon icon-left btn-primary" type="button" data-toggle="modal" data-target=".new-offer">
                            <i class="fas fa-plus-circle"></i> New Offer
                        </button>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">Offers</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="offers-table" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:160px">Action</th>
                                            <th>ID</th>
                                            <th>Fiş No</th>
                                            <th>En</th>
                                            <th>Boy</th>
                                            <th>Miktar</th>
                                            <th>M2</th>
                                            <th>M2 Fiyat</th>
                                            <th>Tutar Döviz</th>
                                            <th>Renk</th>
                                            <th>Mekanizma Yön</th>
                                            <th>Sistem</th>
                                            <th>Slayt</th>
                                            <th>Cam</th>
                                            <th>İç Cam</th>
                                            <th>Dış Cam</th>
                                            <th>Kasa Renk</th>
                                            <th>Alt Kasa Renk</th>
                                            <th>Cam Çıtası Renk</th>
                                            <th>Açıklama</th>
                                            <th>Poz</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <!-- VIEW MODAL -->
                            <div class="modal fade" id="offerView" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info p-3">
                                            <h5 class="modal-title text-white">Offer Detail</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row mb-0" id="offerViewBody"></dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- NEW / EDIT MODAL -->
                            <div class="modal fade new-offer" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary p-3">
                                            <h5 class="modal-title text-white" id="offerModalTitle">New Offer</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="offerForm">@csrf
                                                <input type="hidden" name="_method" value="POST">
                                                <input type="hidden" id="row_id">
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label>Fiş No <small class="text-muted">(ops.)</small></label>
                                                        <input name="fis_no" class="form-control" autocomplete="off">
                                                    </div>
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
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label>M2 Fiyatı</label>
                                                        <input name="m2_fiyat" class="form-control" type="number" step="0.01" required>
                                                    </div>
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
                                                    <div class="form-group col-md-3">
                                                        <label>Cam</label>
                                                        <select name="cam" id="cam" class="form-control select2" required></select>
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
                                                            <label>Slayt</label>
                                                            <select name="slayt" id="slayt" class="form-control select2"></select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-3">
                                                            <label>İç Cam</label>
                                                            <select name="ic_cam" id="ic_cam" class="form-control select2"></select>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Dış Cam</label>
                                                            <select name="dis_cam" id="dis_cam" class="form-control select2"></select>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Kasa Renk</label>
                                                            <select name="kasa_renk" id="kasa_renk" class="form-control select2"></select>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label>Alt Kasa Renk</label>
                                                            <select name="alt_kasa_renk" id="alt_kasa_renk" class="form-control select2"></select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-3">
                                                            <label>Cam Çıtası Renk</label>
                                                            <select name="cam_cita_renk" id="cam_cita_renk" class="form-control select2"></select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <button type="submit" class="btn btn-primary ml-auto" id="offerSubmitBtn">Kaydet</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /modal -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection

@php
// convenience URLs if you don't want to name all routes
$offerData = route('offer.data');
$offerStore = route('offer.store');
@endphp

<script>
    $(function() {
        // -------- DataTable --------
        const dt = $('#offers-table').DataTable({
            destroy: true,
            pageLength: 25,
            data: [],
            order: [
                [0, 'asc']
            ],
            columns: [{
                    data: null,
                    orderable: false,
                    render: r => `
          <div class="btn-group btn-group-sm">
            <button class="btn btn-info   act-view" data-id="${r.id}">View</button>
            <button class="btn btn-warning act-edit" data-id="${r.id}">Edit</button>
            <button class="btn btn-danger  act-del"  data-id="${r.id}">Delete</button>
          </div>`
                },
                {
                    data: 'id'
                }, {
                    data: 'fis_no'
                }, {
                    data: 'en'
                }, {
                    data: 'boy'
                }, {
                    data: 'miktar'
                }, {
                    data: 'm2'
                },
                {
                    data: 'm2_fiyat'
                }, {
                    data: 'tutar_doviz'
                },
                {
                    data: 'renk'
                }, {
                    data: 'mekanizma_yon'
                }, {
                    data: 'sistem'
                }, {
                    data: 'slayt'
                },
                {
                    data: 'cam'
                }, {
                    data: 'ic_cam'
                }, {
                    data: 'dis_cam'
                },
                {
                    data: 'kasa_renk'
                }, {
                    data: 'alt_kasa_renk'
                }, {
                    data: 'cam_cita_renk'
                },
                {
                    data: 'aciklama'
                }, {
                    data: 'poz'
                },
            ]
        });

        function loadOffers() {
            $.getJSON(@json($offerData)).done(rows => {
                rows.sort((a, b) => b.id - a.id);
                dt.clear().rows.add(rows).draw();
            });
        }
        loadOffers();

        // -------- Select helpers --------
        function fillSelect($s, options, placeholder = 'Seçiniz') {
            if ($s.data('select2')) $s.select2('destroy');
            $s.empty().append(new Option(placeholder, '', true, false));
            if (Array.isArray(options)) {
                options.forEach(v => $s.append(new Option(v, v)));
            } else if (options && typeof options === 'object') {
                Object.entries(options).forEach(([val, text]) => $s.append(new Option(text, val)));
            }
            $s.select2({
                width: '100%',
                placeholder,
                allowClear: true,
                dropdownParent: $('.new-offer')
            });
            $s.val(null).trigger('change');
        }

        let __REF = null;

        function getRef() {
            if (__REF) return $.Deferred().resolve(__REF).promise();
            return $.getJSON('{{ route("orders.ref") }}').then(r => (__REF = r || {})).fail(() => ({
                mekanizma_yon: ['SOL', 'SAĞ'],
                sistem: ['Zincirli', 'Doğrama Üzeri'],
                slayt: ['Var', 'Yok'],
                cam: ['Var', 'Yok'],
                camkalinlik: [4, 6, 8, 10],
                kasarenk: ['Siyah', 'Beyaz', 'Gri'],
                renk: ['Siyah', 'Beyaz', 'Gri']
            }));
        }

        function loadRefIntoForm() {
            const $renk = $('#renk'),
                $mek = $('#mekanizma_yon'),
                $sis = $('#sistem'),
                $sl = $('#slayt'),
                $cam = $('#cam'),
                $ic = $('#ic_cam'),
                $dis = $('#dis_cam'),
                $kr = $('#kasa_renk'),
                $akr = $('#alt_kasa_renk'),
                $ccr = $('#cam_cita_renk');

            getRef().then(ref => {
                fillSelect($renk, ref.renk);
                fillSelect($mek, ref.mekanizma_yon);
                fillSelect($sis, ref.sistem);
                fillSelect($sl, ref.slayt);
                fillSelect($cam, ref.cam);
                fillSelect($ic, ref.camkalinlik);
                fillSelect($dis, ref.camkalinlik);
                fillSelect($kr, ref.kasarenk || ref.kasa_renk);
                fillSelect($akr, ref.kasarenk || ref.kasa_renk);
                fillSelect($ccr, ref.kasarenk || ref.kasa_renk);
            });
        }

        // -------- Calculations --------
        function recalc() {
            const en = parseFloat(($('[name="en"]').val() || '').replace(',', '.')) || 0;
            const boy = parseFloat(($('[name="boy"]').val() || '').replace(',', '.')) || 0;
            const miktar = parseFloat(($('[name="miktar"]').val() || '').replace(',', '.')) || 0;
            const m2f = parseFloat(($('[name="m2_fiyat"]').val() || '').replace(',', '.')) || 0;
            let m2 = en * boy;
            if (m2 > 0 && m2 < 1) m2 = 1;
            const tutar = miktar * m2 * m2f;
            $('#m2_view').val(m2 ? m2.toFixed(2) : '');
            $('#m2_hidden').val(m2 ? m2.toFixed(2) : '');
            $('#tutar_view').val(tutar ? tutar.toFixed(2) : '');
            $('#tutar_hidden').val(tutar ? tutar.toFixed(2) : '');
        }
        $(document).on('input change', '[name="en"],[name="boy"],[name="miktar"],[name="m2_fiyat"]', recalc);

        // -------- Open modal (new) --------
        $(document).on('click', '#btnNewOffer', function() {
            $('#offerModalTitle').text('New Offer');
            $('#offerForm')[0].reset();
            $('#row_id').val('');
            $('[name=_method]').val('POST');
            $('#m2_view,#tutar_view,#m2_hidden,#tutar_hidden').val('');
            loadRefIntoForm();
        });

        // -------- View --------
        $(document).on('click', '.act-view', function() {
            const id = $(this).data('id');
            $.getJSON('{{ url("/offer") }}/' + id).done(o => {
                const fmt = v => (v === null || v === undefined || v === '') ? '-' : v;
                const html = Object.entries(o).map(([k, v]) =>
                    `<dt class="col-4">${k}</dt><dd class="col-8">${fmt(v)}</dd>`).join('');
                $('#offerViewBody').html(html);
                $('#offerView').modal('show');
            });
        });

        // -------- Edit (prefill) --------
        $(document).on('click', '.act-edit', function() {
            const id = $(this).data('id');
            $.getJSON('{{ url("/offer") }}/' + id).done(o => {
                $('#offerModalTitle').text('Edit Offer');
                $('#row_id').val(o.id);
                $('[name=_method]').val('PUT');

                loadRefIntoForm(); // ensure selects are ready, then fill values slightly after
                setTimeout(() => {
                    for (const [k, v] of Object.entries(o)) {
                        const $el = $('[name="' + k + '"]');
                        if (!$el.length) continue;
                        if ($el.is('select')) $el.val(v).trigger('change');
                        else $el.val(v);
                    }
                    recalc();
                }, 200);

                $('.new-offer').modal('show');
            });
        });

        // -------- Save (create/update) --------
        $('#offerForm').on('submit', function(e) {
            e.preventDefault();
            recalc();
            const id = $('#row_id').val();
            const method = $('[name=_method]').val(); // POST or PUT
            const url = method === 'PUT' ? ('{{ url("/offer") }}/' + id) : @json($offerStore);

            $.ajax({
                    url,
                    method: method === 'PUT' ? 'POST' : 'POST',
                    data: $(this).serialize()
                })
                .done(() => {
                    $('.new-offer').modal('hide');
                    loadOffers();
                })
                .fail(xhr => alert(xhr.responseJSON?.message || 'Kaydedilemedi'));
        });

        // -------- Delete --------
        $(document).on('click', '.act-del', function() {
            const id = $(this).data('id');
            if (!confirm('Silinsin mi?')) return;
            $.ajax({
                    url: '{{ url("/offer") }}/' + id,
                    method: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: $('meta[name=csrf-token]').attr('content')
                    }
                })
                .done(() => loadOffers())
                .fail(xhr => alert(xhr.responseJSON?.message || 'Silinemedi'));
        });

    });
</script>