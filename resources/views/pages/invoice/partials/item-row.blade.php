<tr>
    <td>
        @if(isset($item))
        <input type="hidden"
            name="items[{{ $index }}][id]"
            value="{{ $item->id }}">
        @endif
        <input type="number"
            name="items[{{ $index }}][coli]"
            class="form-control"
            value="{{ $item->coli ?? '' }}">
    </td>

    <td>
        <input type="text"
            name="items[{{ $index }}][code]"
            class="form-control"
            value="{{ $item->code ?? '' }}">
    </td>

    <td>
        <input type="text"
            name="items[{{ $index }}][jenis_barang]"
            class="form-control"
            value="{{ $item->jenis_barang ?? '' }}">
    </td>

    <td>
        <input type="number"
            step="0.01"
            name="items[{{ $index }}][berat]"
            class="form-control berat"
            value="{{ $item->berat ?? '' }}"
            oninput="hitung(this.closest('tr'))">
    </td>

    <td>
        <input type="number"
            step="0.01"
            name="items[{{ $index }}][ongkos_per_kg]"
            class="form-control ongkos"
            value="{{ $item->ongkos_per_kg ?? '' }}"
            oninput="hitung(this.closest('tr'))">
    </td>

    <td class="text-end">
        <span class="total-text">
            {{ number_format($item->total_ongkos ?? 0, 0, ',', '.') }}
        </span>
        <input type="hidden"
            class="total-value"
            name="items[{{ $index }}][total_ongkos]"
            value="{{ $item->total_ongkos ?? 0 }}">
    </td>

    <td>
        <button type="button"
            class="btn btn-danger btn-sm"
            onclick="this.closest('tr').remove(); hitungGrandTotal();">
            ✕
        </button>
    </td>
</tr>