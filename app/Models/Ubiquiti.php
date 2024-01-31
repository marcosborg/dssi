<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubiquiti extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'ubiquitis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product_id',
        'name',
        'description',
        'product_information',
        'part_number',
        'partner_mt',
        'pvp_mt',
        'partner_kz',
        'pvp_kz',
        'stock_mz_id',
        'stock_ao_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function stock_mz()
    {
        return $this->belongsTo(Stock::class, 'stock_mz_id');
    }

    public function stock_ao()
    {
        return $this->belongsTo(Stock::class, 'stock_ao_id');
    }
}
