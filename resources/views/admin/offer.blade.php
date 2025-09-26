@extends('master')
@section('content')

@php
$offerData = route('offer.data');
$offerStore = route('offer.store');
$offerShow = url('/offer');
$offerOpts = route('offer.options');
$offerNextFis = route('offer.nextFis');
@endphp

<style>
    /* tighter Select2 to match your 28px inputs */
    .select2-container .select2-selection--single {
        height: 28px
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 28px
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 28px
    }

    .rcd-shell {
        background: #f4f6f9;
        border: 1px solid #cdd4df;
        overflow-x: hidden;
        margin: 0 auto;
        width: 100%
    }

    .rcd-ribbon {
        background: #fff;
        border-bottom: 1px solid #dfe4ec;
        padding: .45rem .6rem;
        display: flex;
        gap: .35rem;
        flex-wrap: wrap
    }

    .rcd-ribbon .btn {
        border: 1px solid #d4dbe6;
        background: #fafbfe
    }

    .rcd-wrap {
        padding: .75rem
    }

    .rcd-card {
        background: #fff;
        border: 1px solid #dfe4ec;
        border-radius: 4px
    }

    .rcd-card-bd {
        padding: .6rem;
        position: relative;
        z-index: 1
    }

    .rcd-headergrid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .75rem
    }

    .rcd-meta-grid {
        display: grid;
        grid-template-columns: 130px 1fr;
        gap: .3rem .5rem
    }

    .rcd-meta-grid label {
        font-size: .8rem;
        color: #4d5b75;
        margin: 0;
        align-self: center
    }

    .rcd-meta-grid input,
    .rcd-meta-grid select {
        height: 28px;
        padding: .15rem .35rem;
        font-size: .9rem
    }

    .rcd-grid-toolbar {
        display: flex;
        gap: .35rem;
        padding: .35rem .6rem;
        border-top: 1px solid #dfe4ec;
        border-bottom: 1px solid #dfe4ec;
        background: #fafbfe;
        align-items: center
    }

    .rcd-tabs .nav-link {
        padding: .3rem .5rem
    }

    .table-responsive {
        overflow-x: auto
    }

    .rcd-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: auto;
        min-width: 2200px
    }

    .rcd-table th,
    .rcd-table td {
        border-right: 1px solid #e6ebf3;
        border-bottom: 1px solid #e6ebf3;
        padding: .3rem .4rem;
        font-size: .85rem;
        white-space: nowrap;
        vertical-align: middle
    }

    .rcd-table th:first-child,
    .rcd-table td:first-child {
        border-left: 1px solid #e6ebf3
    }

    .rcd-table thead th {
        background: #f3f6fb;
        font-weight: 600
    }

    .rcd-table td input.form-control,
    .rcd-table td select.form-control {
        width: 100%;
        min-width: 60px;
        height: 28px;
        padding: .15rem .35rem;
        font-size: .9rem
    }

    .rcd-table th:nth-child(6),
    .rcd-table td:nth-child(6),
    .rcd-table th:nth-child(18),
    .rcd-table td:nth-child(18) {
        min-width: 180px
    }

    .rcd-footer {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: .4rem;
        padding: .5rem;
        border-top: 1px solid #dfe4ec;
        background: #fff
    }

    .rcd-footer .grp {
        display: grid;
        grid-template-columns: 130px 1fr;
        gap: .2rem
    }

    .rcd-footer label {
        font-size: .8rem;
        margin: 0;
        align-self: center
    }

    .rcd-footer input,
    .rcd-footer select {
        height: 28px;
        padding: .15rem .35rem;
        font-size: .9rem
    }

    @media (max-width:1366px) {
        .rcd-shell {
            max-width: 1100px
        }
    }

    @media (max-width:992px) {
        .rcd-headergrid {
            grid-template-columns: 1fr
        }
    }
