<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Produk;
use App\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Produk';
        $produk = Produk::orderBy('nama', 'asc')->get();
        return view('admin.produk.index', compact('title', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah produk';
        $kategori = Kategori::get();
        return view('admin.produk.tambah', compact('title', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validasi
        $this->validate($request, [
            'nama' => 'required|string|min:3|max:255',
            'kode' => 'required',
            'berat' => 'required|integer',
            'harga' => 'required|integer',
            'stock' => 'required|integer',
            'minimal_stock' => 'required|integer'
        ]);

        $file = $request->file('photo');
        if ($file) {
            $nama_file = $file->getClientOriginalName();
            $file->move('produk_images', $nama_file);
            $photo = 'produk_images/' . $nama_file;
        } else {
            $photo = null;
        }

        $data = new Produk;
        $data->kategori_id = $request->kategori_id;
        $data->nama = $request->nama;
        $data->kode = $request->kode;
        $data->kode = $request->berat;
        $data->harga = $request->harga;
        $data->stock = $request->stock;
        $data->minimal_stock = $request->minimal_stock;
        $data->photo = $photo;
        $data->save();
        // $produk = Produk::create($request->all());
        return redirect('produk')->with('status', 'Data produk berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Produk';
        $produk = Produk::find($id);
        $kategori = Kategori::get();
        return view('admin.produk.edit', compact('title', 'produk', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validasi
        $this->validate($request, [
            'nama' => 'required|string|min:3|max:255',
            'kode' => 'required',
            'berat' => 'required|integer',
            'harga' => 'required|integer',
            'stock' => 'required|integer',
            'minimal_stock' => 'required|integer'
        ]);

        $produk = Produk::find($id);
        $file = $request->file('photo');
        if ($file) {
            $nama_file = $file->getClientOriginalName();
            $file->move('produk_images', $nama_file);
            $photo = 'produk_images/' . $nama_file;
        } else {
            $photo = $produk->photo;
        }

        $data = Produk::find($id);
        $data->kategori_id = $request->kategori_id;
        $data->nama = $request->nama;
        $data->kode = $request->kode;
        $data->berat = $request->berat;
        $data->harga = $request->harga;
        $data->stock = $request->stock;
        $data->minimal_stock = $request->minimal_stock;
        $data->photo = $photo;
        $data->save();
        // $produk = Produk::create($request->all());
        return redirect('produk')->with('status', 'Data produk berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect('produk')->with('status', 'Data produk berhasil di delete!');
    }

    public function featured()
    {
        $title = 'List Featured Produk';
        $produk = Produk::all();
        $featured = Produk::where('is_featured', 1)->get();
        return view('admin.produk.featured', compact('title', 'produk', 'featured'));
    }

    public function featured_update(Request $request)
    {
        $id = $request->produk;
        $cek = Produk::find($id);
        if ($cek->is_featured == 1) {
            $produk = Produk::find($id);
            $produk->is_featured = null;
            $produk->save();
            return redirect()->back()->with('status', 'Data berhasil diupdate');
        } else {
            $produk = Produk::find($id);
            $produk->is_featured = 1;
            $produk->save();
            return redirect()->back()->with('status', 'Data berhasil disimpan');
        }
    }
}
