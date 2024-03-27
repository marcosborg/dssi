<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nakivo extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'nakivos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product_id',
        'name',
        'option_1',
        'option_2',
        'part_number',
        'description',
        'partner_eur',
        'pvp_eur',
        'partner_mt',
        'pvp_mt',
        'partner_kz',
        'pvp_kz',
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
}
