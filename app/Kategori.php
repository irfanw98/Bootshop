<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $guarded = ['id'];

    public function Produk()
    {
        return $this->hasMany(Produk::class);
    }
}
