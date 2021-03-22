<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['id_menu','deskripsi','nama_promo','start','end','jumlah_promo'];
}
