<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class BerandaController extends Controller
{
    public function index()
    {
        $latest = Produk::latest()->get();
        return view('beranda.index', compact('latest'));
    }
}
