<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestApiLog extends BaseModel
{
    protected $fillable = ['method','request','endpoint','useragent','header','user_id','ip_address','created_at','updated_at'];

    protected $casts = [
        'request' => 'json',
        'header' => 'json',
    ];
}
