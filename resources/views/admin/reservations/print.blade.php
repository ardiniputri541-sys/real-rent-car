
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pemesanan - {{ $reservation->reservation_number }}</title>

    <style>
        @page {
            margin: 30px 35px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            color: #1F2937;
            font-size: 11px;
            line-height: 1.5;
            margin: 0;
        }

        .container {
            width: 100%;
        }

        /* HEADER */
        .header {
            width: 100%;
            border-bottom: 2px solid #D97706;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            color: #B45309;
            letter-spacing: 1px;
        }

        .brand-subtitle {
            font-size: 9px;
            color: #6B7280;
            letter-spacing: 2px;
        }

        .document-title {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
        }

        .reservation-number {
            color: #6B7280;
            font-size: 10px;
            text-align: right;
        }

        .status {
            display: inline-block;
            padding: 4px 10px;
            margin-top: 5px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
        }

        /* SECTION */
        .section {
            width: 100%;
            border: 1px solid #E5E7EB;
            margin-bottom: 14px;
        }

        .section-title {
            background-color: #F3F4F6;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 11px;
            border-bottom: 1px solid #E5E7EB;
        }

        .section-body {
            padding: 12px;
        }

        /* INFORMATION TABLE */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .info-table td {
            width: 50%;
            padding: 5px 8px;
            vertical-align: top;
        }

        .label {
            color: #6B7280;
            font-size: 9px;
            margin-bottom: 2px;
        }

        .value {
            font-weight: bold;
            font-size: 10px;
            word-wrap: break-word;
        }

        /* PAYMENT TABLE */
        .payment-table {
            width: 100%;
            border-collapse: collapse;
        }

        .payment-table th {
            background-color: #F9FAFB;
            color: #4B5563;
            font-size: 9px;
            text-align: left;
            padding: 9px 7px;
            border-bottom: 1px solid #D1D5DB;
        }

        .payment-table td {
            padding: 9px 7px;
            border-bottom: 1px solid #E5E7EB;
            font-size: 9px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        /* TOTALS */
        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 6px 4px;
            font-size: 10px;
        }

        .totals-table .total-row td {
            border-top: 2px solid #D97706;
            padding-top: 10px;
            font-weight: bold;
            font-size: 13px;
            color: #B45309;
        }

        /* FOOTER */
        .footer {
            border-top: 1px solid #E5E7EB;
            padding-top: 12px;
            margin-top: 22px;
            text-align: center;
            color: #6B7280;
            font-size: 9px;
        }

        .empty {
            text-align: center;
            padding: 15px;
            color: #6B7280;
        }
    </style>
</head>

<body>

@php
    $statusMap = collect($statusMeta)->keyBy('value');

    $statusValue = $reservation->status instanceof \BackedEnum
        ? $reservation->status->value
        : $reservation->status;

    $meta = $statusMap->get($statusValue);

    $statusLabel = $meta['label'] ?? ucfirst(str_replace('_', ' ', $statusValue));

    $statusColor = $meta['color'] ?? '#6B7280';

    $statusBackground = '#F3F4F6';

    if ($statusValue === 'terkonfirmasi') {
        $statusBackground = '#D1FAE5';
    } elseif ($statusValue === 'menunggu_konfirmasi') {
        $statusBackground = '#FEF3C7';
    } elseif ($statusValue === 'masa_sewa_berjalan') {
        $statusBackground = '#DBEAFE';
    } elseif ($statusValue === 'sewa_selesai') {
        $statusBackground = '#E5E7EB';
    } elseif ($statusValue === 'dibatalkan') {
        $statusBackground = '#FEE2E2';
    }

    $formatRupiah = function ($amount) {
        return 'Rp ' . number_format((float) $amount, 0, ',', '.');
    };
@endphp

