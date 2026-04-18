<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Binafy\LaravelUserMonitoring\Traits\Actionable;

class InvoiceItem extends Model
{
    use HasUuids, Actionable;

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
