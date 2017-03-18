<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'mdata';
    protected $fillable = ['id', 'ssid', 'title', 'body'];
}