<div class="container">

    <!-- HEADER -->
    <table class="header">
        <tr>
            <td width="50%" valign="top">
                <div class="brand">NUSADRIVE</div>
                <div class="brand-subtitle">RENTAL MOBIL INDONESIA</div>
            </td>

            <td width="50%" valign="top" align="right">
                <div class="document-title">
                    BUKTI PEMESANAN
                </div>

                <div class="reservation-number">
                    {{ $reservation->reservation_number }}
                </div>

                <span class="status"
                    style="background-color: {{ $statusBackground }};
                           color: {{ $statusColor }};">
                    {{ $statusLabel }}
                </span>
            </td>
        </tr>
    </table>

    <!-- CUSTOMER AND CAR -->
    <table width="100%" cellspacing="0" cellpadding="0"
           style="margin-bottom: 14px;">
        <tr>
            <td width="49%" valign="top">

                <div class="section">
                    <div class="section-title">
                        INFORMASI PELANGGAN
                    </div>

                    <div class="section-body">
                        <div class="label">Nama Lengkap</div>
                        <div class="value">
                            {{ $reservation->user->name ?? '—' }}
                        </div>

                        <br>

                        <div class="label">Alamat Email</div>
                        <div class="value">
                            {{ $reservation->user->email ?? '—' }}
                        </div>
                    </div>
                </div>

            </td>

            <td width="2%"></td>

            <td width="49%" valign="top">

                <div class="section">
                    <div class="section-title">
                        INFORMASI KENDARAAN
                    </div>

                    <div class="section-body">
                        <div class="label">Kendaraan</div>
                        <div class="value">
                            @if($reservation->car)
                                {{ $reservation->car->year }}
                                {{ $reservation->car->make }}
                                {{ $reservation->car->model }}
                            @else
                                —
                            @endif
                        </div>

                        <br>

                        <div class="label">Nomor Polisi</div>
                        <div class="value">
                            {{ $reservation->car->license_plate ?? '—' }}
                        </div>
                    </div>
                </div>

            </td>
        </tr>
    </table>

    <!-- RESERVATION DETAILS -->
    <div class="section">

        <div class="section-title">
            DETAIL PENYEWAAN
        </div>

        <div class="section-body">

            <table class="info-table">
                <tr>
                    <td>
                        <div class="label">Tanggal Pengambilan</div>
                        <div class="value">
                            {{ optional($reservation->start_date)->format('d/m/Y') }}
                            {{ optional($reservation->pickup_time)->format('H:i') }}
                        </div>
                    </td>

                    <td>
                        <div class="label">Tanggal Pengembalian</div>
                        <div class="value">
                            {{ optional($reservation->end_date)->format('d/m/Y') }}
                            {{ optional($reservation->return_time)->format('H:i') }}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="label">Durasi Penyewaan</div>
                        <div class="value">
                            {{ $reservation->total_days }} Hari
                        </div>
                    </td>

                    <td>
                        <div class="label">Lokasi Pengambilan</div>
                        <div class="value">
                            {{ $reservation->pickup_location ?? '—' }}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="label">Lokasi Pengembalian</div>
                        <div class="value">
                            {{ $reservation->return_location ?? '—' }}
                        </div>
                    </td>

                    <td>
                        @if($statusValue === 'dibatalkan')
                            <div class="label">Tanggal Pembatalan</div>
                            <div class="value">
                                {{ optional($reservation->cancelled_at)->format('d/m/Y H:i') ?? '—' }}
                            </div>
                        @endif
                    </td>
                </tr>

                @if($statusValue === 'dibatalkan')
                <tr>
                    <td colspan="2">
                        <div class="label">Alasan Pembatalan</div>
                        <div class="value">
                            {{ $reservation->cancellation_reason ?? '—' }}
                        </div>
                    </td>
                </tr>
                @endif

            </table>

        </div>
    </div>

    <!-- PAYMENT DETAILS -->
    <div class="section">

        <div class="section-title">
            RIWAYAT PEMBAYARAN
        </div>

        <div class="section-body">

            @if($reservation->payments->count() === 0)

                <div class="empty">
                    Belum ada transaksi pembayaran yang tercatat.
                </div>

            @else

                <table class="payment-table">

                    <thead>
                        <tr>
                            <th>Kode Pembayaran</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th class="text-right">Jumlah</th>
                            <th class="text-center">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($reservation->payments as $p)

                            @php
                                $method = $p->payment_method instanceof \BackedEnum
                                    ? $p->payment_method->value
                                    : $p->payment_method;

                                $paymentStatus = $p->status instanceof \BackedEnum
                                    ? $p->status->value
                                    : $p->status;
                            @endphp

                            <tr>
                                <td>{{ $p->payment_number }}</td>

                                <td>
                                    {{ ucfirst(str_replace('_', ' ', $method ?? '—')) }}
                                </td>

                                <td>
                                    {{ ucfirst(str_replace('_', ' ', $paymentStatus ?? '—')) }}
                                </td>

                                <td class="text-right">
                                    {{ $formatRupiah($p->amount) }}
                                </td>

                                <td class="text-center">
                                    {{ optional($p->processed_at)->format('d/m/Y') ?? '—' }}
                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @endif

        </div>
    </div>

    <!-- TOTALS -->
    <div class="section">

        <div class="section-title">
            RINCIAN BIAYA PENYEWAAN
        </div>

        <div class="section-body">

            <table class="totals-table">

                <tr>
                    <td>Harga Sewa per Hari</td>
                    <td class="text-right">
                        {{ $formatRupiah($reservation->daily_rate) }}
                    </td>
                </tr>

                <tr>
                    <td>Subtotal</td>
                    <td class="text-right">
                        {{ $formatRupiah($reservation->subtotal) }}
                    </td>
                </tr>

                <tr>
                    <td>Pajak</td>
                    <td class="text-right">
                        {{ $formatRupiah($reservation->tax_amount) }}
                    </td>
                </tr>

                <tr>
                    <td>Diskon</td>
                    <td class="text-right">
                        -{{ $formatRupiah($reservation->discount_amount) }}
                    </td>
                </tr>

                <tr class="total-row">
                    <td>TOTAL PEMESANAN</td>
                    <td class="text-right">
                        {{ $formatRupiah($reservation->total_amount) }}
                    </td>
                </tr>

            </table>

        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <strong>Terima kasih telah memilih NusaDrive.</strong>
        <br>
        Kami siap menemani perjalanan Anda dengan nyaman dan aman.
        <br><br>
        Dokumen ini diterbitkan secara otomatis oleh sistem NusaDrive.
        <br>
        Simpan bukti pemesanan ini sebagai referensi transaksi Anda.
    </div>

</div>

</body>
</html>
