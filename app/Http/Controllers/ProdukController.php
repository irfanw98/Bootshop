<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class ProdukController extends Controller
{
    public function detail($id)
    {
        $produk = Produk::find($id);
        return view('beranda.produk_detail', compact('produk'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $kategori_id = $request->kategori_id;
        if ($kategori_id == 'all') {
            $latest = Produk::where('nama', 'like', '%' . $keyword . '%')->latest()->get();
        } else {
            $latest = Produk::where('nama', 'like', '%' . $keyword . '%')->where('kategori_id', $kategori_id)->latest()->get();
        }
        return view('beranda.index', compact('latest'));
    }
}
