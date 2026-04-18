<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Binafy\LaravelUserMonitoring\Traits\Actionable;

class Customer extends Model
{
    use Actionable;

    protected $table = 'customers';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nama_toko',
        'nama_pemilik',
        'telepon',
        'alamat',
        'kota',
        'email',
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
}
