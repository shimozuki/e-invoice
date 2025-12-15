@extends('layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-body" style="font-size:14px; line-height:1.5">

        {{-- ================= HEADER ================= --}}
        <div class="text-center mb-3">
            <h4 class="fw-bold mb-1">Sekar Bumi Express</h4>
            <div class="small text-muted">
                <div><strong>SURABAYA</strong> : Kemayoran Baru No. 10</div>
                <div>Telp. (031) 3522522 · 082220873666 · 081998548999</div>
                <div class="mt-1">
                    <strong>SUMBAWA</strong> : Jln. Lintas Sumbawa Bima KM. 3<br>
                    Depan RM. Pahriyangan · Telp. 0852 3769 1670
                </div>
            </div>
        </div>

        <hr class="my-2">

        {{-- ================= INFO INVOICE ================= --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td width="30%">No.</td>
                        <td><strong>{{ $invoice->invoice_number }}</strong></td>
                    </tr>
                    <tr>
                        <td>Kepada Yth</td>
                        <td><strong>{{ $invoice->customer->nama_toko }}</strong></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $invoice->customer->alamat }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td width="35%">Tanggal</td>
                        <td>
                            {{ \Carbon\Carbon::parse($invoice->tanggal)->format('d-m-Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Supir</td>
                        <td>{{ $invoice->supir ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>No. Polisi</td>
                        <td>{{ $invoice->no_polisi ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- ================= TABEL BARANG ================= --}}
        <div class="table-responsive mb-3">
            <table class="table table-bordered table-sm align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th width="6%">Coli</th>
                        <th width="10%">Code</th>
                        <th>Jenis Barang</th>
                        <th width="10%">Berat</th>
                        <th width="14%">Ongkos / Kg</th>
                        <th width="14%">Ongkos Rp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoice->items as $item)
                    <tr>
                        <td>{{ $item->coli }}</td>
                        <td>{{ $item->code }}</td>
                        <td class="text-start">{{ $item->jenis_barang }}</td>
                        <td>{{ number_format($item->berat, 2) }}</td>
                        <td>{{ number_format($item->ongkos_per_kg, 0, ',', '.') }}</td>
                        <td>{{ number_format($item->total_ongkos, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-muted">Tidak ada data barang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ================= TOTAL & STATUS ================= --}}
        <div class="row mb-4">
            <div class="col-md-6 small">
                <ol class="ps-3 mb-2">
                    <li>Barang dikembalikan bila ongkos tidak dibayar penerima.</li>
                    <li>Barang pecah belah & cair bukan tanggung jawab kami.</li>
                    <li>Pembayaran maksimal 1 minggu setelah barang diterima.</li>
                </ol>
                <strong>Keterangan:</strong> Bayar SBW / SBY
            </div>

            <div class="col-md-6">
                <table class="table table-bordered w-75 ms-auto">
                    <tr>
                        <th class="text-center">Jumlah Rp.</th>
                        <th class="text-end">
                            {{ number_format($invoice->total, 0, ',', '.') }}
                        </th>
                    </tr>
                </table>

                {{-- STATUS PEMBAYARAN --}}
                <div class="text-end mt-2">
                    <span class="badge
                        {{ $invoice->status_pembayaran === 'lunas'
                            ? 'bg-success'
                            : 'bg-warning text-dark' }}">
                        {{ strtoupper(str_replace('_',' ', $invoice->status_pembayaran)) }}
                    </span>
                </div>
            </div>
        </div>

        {{-- ================= TTD ================= --}}
        <div class="row mb-4">
            <div class="col-md-8"></div>
            <div class="col-md-4 text-center">
                <div style="margin-top:60px">( ______________________ )</div>
                <div class="small">Tanda tangan / Stempel</div>
            </div>
        </div>

        {{-- ================= AKSI ================= --}}
        <div class="d-flex justify-content-between align-items-center border-top pt-3">
            <a href="{{ route('invoice.index') }}" class="btn btn-outline-secondary">
                {{ __('button.back') }}
            </a>

            <div class="d-flex gap-2">
                @can('update_invoice_payment_status')
                <form method="POST" action="{{ route('invoice.update-payment', $invoice->id) }}" class="d-flex gap-2">
                    @csrf
                    @method('PUT')
                    <select name="status_pembayaran" class="form-select form-select-sm">
                        <option value="belum_lunas" @selected($invoice->status_pembayaran==='belum_lunas')>
                            Belum Lunas
                        </option>
                        <option value="lunas" @selected($invoice->status_pembayaran==='lunas')>
                            Lunas
                        </option>
                    </select>
                    <button class="btn btn-success btn-sm">Update</button>
                </form>
                @endcan

                @can('send_invoice')
                <form action="{{ route('invoice.send', $invoice->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-primary">
                        Kirim via Email
                    </button>
                </form>
                @endcan

                @can('download_invoice')
                <a href="{{ route('invoice.pdf', $invoice->id) }}"
                    class="btn btn-danger">
                    Download PDF
                </a>
                @endcan


                @can('edit_invoice')
                <a href="{{ route('invoice.edit', $invoice->id) }}" class="btn btn-primary btn-sm">
                    Edit
                </a>
                @endcan
            </div>
        </div>

    </div>
</div>
@endsection