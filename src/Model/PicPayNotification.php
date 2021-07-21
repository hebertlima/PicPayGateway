<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicPayNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'seller',
        'authorizationId',
        'status',
    ];

    public function setStatusAttributes( $value ) {
        $this->attributes['status'] = \Str::upper( $value );
    }
}
