<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $guarded = ['id'];

    public function Kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
