<?php

namespace App\Http\Controllers\Kategori;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'List Kategori';
        $kategori = Kategori::orderBy('nama', 'asc')->get();

        //Datatable Serverside
        if ($request->ajax()) {
            return \datatables()->of($kategori)
                ->addColumn('Aksi', function ($data) {
                    return '<a href="" class="btn btn-warning btn-sm edit" data-id="' . $data->id . '" role="button"><i class="fa fa-edit"></i> EDIT</a>

                    <a href="" class="btn btn-danger btn-sm delete" role="button" kategori-id="' . $data->id . '" kategori-nama="' . $data->nama . '"><i class="fa fa-trash"></i> DELETE</a>';
                })
                ->rawColumns(['Aksi'])
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
        }

        return view('admin.kategori.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
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
            'kode' => 'required'
        ]);

        $kategori = Kategori::create($request->all());
        return redirect('kategori')->with('status', 'Data kategori berhasil di tambahkan!');
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
        $kategori = Kategori::find($id);
        return view('admin.kategori.formEdit', compact('kategori'));
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
        // Validasi
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'kode' => 'required'
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
    }
}
