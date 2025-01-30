<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laba extends Model
{
       protected $fillable = ['total_pendapatan', 'total_beli', 'total_kerugian','total_labaBersih'];
}
