<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailStore extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'mail_stores';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product_id',
        'name',
        'term',
        'from',
        'to',
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
