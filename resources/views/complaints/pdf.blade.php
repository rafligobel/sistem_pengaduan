<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Pengaduan #{{ $complaint->token }}</title>
    <style>
        @page {
            margin: 18mm 18mm 18mm 18mm;
            size: a4 portrait;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9.5pt;
            line-height: 1.45;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        /* Kop Surat */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-table td {
            vertical-align: middle;
            padding: 0;
        }

        .kop-logo {
            width: 60px;
            text-align: left;
        }

        .kop-logo img {
            max-width: 55px;
            max-height: 65px;
        }

        .kop-text {
            text-align: center;
            padding-right: 60px; /* Menyeimbangkan posisi logo */
        }

        .kop-instansi {
            font-size: 11pt;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .kop-dinas {
            font-size: 13pt;
            font-weight: bold;
            color: #0369a1;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 2px 0;
        }

        .kop-alamat {
            font-size: 8pt;
            color: #64748b;
            margin: 0;
        }

        /* Garis Pembatas Kop */
        .kop-line {
            border-top: 2px solid #0f172a;
            border-bottom: 0.5px solid #0f172a;
            height: 2px;
            margin: 8px 0 14px 0;
        }

        /* Judul Dokumen */
        .doc-header {
            text-align: center;
            margin-bottom: 14px;
        }

        .doc-title {
            font-size: 12pt;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .doc-sub {
            font-size: 9pt;
            color: #475569;
            margin-top: 3px;
        }

        .token-code {
            font-family: 'Courier', monospace;
            font-weight: bold;
            color: #0284c7;
        }

        .status-badge {
            display: inline-block;
            background-color: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
            padding: 1px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 8.5pt;
        }

        /* Section Title */
        .section-title {
            font-size: 9.5pt;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-top: 12px;
            margin-bottom: 5px;
            padding-bottom: 3px;
            border-bottom: 1px solid #cbd5e1;
        }

        /* Tabel Standar Bersih */
        .table-clean {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        .table-clean th,
        .table-clean td {
            padding: 5px 8px;
            font-size: 9pt;
            vertical-align: top;
            border: 1px solid #cbd5e1;
        }

        .table-clean th {
            background-color: #f8fafc;
            color: #334155;
            text-align: left;
            font-weight: bold;
        }

        .table-clean td {
            color: #1e293b;
        }

        .label-cell {
            width: 22%;
            background-color: #f8fafc;
            font-weight: bold;
            color: #334155;
        }

        /* Uraian 5W+1H */
        .table-wh {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        .table-wh td {
            padding: 5.5px 8px;
            font-size: 9pt;
            vertical-align: top;
            border: 1px solid #cbd5e1;
        }

        .wh-key {
            width: 22%;
            background-color: #f8fafc;
            font-weight: bold;
            color: #0f172a;
        }

        .wh-val {
            text-align: justify;
            line-height: 1.45;
        }

        /* Tanda Tangan */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .signature-table td {
            width: 50%;
            vertical-align: top;
            padding: 0 10px;
            font-size: 9pt;
        }

        .sig-stamp {
            display: inline-block;
            border: 1px solid #059669;
            color: #059669;
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 8.5pt;
            margin-top: 5px;
        }

        .sig-meta {
            font-size: 8pt;
            color: #64748b;
            margin-top: 6px;
        }

        .sig-right {
            text-align: center;
        }

        .sig-title {
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 45px;
        }

        .sig-name {
            font-weight: bold;
            text-decoration: underline;
            color: #0f172a;
        }

        .sig-sub {
            font-size: 8pt;
            color: #64748b;
        }

        /* Halaman Lampiran */
        .page-break {
            page-break-before: always;
        }

        .attachment-header {
            border-bottom: 1.5px solid #0f172a;
            padding-bottom: 5px;
            margin-bottom: 12px;
        }

        .attachment-header table {
            width: 100%;
            border-collapse: collapse;
        }

        .attachment-item {
            margin-top: 14px;
            text-align: center;
            page-break-inside: avoid;
        }

        .attachment-title {
            font-size: 8.5pt;
            font-weight: bold;
            color: #475569;
            margin: 0 0 6px 0;
            text-align: left;
        }

        .attachment-img-frame {
            display: inline-block;
            border: 1px solid #cbd5e1;
            padding: 6px;
            background-color: #f8fafc;
            border-radius: 4px;
            max-width: 95%;
        }

        .attachment-img {
            max-width: 100%;
            max-height: 440px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Footer Halaman */
        .page-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            font-size: 7.5pt;
            color: #94a3b8;
            text-align: center;
            border-top: 0.5px solid #e2e8f0;
            padding-top: 3px;
        }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <table class="kop-table">
        <tr>
            @if(!empty($logoBase64))
                <td class="kop-logo">
                    <img src="{{ $logoBase64 }}" alt="Logo">
                </td>
            @endif
            <td class="kop-text">
                <p class="kop-instansi">Pemerintah Kota Gorontalo</p>
                <p class="kop-dinas">Inspektorat Daerah</p>
                <p class="kop-alamat">
                    Jl. Jamaludin Malik No. 1, Kota Gorontalo &bull; Sistem Pengaduan (SI-ADUAN)
                </p>
            </td>
        </tr>
    </table>

    <div class="kop-line"></div>

    {{-- JUDUL DOKUMEN --}}
    <div class="doc-header">
        <h1 class="doc-title">Laporan Pengaduan Terverifikasi</h1>
        <p class="doc-sub">
            Tiket: <span class="token-code">#{{ $complaint->token }}</span> &nbsp;|&nbsp;
            Status: <span class="status-badge">Terverifikasi</span>
        </p>
    </div>

    {{-- 1. INFORMASI PENGADUAN & PELAPOR --}}
    <div class="section-title">1. Informasi Pengaduan &amp; Pelapor</div>
    <table class="table-clean">
        <tr>
            <th class="label-cell">Nomor Tiket</th>
            <td style="font-family: 'Courier', monospace; font-weight: bold;">#{{ $complaint->token }}</td>
            <th class="label-cell">Tanggal Lapor</th>
            <td>{{ $complaint->created_at->format('d/m/Y H:i') }} WITA</td>
        </tr>
        <tr>
            <th class="label-cell">Kategori</th>
            <td>{{ $complaint->category->name ?? '-' }}</td>
            <th class="label-cell">Tanggal Verifikasi</th>
            <td>{{ $complaint->updated_at->format('d/m/Y H:i') }} WITA</td>
        </tr>
        <tr>
            <th class="label-cell">Nama Pelapor</th>
            <td><strong>{{ $complaint->user->name ?? 'Masyarakat' }}</strong></td>
            <th class="label-cell">NIK Pelapor</th>
            <td>
                @if(!empty($complaint->user->nik))
                    {{ substr($complaint->user->nik, 0, 6) . '******' . substr($complaint->user->nik, -4) }}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <th class="label-cell">Kontak Pelapor</th>
            <td>{{ $complaint->user->phone ?? '-' }} / {{ $complaint->user->email ?? '-' }}</td>
            <th class="label-cell">Bukti Lampiran</th>
            <td>
                @if(!empty($imageAttachments) || !empty($otherAttachments))
                    Tersedia ({{ count($imageAttachments) + count($otherAttachments) }} berkas terlampir)
                @else
                    Tidak Ada
                @endif
            </td>
        </tr>
    </table>

    {{-- 2. RINCIAN PENGADUAN (5W + 1H) --}}
    <div class="section-title">2. Rincian Laporan (5W + 1H)</div>
    <table class="table-wh">
        <tr>
            <td class="wh-key">Apa (What)</td>
            <td class="wh-val">{!! nl2br(e($complaint->what)) !!}</td>
        </tr>
        <tr>
            <td class="wh-key">Siapa (Who)</td>
            <td class="wh-val">{!! nl2br(e($complaint->who)) !!}</td>
        </tr>
        <tr>
            <td class="wh-key">Di mana (Where)</td>
            <td class="wh-val">{!! nl2br(e($complaint->where_location)) !!}</td>
        </tr>
        <tr>
            <td class="wh-key">Kapan (When)</td>
            <td class="wh-val">{!! nl2br(e($complaint->when_time)) !!}</td>
        </tr>
        <tr>
            <td class="wh-key">Mengapa (Why)</td>
            <td class="wh-val">{!! !empty($complaint->why) ? nl2br(e($complaint->why)) : '-' !!}</td>
        </tr>
        <tr>
            <td class="wh-key">Bagaimana (How)</td>
            <td class="wh-val">{!! nl2br(e($complaint->how)) !!}</td>
        </tr>
    </table>

    {{-- 3. CATATAN HASIL VERIFIKASI --}}
    <div class="section-title">3. Catatan Hasil Verifikasi</div>
    @if($complaint->responses && $complaint->responses->count() > 0)
        <table class="table-clean">
            <thead>
                <tr>
                    <th style="width: 22%;">Waktu</th>
                    <th style="width: 25%;">Petugas</th>
                    <th>Catatan / Tindak Lanjut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($complaint->responses as $response)
                    <tr>
                        <td>{{ $response->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <strong>{{ $response->user->name ?? 'Petugas' }}</strong><br>
                            <span style="font-size: 7.5pt; color: #64748b;">
                                ({{ ucfirst($response->user->roles->pluck('name')->first() ?? 'Petugas') }})
                            </span>
                        </td>
                        <td>{!! nl2br(e($response->content)) !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <table class="table-clean">
            <tr>
                <td style="color: #64748b; font-style: italic; text-align: center; padding: 8px;">
                    Laporan telah ditelaah dan dinyatakan lolos verifikasi oleh Verifikator APIP.
                </td>
            </tr>
        </table>
    @endif

    {{-- 4. PENGESAHAN DOKUMEN --}}
    <table class="signature-table">
        <tr>
            <td>
                <div class="sig-stamp">
                    &#10003; TERVERIFIKASI RESMI
                </div>
                <div class="sig-meta">
                    SI-ADUAN Kota Gorontalo<br>
                    Dicetak: {{ $printedAt->format('d/m/Y H:i') }} WITA
                </div>
            </td>
            <td class="sig-right">
                <p style="margin: 0 0 2px 0;">Kota Gorontalo, {{ $printedAt->format('d F Y') }}</p>
                <p class="sig-title">
                    Inspektorat Daerah Kota Gorontalo<br>
                    Tim Verifikator APIP
                </p>
                <p class="sig-name">TIM VERIFIKATOR APIP</p>
                <p class="sig-sub">Pemerintah Kota Gorontalo</p>
            </td>
        </tr>
    </table>

    {{-- 5. HALAMAN LAMPIRAN BUKTI GAMBAR / DOKUMEN (JIKA ADA) --}}
    @if(!empty($imageAttachments) || !empty($otherAttachments))
        <div class="page-break"></div>

        <div class="attachment-header">
            <table>
                <tr>
                    <td style="font-size: 10pt; font-weight: bold; color: #0f172a; text-transform: uppercase;">
                        Lampiran Bukti Pendukung
                    </td>
                    <td style="text-align: right; font-size: 8.5pt; color: #475569;">
                        Nomor Tiket: <strong style="font-family: 'Courier', monospace; color: #0284c7;">#{{ $complaint->token }}</strong>
                    </td>
                </tr>
            </table>
        </div>

        {{-- Bukti Foto / Gambar --}}
        @if(!empty($imageAttachments))
            <div class="section-title">Foto / Bukti Gambar</div>
            @foreach($imageAttachments as $idx => $img)
                <div class="attachment-item">
                    <p class="attachment-title">Bukti {{ $idx + 1 }}: {{ $img['name'] }}</p>
                    <div class="attachment-img-frame">
                        <img src="{{ $img['src'] }}" class="attachment-img" alt="Bukti {{ $idx + 1 }}">
                    </div>
                </div>
            @endforeach
        @endif

        {{-- Dokumen Non-Gambar Lainnya --}}
        @if(!empty($otherAttachments))
            <div class="section-title" style="margin-top: 16px;">Dokumen Pendukung Lainnya</div>
            <table class="table-clean">
                <thead>
                    <tr>
                        <th style="width: 8%; text-align: center;">No</th>
                        <th style="width: 50%;">Nama Berkas</th>
                        <th style="width: 15%;">Format</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($otherAttachments as $idx => $file)
                        <tr>
                            <td style="text-align: center;">{{ $idx + 1 }}</td>
                            <td><strong>{{ $file['name'] }}</strong></td>
                            <td>{{ $file['ext'] }}</td>
                            <td style="color: #64748b;">Tersimpan secara digital pada server SI-ADUAN</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif

    {{-- FOOTER --}}
    <div class="page-footer">
        SI-ADUAN Kota Gorontalo &bull; Laporan Terverifikasi #{{ $complaint->token }}
    </div>

</body>
</html>
