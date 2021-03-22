<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{    
    protected $fillable = ['nama_menu','deskripsi','gambar','harga_menu','jumlah_stok'];
}
