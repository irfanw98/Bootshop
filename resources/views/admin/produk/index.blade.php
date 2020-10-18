@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> REFRESH</button>

                <a href="{{ route('produk.create') }}" type="button" class="btn btn-sm btn-primary modal-show mb-2"><i class="fa fa-plus-square"></i> TAMBAH PRODUK</a>
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered table-sm" id="produk">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Berat</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Minimal Stock</th>
                            <th>Photo Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produk as $hasil)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $hasil->Kategori->nama }}</td>
                            <td>{{ $hasil->nama }}</td>
                            <td>{{ $hasil->kode }}</td>
                            <td>{{ $hasil->berat }} gram</td>
                            <td>{{ $hasil->harga }}</td>
                            <td>{{ $hasil->stock }}</td>
                            <td>{{ $hasil->minimal_stock }}</td>
                            <td>
                                <a href="{{ $hasil->photo }}" target="_blank">
                                    <img src="{{ $hasil->photo }}" class="img-thumbnail" title="{{ $hasil->photo }}" style="width:100px; height:100px;">
                                </a>
                            </td>
                            <td>
                                <p>
                                    <a href="{{ url('produk/' . $hasil->id . '/edit') }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"> EDIT</i>
                                    </a>
                                    <a href="{{ url('produk/' . $hasil->id) }}" class="btn btn-sm btn-danger btn-hapus" produk_id="{{ $hasil->id }}" produk_nama="{{ $hasil->nama }}" method="delete">
                                        <i class="fa fa-trash"> HAPUS</i>
                                    </a>
                                </p>
                                </>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    //Tombol Refresh
    $(document).ready(function() {

        // btn refresh
        $('.btn-refresh').click(function(e) {
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })

    });

    $(document).ready(function() {
        $('#produk').DataTable({

        })
    });
</script>

@endsection