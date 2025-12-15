<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class InvoiceItem extends Model
{
    use HasUuids;

    protected $table = 'invoice_items';

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'invoice_id',
        'coli',
        'code',
        'jenis_barang',
        'berat',
        'ongkos_per_kg',
        'total_ongkos',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
