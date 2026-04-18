<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .company {
            font-size: 18px;
            font-weight: bold;
            color: #1e3a8a;
            letter-spacing: 1px;
        }

        .company-info {
            font-size: 10px;
            color: #555;
            margin-top: 5px;
        }

        .invoice-info {
            width: 100%;
            margin-bottom: 15px;
        }

        .invoice-info td {
            padding: 3px 0;
            vertical-align: top;
        }

        .label {
            color: #666;
            width: 90px;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table.items th {
            background: #1e3a8a;
            color: #fff;
            padding: 6px;
            font-size: 10px;
            border: 1px solid #1e3a8a;
        }

        table.items td {
            border: 1px solid #ddd;
            padding: 6px;
            font-size: 10px;
        }

        .text-right {
            text-align: right;
        }

        .total-box {
            width: 35%;
            float: right;
            border: 1px solid #1e3a8a;
        }

        .total-box th {
            background: #f1f5f9;
            padding: 6px;
            font-size: 11px;
            text-align: left;
        }

        .total-box td {
            padding: 6px;
            font-size: 12px;
            font-weight: bold;
            text-align: right;
        }

        .status {
            margin-top: 10px;
            display: inline-block;
            padding: 4px 10px;
            font-size: 10px;
            font-weight: bold;
            border-radius: 4px;
        }

        .lunas {
            background: #dcfce7;
            color: #166534;
        }

        .belum {
            background: #fee2e2;
            color: #991b1b;
        }

        .footer {
            margin-top: 40px;
            font-size: 9px;
            color: #555;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <div class="company">SEKAR BUMI EXPRESS</div>
        <div class="company-info">
            <strong>SURABAYA</strong> : Kemayoran Baru No. 10<br>
            Telp. (031) 3522522 · 082220873666 · 081998548999<br><br>
            <strong>SUMBAWA</strong> : Jln. Lintas Sumbawa Bima KM. 3<br>
            Depan RM. Pahriyangan · Telp. 0852 3769 1670
        </div>
    </div>

    {{-- INFO INVOICE --}}
    <table class="invoice-info">
        <tr>
            <td width="50%">
                <table>
                    <tr>
                        <td class="label">Invoice</td>
                        <td>: <strong>{{ $invoice->invoice_number }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Kepada</td>
                        <td>: {{ $invoice->pengirim }}</td>
                    </tr>
                    <!-- <tr>
                        <td class="label">Alamat</td>
                        <td>: {{ $invoice->customer->alamat }}</td>
                    </tr> -->
                </table>
            </td>

            <td width="50%">
                <table>
                    <tr>
                        <td class="label">Tanggal</td>
                        <td>: {{ \Carbon\Carbon::parse($invoice->tanggal)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Supir</td>
                        <td>: {{ $invoice->supir ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">No. Polisi</td>
                        <td>: {{ $invoice->no_polisi ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- TABEL BARANG --}}
    <table class="items">
        <thead>
            <tr>
                <th>Coli</th>
                <th>Kode</th>
                <th>Jenis Barang</th>
                <th>Berat</th>
                <th>Ongkos / Kg</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td class="text-right">{{ $item->coli }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->jenis_barang }}</td>
                <td class="text-right">{{ $item->berat }}</td>
                <td class="text-right">
                    {{ number_format($item->ongkos_per_kg, 0, ',', '.') }}
                </td>
                <td class="text-right">
                    {{ number_format($item->total_ongkos, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTAL --}}
    <table class="total-box">
        <tr>
            <th>Jumlah Rp.</th>
            <td>
                {{ number_format($invoice->total, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <div style="clear: both;"></div>

    {{-- STATUS --}}
    <div class="status {{ $invoice->status_pembayaran === 'lunas' ? 'lunas' : 'belum' }}">
        {{ strtoupper(str_replace('_', ' ', $invoice->status_pembayaran)) }}
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <strong>Pengirim:</strong> {{ $invoice->customer->nama_toko}}
        <ol>
            <li>Bila ongkos pengangkutan tidak dibayar oleh penerima, barang akan dikembalikan ke pengirim.</li>
            <li>Barang pecah belah, cair, tekstil, dsb bukan tanggung jawab kami.</li>
            <li>Pembayaran maksimal 1 minggu setelah barang diterima.</li>
        </ol>

        <strong>Keterangan:</strong> Bayar SBW / SBY
    </div>

    <div class="signature">
        ( _______________________ )<br>
        Tanda tangan / Stempel
    </div>

</body>

</html>