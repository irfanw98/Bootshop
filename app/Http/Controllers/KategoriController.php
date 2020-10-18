<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Produk;

class KategoriController extends Controller
{
    public function index($id)
    {
        $latest = Produk::where('kategori_id', $id)->latest()->get();
        return view('beranda.kategori', compact('latest'));
    }
}
