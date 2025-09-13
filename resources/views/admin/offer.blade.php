@extends('master')
@section('content')

@php
$offerData = route('offer.data'); // GET list (headers)
$offerStore = route('offer.store'); // POST create/update
$offerShow = url('/offer'); // /offer/{id}
@endphp

<div class="main-content">
    <section class="section">
        <div class="section-body">

            {{-- Add / Edit (inline) --}}
            <div class="card mb-4">
                <div class="card-header bg-primary d-flex align-items-center justify-content-between">
                    <h4 class="text-white mb-0" id="formTitle">New Offer</h4>
                    <button type="button" class="btn btn-light btn-sm" id="btnReset">Reset</button>
                </div>
                <div class="card-body">
                    <form id="offerForm" autocomplete="off">
                        @csrf
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" id="row_id">

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>Fiş No</label>
                                <input name="fis_no" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Cari Kod</label>
                                <input name="cari_kod" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Müşteri Ad</label>
                                <input name="musteri_ad" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Marka</label>
                                <input name="marka" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Bölüm</label>
                                <input name="bolum" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Konu</label>
                                <input name="konu" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Döviz</label>
                                <select name="teklif_doviz" class="form-control">
                                    <option value="">Seçiniz</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="TRY">TRY</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Kur</label>
                                <input name="teklif_kur" class="form-control" type="number" step="0.0001">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Döviz Tutar</label>
                                <input name="teklif_doviz_tutar" class="form-control" type="number" step="0.01">
                            </div>
                            <div class="form-group col-md-3">
                                <label>TL Tutar (otomatik)</label>
                                <input id="tl_view" class="form-control" readonly>
                                <input type="hidden" name="teklif_tl_tutar" id="tl_hidden">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Teklif Durum</label>
                                <input name="teklif_durum" class="form-control" placeholder="Örn: Teklif Süreci">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Teklif Grubu</label>
                                <input name="teklif_grubu" class="form-control" placeholder="Örn: SEÇİNİZ">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Termin Tarih</label>
                                <input name="termin_tarih" class="form-control" type="date">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Sevk Adres</label>
                                <input name="sevk_adres" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Onay Durum</label>
                                <select name="onay_durum" class="form-control">
                                    <option value="">Seçiniz</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Onay Tarih</label>
                                <input name="onay_tarih" class="form-control" type="date">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Onaylayan</label>
                                <input name="onaylayan" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Hazırlayan</label>
                                <input name="hazirlayan" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Açıklama</label>
                                <input name="aciklama" class="form-control">
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
                    <h4 class="text-white mb-0">Offers</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width:140px">Action</th>
                                    <th>ID</th>
                                    <th>Fiş No</th>
                                    <th>Cari Kod</th>
                                    <th>Müşteri Ad</th>
                                    <th>Marka</th>
                                    <th>Bölüm</th>
                                    <th>Durum</th>
                                    <th>Grup</th>
                                    <th>Döviz</th>
                                    <th>Döviz Tutar</th>
                                    <th>Kur</th>
                                    <th>TL Tutar</th>
                                    <th>Termin</th>
                                    <th>Onay</th>
                                    <th>Onay Tarih</th>
                                    <th>Hazırlayan</th>
                                    <th>Tarih</th>
                                </tr>
                            </thead>
                            <tbody id="offers-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    (function() {
        const csrf = $('meta[name="csrf-token"]').attr('content');
        const $form = $('#offerForm');
        const $tbody = $('#offers-body');
        const $title = $('#formTitle');

        function fmt(v) {
            return (v === null || v === undefined || v === '') ? '-' : v;
        }

        function num(v) {
            const n = parseFloat(String(v).replace(',', '.'));
            return isNaN(n) ? 0 : n;
        }

        function recalcTL() {
            const kur = num($('[name="teklif_kur"]').val());
            const dvz = num($('[name="teklif_doviz_tutar"]').val());
            const tl = kur * dvz;
            $('#tl_view').val(tl ? tl.toFixed(2) : '');
            $('#tl_hidden').val(tl ? tl.toFixed(2) : '');
        }

        $(document).on('input change', '[name="teklif_kur"],[name="teklif_doviz_tutar"]', recalcTL);

        function resetForm() {
            $form[0].reset();
            $('#row_id').val('');
            $('[name=_method]').val('POST');
            $('#tl_view,#tl_hidden').val('');
            $title.text('New Offer');
            $('#btnSave').text('Kaydet');
            $form.find('input[name="fis_no"]').trigger('focus');
        }

        function rowHtml(r) {
            return `
      <tr>
        <td>
          <div class="btn-group btn-group-sm">
            <button class="btn btn-warning act-edit" data-id="${r.id}">Edit</button>
            <button class="btn btn-danger  act-del"  data-id="${r.id}">Delete</button>
          </div>
        </td>
        <td>${fmt(r.id)}</td>
        <td>${fmt(r.fis_no)}</td>
        <td>${fmt(r.cari_kod)}</td>
        <td>${fmt(r.musteri_ad)}</td>
        <td>${fmt(r.marka)}</td>
        <td>${fmt(r.bolum)}</td>
        <td>${fmt(r.teklif_durum)}</td>
        <td>${fmt(r.teklif_grubu)}</td>
        <td>${fmt(r.teklif_doviz)}</td>
        <td>${fmt(r.teklif_doviz_tutar)}</td>
        <td>${fmt(r.teklif_kur)}</td>
        <td>${fmt(r.teklif_tl_tutar)}</td>
        <td>${fmt(r.termin_tarih)}</td>
        <td>${fmt(r.onay_durum)}</td>
        <td>${fmt(r.onay_tarih)}</td>
        <td>${fmt(r.hazirlayan)}</td>
        <td>${fmt(r.tarih || r.islem_tarih)}</td>
      </tr>
    `;
        }

        function loadOffers() {
            $.getJSON(@json($offerData))
                .done(rows => {
                    rows.sort((a, b) => b.id - a.id);
                    $tbody.empty();
                    rows.forEach(r => $tbody.append(rowHtml(r)));
                })
                .fail(() => alert('Liste yüklenemedi'));
        }

        // Create / Update
        $form.on('submit', function(e) {
            e.preventDefault();
            recalcTL();
            const id = $('#row_id').val();
            const method = $('[name=_method]').val();
            const url = method === 'PUT' ? (@json($offerShow) + '/' + id) : @json($offerStore);

            $.ajax({
                    url,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    data: $form.serialize()
                })
                .done(() => {
                    resetForm();
                    loadOffers();
                })
                .fail(xhr => alert(xhr.responseJSON?.message || 'Kaydedilemedi'));
        });

        // Edit → prefill
        $(document).on('click', '.act-edit', function() {
            const id = $(this).data('id');
            $.getJSON(@json($offerShow) + '/' + id)
                .done(o => {
                    $('#row_id').val(o.id);
                    $('[name=_method]').val('PUT');
                    $title.text('Edit Offer');
                    $('#btnSave').text('Güncelle');

                    // fill fields by key if present
                    const map = [
                        'fis_no', 'cari_kod', 'musteri_ad', 'konu', 'teklif_doviz', 'teklif_kur',
                        'teklif_doviz_tutar', 'teklif_tl_tutar', 'teklif_durum', 'teklif_grubu',
                        'termin_tarih', 'sevk_adres', 'aciklama', 'onay_durum', 'onay_tarih',
                        'onaylayan', 'hazirlayan', 'bolum', 'marka'
                    ];
                    map.forEach(k => {
                        const $el = $form.find('[name="' + k + '"]');
                        if ($el.length) {
                            $el.val(o[k] ?? '');
                        }
                    });
                    recalcTL();

                    $('html, body').animate({
                        scrollTop: $form.offset().top - 80
                    }, 200);
                    $form.find('input[name="fis_no"]').trigger('focus');
                })
                .fail(() => alert('Kayıt getirilemedi'));
        });

        // Delete
        $(document).on('click', '.act-del', function() {
            const id = $(this).data('id');
            if (!confirm('Silinsin mi?')) return;
            $.post(@json($offerShow) + '/' + id, {
                    _method: 'DELETE',
                    _token: csrf
                })
                .done(loadOffers)
                .fail(xhr => alert(xhr.responseJSON?.message || 'Silinemedi'));
        });

        // Init
        $('#btnReset').on('click', resetForm);
        resetForm();
        loadOffers();
    })();
</script>
@endpush