@extends('layouts.dashboard')

@section('content')
<form action="{{ route('invoice.store') }}" method="POST">
    @csrf

    {{-- HEADER --}}
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <h4>{{ __('menu.invoice_create') }}</h4>
            <div>
                <a href="{{ route('invoice.index') }}" class="btn btn-outline-secondary">
                    {{ __('button.back') }}
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ __('button.submit') }}
                </button>
            </div>
        </div>
    </div>

    {{-- INFORMASI INVOICE --}}
    <div class="card mb-3">
        <div class="card-body row">
            <div class="col-md-6 mb-3">
                <x-forms.input name="tanggal" type="date" />
            </div>
            <div class="col-md-6 mb-3">
                <x-forms.input-select2
                    name="customer_id"
                    :options="$customers->pluck('nama_toko', 'id')" />
            </div>
            <div class="col-md-6 mb-3">
                <x-forms.input name="kota_asal" />
            </div>
            <div class="col-md-6 mb-3">
                <x-forms.input name="kota_tujuan" />
            </div>
            <div class="col-md-6 mb-3">
                <x-forms.input name="supir" />
            </div>
            <div class="col-md-6 mb-3">
                <x-forms.input name="no_polisi" />
            </div>
        </div>
    </div>

    {{-- ITEM BARANG --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h6>{{ __('menu.invoice') }} Item</h6>
            <button type="button" class="btn btn-sm btn-success" id="addRow">
                + Tambah Item
            </button>
        </div>

        <div class="table-responsive">
            <table class="table align-middle" id="itemsTable">
                <thead>
                    <tr>
                        <th>Coli</th>
                        <th>Kode</th>
                        <th>Jenis Barang</th>
                        <th>Berat</th>
                        <th>Ongkos/Kg</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @include('pages.invoice.partials.item-row', ['index' => 0])
                </tbody>
            </table>
        </div>

        <div class="card-body text-end">
            <h5>
                Total Invoice :
                <span id="grandTotal">Rp 0</span>
            </h5>
        </div>
    </div>

</form>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', () => {

        let index = 1;

        window.hitung = function(row) {
            if (!row) return;

            const berat = parseFloat(row.querySelector('.berat')?.value) || 0;
            const ongkos = parseFloat(row.querySelector('.ongkos')?.value) || 0;
            const total = berat * ongkos;

            row.querySelector('.total-text').innerText =
                new Intl.NumberFormat('id-ID').format(total);

            row.querySelector('.total-value').value = total;

            hitungGrandTotal();
        };

        window.hitungGrandTotal = function() {
            let total = 0;

            document.querySelectorAll('.total-value').forEach(el => {
                total += parseFloat(el.value) || 0;
            });

            document.getElementById('grandTotal').innerText =
                'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        };

        document.getElementById('addRow').addEventListener('click', () => {
            fetch("{{ route('invoice.item.row') }}?index=" + index)
                .then(res => res.text())
                .then(html => {
                    document.querySelector('#itemsTable tbody')
                        .insertAdjacentHTML('beforeend', html);
                    index++;
                });
        });

    });
</script>