</style>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="rcd-shell">

                <div class="rcd-ribbon">
                    <button class="btn btn-sm"><i class="fas fa-file"></i> Sipariş Form</button>
                    <button class="btn btn-sm"><i class="fas fa-print"></i> Kasa Kesim</button>
                    <button class="btn btn-sm"><i class="fas fa-print"></i> Cıta Kesim</button>
                    <button class="btn btn-sm"><i class="fas fa-print"></i> Mil Kesim</button>
                    <button class="btn btn-sm"><i class="fas fa-print"></i> Royal</button>
                    <button class="btn btn-sm"><i class="fas fa-sun"></i> Sunset</button>
                    <button class="btn btn-sm"><i class="fas fa-tag"></i> Küçük Etiket</button>
                    <button class="btn btn-sm"><i class="fas fa-print"></i> Hepsini Yazdır</button>
                    <button class="btn btn-sm"><i class="fas fa-box"></i> Tasarım</button>
                    <button class="btn btn-sm"><i class="fas fa-door-closed"></i> Kapak</button>
                </div>

                <div class="rcd-wrap">
                    <div class="rcd-card">
                        <div class="rcd-card-bd">

                            {{-- === header form (left+right) — unchanged from your latest === --}}
                            <form id="offerForm" autocomplete="off">
                                @csrf
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" id="row_id">

                                <div class="rcd-headergrid">
                                    <div class="rcd-meta-grid">
                                        <label>Fiş No :</label><input name="fis_no" class="form-control" readonly title="Otomatik atanır">
                                        <label>Sipariş Tarih :</label><input name="siparis_tarih" type="date" class="form-control" value="{{ now()->format('Y-m-d') }}">
                                        <label>Cari Hesap :</label>
                                        <div class="d-flex" style="gap:.4rem;"><input name="cari_kod" class="form-control"><input name="cari_unvan" class="form-control" placeholder="Unvan"></div>
                                        <label>Yetkili :</label>
                                        <div class="d-flex" style="gap:.4rem;"><input name="yetkili" class="form-control"><input name="mail" class="form-control" placeholder="Mail"></div>
                                        <label>Konu :</label><input name="konu" class="form-control">
                                        <label>Alt Firma :</label>
                                        <select name="alt_firma" class="form-control">
                                            <option value="URETIM">URETIM</option>
                                            <option value="SATIS">SATIŞ</option>
                                        </select>
                                        <label>Sipariş Durum :</label>
                                        <div class="d-flex" style="gap:.4rem;">
                                            <select name="siparis_durum" class="form-control">
                                                <option>URETIM</option>
                                                <option>HAZIR</option>
                                                <option>TAMAMLANDI</option>
                                            </select>
                                            <button type="button" class="btn btn-secondary btn-sm">Jaluzi Tamamla</button>
                                            <button type="button" class="btn btn-secondary btn-sm">Sipariş Tamamla</button>
                                        </div>
                                        <label>Teklif Tarih / … :</label>
                                        <div class="d-flex" style="gap:.4rem;"><input name="teklif_tarih" type="date" class="form-control"><input name="teklif_no" class="form-control" placeholder="Teklif No"></div>
                                    </div>

                                    <div class="rcd-meta-grid">
                                        {{-- right column unchanged --}}
                                        <label>Hazırlayan :</label><input name="hazirlayan" class="form-control">
                                        <label>İşlem Tarihi :</label><input name="islem_tarih" type="date" class="form-control" value="{{ now()->format('Y-m-d') }}">
                                        <label>Termin Tarihi :</label><input name="termin_tarih" type="date" class="form-control">
                                        <label>Marka :</label><select name="marka" class="form-control">
                                            <option>SUNSET ELITE</option>
                                            <option>SUNSET</option>
                                            <option>ROYAL</option>
                                        </select>
                                        <label>Terminal Tipi :</label><select name="terminal_tipi" class="form-control">
                                            <option>KARGO</option>
                                            <option>MAĞAZA TESLİM</option>
                                        </select>
                                        <label>Kargo No :</label><input name="kargo_no" class="form-control">
                                        <label>Müşteri Sipariş No :</label><input name="musteri_sip_no" class="form-control">
                                        <label>Şube :</label><select name="sube" class="form-control">
                                            <option>MERKEZ</option>
                                        </select>
                                        <label>Dolgu :</label><select name="dolgu" class="form-control">
                                            <option></option>
                                            <option>EVET</option>
                                            <option>HAYIR</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="rcd-grid-toolbar">
                            <button class="btn btn-sm btn-primary" id="btnAddRow"><i class="fas fa-plus"></i> Satır Ekle</button>
                            <button class="btn btn-sm btn-outline-secondary" id="btnDelRow"><i class="fas fa-minus"></i> Satır Sil</button>
                            <button class="btn btn-sm btn-outline-secondary" id="btnCopyRow"><i class="far fa-copy"></i> Satır Kopyala</button>
                        </div>

                        <div class="rcd-card-bd p-0">
                            <div class="rcd-tabs px-2 pt-2">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-detay">Detay</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-yedek">Yedek Parça</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-acik">Açıklama</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-onay">Onay</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-sart">Sipariş Şartları</a></li>
                                </ul>
                            </div>

                            <div class="tab-content p-2">
                                <div class="tab-pane fade show active" id="tab-detay">
                                    <div class="table-responsive">
                                        <table class="rcd-table" id="linesTable">
                                            <thead>
                                                <tr>
                                                    <th>En</th>
                                                    <th>Boy</th>
                                                    <th>M2</th>
                                                    <th>Miktar</th>
                                                    <th>M2 Fiyat</th>
                                                    <th>Açıklama</th>
                                                    <th>Poz</th>
                                                    <th>Mekanizma Yön</th>
                                                    <th>Sistem</th>
                                                    <th>Slayt</th>
                                                    <th>Cam</th>
                                                    <th>İç Cam</th>
                                                    <th>Ara Boşluk</th>
                                                    <th>Dış Cam</th>
                                                    <th>M2 Fiyatı</th>
                                                    <th>Tutar Döviz</th>
                                                    <th>Satır Tutar</th>
                                                    <th>Açıklama 2</th>
                                                    <th>Poz 2</th>
                                                    <th>Kasa Rengi</th>
                                                    <th>Alt Kasa Rengi</th>
                                                    <th>Cam Çıtası Rengi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="linesBody"></tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab-yedek">
                                    <div class="p-2">Yedek parça bilgileri…</div>
                                </div>
                                <div class="tab-pane fade" id="tab-acik">
                                    <div class="p-2"><textarea class="form-control" rows="4" placeholder="Genel açıklama"></textarea></div>
                                </div>
                                <div class="tab-pane fade" id="tab-onay">
                                    <div class="p-2">Onay akışı alanları…</div>
                                </div>
                                <div class="tab-pane fade" id="tab-sart">
                                    <div class="p-2">Sipariş şartları…</div>
                                </div>
                            </div>
                        </div>

                        <div class="rcd-footer">
                            <div class="grp"><label>Ara Toplam :</label><input id="ara_toplam" class="form-control" readonly></div>
                            <div class="grp"><label>KDV Toplam :</label><input id="kdv_toplam" class="form-control" readonly></div>
                            <div class="grp"><label>Genel Toplam İndirim :</label><input id="genel_indirim" class="form-control" value="0"></div>
                            <div class="grp"><label>Genel Toplam :</label><input id="genel_toplam" class="form-control" readonly></div>
                            <div class="grp"><label>Sipariş Fiş :</label><input id="siparis_fis" class="form-control"></div>

                            <div class="grp"><label>Satır İskonto Toplam :</label><input id="satir_iskonto" class="form-control" readonly></div>
                            <div class="grp"><label>Toplam :</label><input id="toplam" class="form-control" readonly></div>
                            <div class="grp"><label>Sipariş Döviz :</label>
                                <select id="sip_doviz" class="form-control">
                                    <option>TL</option>
                                    <option>USD</option>
                                    <option>EUR</option>
                                </select>
                            </div>
                            <div class="grp"><label>Sipariş Kur :</label><input id="sip_kur" class="form-control" value="1.0000"></div>
                            <div class="grp"><label>Sipariş Fiyatı :</label><input id="sip_fiyat" class="form-control" readonly></div>

                            <!-- SAVE BUTTON (added) -->
                        </div>
                        <div class="" style="display: flex; justify-content: flex-end; width: 100%; padding: 15px 10px 15px 0px">
                            <label>&nbsp;</label>
                            <button type="button" id="btnSaveOffer" class="btn btn-success">
                                <i class="fas fa-save"></i> Kaydet
                            </button>
                        </div>

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
        const $linesBody = $('#linesBody');
        const $fis = $('[name="fis_no"]');
        let OPTS = null;

        // ---- data loaders ---------------------------------------------------------
        function loadOptions() {
            return $.getJSON(@json($offerOpts)).then(d => {
                OPTS = d;
            });
        }

        function loadNextFis() {
            return $.getJSON(@json($offerNextFis))
                .then(({
                    next_fis_no
                }) => {
                    $fis.val(next_fis_no ?? '');
                })
                .catch(() => {
                    $fis.val('');
                }); // backend will still assign on save
        }

        // ---- helpers --------------------------------------------------------------
        function optsHtml(arr) {
            return (arr || []).map(o => `<option value="${String(o.id).replace(/"/g,'&quot;')}">${(o.text ?? o.id)}</option>`).join('');
        }
        // Enhance selects with Select2 (searchable)
        function enhanceSelects($scope) {
            $scope.find('select').each(function() {
                const $sel = $(this);
                if ($sel.data('select2')) return;
                $sel.select2({
                    width: 'resolve',
                    dropdownAutoWidth: true,
                    allowClear: true,
                    placeholder: '',
                    dropdownParent: $sel.closest('td')
                });
            });
        }

        // ---- row builder ----------------------------------------------------------
        function newLine() {
            const mekanizma = `<select class="form-control form-control-sm" name="mek_yon[]">${optsHtml(OPTS.mekanizma_yon)}</select>`;
            const sistem = `<select class="form-control form-control-sm" name="sistem[]">${optsHtml(OPTS.sistem)}</select>`;
            const slayt = `<select class="form-control form-control-sm" name="slayt[]">${optsHtml(OPTS.slayt)}</select>`;
            const camList = `<select class="form-control form-control-sm" name="cam[]">${optsHtml(OPTS.camkalinlik)}</select>`;
            const icCamList = `<select class="form-control form-control-sm" name="ic_cam[]">${optsHtml(OPTS.camkalinlik)}</select>`;
            const disCamList = `<select class="form-control form-control-sm" name="dis_cam[]">${optsHtml(OPTS.camkalinlik)}</select>`;
            const kasaRenk = `<select class="form-control form-control-sm" name="kasa_rengi[]">${optsHtml(OPTS.kasarenk)}</select>`;
            const altKasaRenk = `<select class="form-control form-control-sm" name="alt_kasa_rengi[]">${optsHtml(OPTS.kasarenk)}</select>`;
            const citasiRenk = `<select class="form-control form-control-sm" name="cam_citasi_rengi[]">${optsHtml(OPTS.kasarenk)}</select>`;

            const $row = $(`
      <tr>
        <td><input class="form-control form-control-sm" name="en[]"></td>
        <td><input class="form-control form-control-sm" name="boy[]"></td>
        <td><input class="form-control form-control-sm" name="m2[]" readonly></td>
        <td><input class="form-control form-control-sm" name="miktar[]" value="1"></td>
        <td><input class="form-control form-control-sm" name="m2_fiyat[]"></td>
        <td><input class="form-control form-control-sm" name="aciklama[]"></td>
        <td><input class="form-control form-control-sm" name="poz[]"></td>
        <td>${mekanizma}</td>
        <td>${sistem}</td>
        <td>${slayt}</td>
        <td>${camList}</td>
        <td>${icCamList}</td>
        <td><input class="form-control form-control-sm" name="ara_bosluk[]"></td>
        <td>${disCamList}</td>
        <td><input class="form-control form-control-sm" name="m2_fiyati[]"></td>
        <td><input class="form-control form-control-sm" name="tutar_doviz[]" readonly></td>
        <td><input class="form-control form-control-sm" name="satir_tutar[]" readonly></td>
        <td><input class="form-control form-control-sm" name="aciklama2[]"></td>
        <td><input class="form-control form-control-sm" name="poz2[]"></td>
        <td>${kasaRenk}</td>
        <td>${altKasaRenk}</td>
        <td>${citasiRenk}</td>
      </tr>`);
            $linesBody.append($row);
            enhanceSelects($row);
        }

        // ---- calculations ---------------------------------------------------------
        function recalcRow($tr) {
            const en = parseFloat($tr.find('input[name="en[]"]').val()) || 0;
            const boy = parseFloat($tr.find('input[name="boy[]"]').val()) || 0;
            const miktar = parseFloat($tr.find('input[name="miktar[]"]').val()) || 0;
            const m2Fiyat = parseFloat($tr.find('input[name="m2_fiyat[]"]').val()) || 0;

            let m2 = (en * boy) / 10000; // cm^2 -> m^2
            if (m2 > 0 && m2 < 1) m2 = 1; // minimum 1 m² if positive
            $tr.find('input[name="m2[]"]').val(m2 ? m2.toFixed(2) : '');

            const tutar = miktar * m2 * m2Fiyat;
            const val = tutar ? tutar.toFixed(2) : '';
            $tr.find('input[name="tutar_doviz[]"]').val(val);
            $tr.find('input[name="satir_tutar[]"]').val(val);
        }

        function recalcTotals() {
            let ara = 0;
            $linesBody.find('input[name="satir_tutar[]"]').each(function() {
                ara += parseFloat($(this).val()) || 0;
            });
            $('#ara_toplam').val(ara.toFixed(2));
            const kdv = ara * 0.20;
            $('#kdv_toplam').val(kdv.toFixed(2));
            const ind = parseFloat($('#genel_indirim').val()) || 0;
            const gen = Math.max(0, ara + kdv - ind);
            $('#genel_toplam').val(gen.toFixed(2));
            const kur = parseFloat($('#sip_kur').val()) || 1;
            $('#sip_fiyat').val((gen / kur).toFixed(2));
            $('#toplam').val(ara.toFixed(2));
        }

        // ---- events ---------------------------------------------------------------
        $linesBody.on('input change', 'input,select', function() {
            const $tr = $(this).closest('tr');
            recalcRow($tr);
            recalcTotals();
        });
        $('#btnAddRow').on('click', e => {
            e.preventDefault();
            newLine();
        });
        $('#btnDelRow').on('click', e => {
            e.preventDefault();
            const $r = $linesBody.find('tr');
            if ($r.length) $r.last().remove();
            recalcTotals();
        });
        $('#btnCopyRow').on('click', e => {
            e.preventDefault();
            const $last = $linesBody.find('tr').last();
            if (!$last.length) return;
            const $clone = $last.clone(true, true);
            $clone.find('input[name="m2[]"],input[name="tutar_doviz[]"],input[name="satir_tutar[]"]').val('');
            $clone.find('select').each(function() {
                if ($(this).data('select2')) $(this).select2('destroy');
            });
            enhanceSelects($clone);
            $linesBody.append($clone);
        });
        $('#genel_indirim,#sip_kur').on('input', recalcTotals);

        // ---- submit ---------------------------------------------------------------
        function buildPayload() {
            const header = $('#offerForm').serializeArray()
                .reduce((acc, {
                    name,
                    value
                }) => {
                    acc[name] = value;
                    return acc;
                }, {});
            const lines = [];
            $('#linesBody tr').each(function() {
                const line = {};
                $(this).find('input,select').each(function() {
                    const n = $(this).attr('name');
                    if (!n) return;
                    const key = n.replace(/\[\]$/, '');
                    const v = $(this).val();
                    if (v !== '' && v != null) line[key] = v;
                });
                if (Object.keys(line).length) lines.push(line);
            });
            return {
                header,
                lines
            };
        }
        $('#btnSaveOffer').on('click', function() {
            const payload = buildPayload();
            $.ajax({
                    url: @json($offerStore),
                    method: 'POST',
                    data: payload,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .done(resp => {
                    const fis = (resp && resp.fis_no) ? resp.fis_no : (payload.header?.fis_no || '');
                    if (fis) $('[name="fis_no"]').val(fis);
                    alert('Kaydedildi. Fiş No: ' + (fis || ''));
                    window.location.reload();
                })
                .fail(xhr => {
                    console.error(xhr.responseText);
                    const msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Kaydetme başarısız oldu.';
                    alert(msg);
                });
        });

        // ---- init -----------------------------------------------------------------
        Promise.all([loadOptions(), loadNextFis()])
            .then(() => {
                newLine();
            })
            .catch(() => {
                newLine();
            });
    })();
</script>
@endpush