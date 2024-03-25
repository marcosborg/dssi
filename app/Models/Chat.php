<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'chats';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const ORIGIN_RADIO = [
        'chat'   => 'chat',
        'client' => 'client',
    ];

    protected $fillable = [
        'user_id',
        'origin',
        'message',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
