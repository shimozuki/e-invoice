<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Binafy\LaravelUserMonitoring\Traits\Actionable;

class Invoice extends Model
{
    use Actionable;

    protected $table = 'invoices';

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'invoice_number',
        'tanggal',
        'customer_id',
        'pengirim',
        'kota_asal',
        'kota_tujuan',
        'supir',
        'no_polisi',
        'total',
        'created_by',
        'status_pembayaran',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    protected static function booted()
    {
        static::updated(function ($model) {
            \Binafy\LaravelUserMonitoring\Models\ActionMonitoring::create([
                'user_id' => auth()->id(),
                'action_type' => 'update',
                'table_name' => $model->getTable(),
                'browser_name' => request()->header('User-Agent'),
                'platform' => php_uname(),
                'device' => php_uname(),
                'ip' => request()->ip(),
                'page' => request()->fullUrl(),
            ]);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
