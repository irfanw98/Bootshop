@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
                <form role="form" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="kategori_id">Pilih kategori :</label>
                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                <option value="-">-- PILIHAN ANDA --</option>
                                @foreach($kategori as $hasil)
                                <option value="{{ $hasil->id }}">{{ $hasil->nama }}</option>
                                @endforeach
                            </select>
                            <p class="help-block">Contoh: Pilih salah satu</p>
                        </div>
                        <div class="form-group {{ $errors->has('nama') ? ' has->error ' : '' }}">
                            <label for="nama">Nama :</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama produk" value="{{ old('nama') }}">

                            @if($errors->has('nama'))
                            <span class=" help-block">{{ $errors->first('nama') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('kode') ? ' has->error ' : '' }}">
                            <label for="kode">Kode :</label>
                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode produk" value="{{ old('kode') }}">

                            @if($errors->has('kode'))
                            <span class=" help-block">{{ $errors->first('kode') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('berat') ? ' has->error ' : '' }}">
                            <label for="berat">Berat (gram) :</label>
                            <input type="text" class="form-control" id="berat" name="berat" placeholder="berat produk">

                            @if($errors->has('berat'))
                            <span class=" help-block">{{ $errors->first('berat') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('harga') ? ' has->error ' : '' }}">
                            <label for="harga">Harga :</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga produk" value="{{ old('harga') }}">

                            @if($errors->has('harga'))
                            <span class=" help-block">{{ $errors->first('harga') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('stock') ? ' has->error ' : '' }}">
                            <label for="stock">Stock :</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock produk" value="{{ old('stock') }}">

                            @if($errors->has('stock'))
                            <span class=" help-block">{{ $errors->first('stock') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('minimal_stock') ? ' has->error ' : '' }}">
                            <label for="minimal_stock">Minimal stock :</label>
                            <input type="number" class="form-control" id="minimal_stock" name="minimal_stock" placeholder="Minimal stock" value="{{ old('minimal_stock') }}">

                            @if($errors->has('minimal_stock'))
                            <span class=" help-block">{{ $errors->first('minimal_stock') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="photo">Upload Photo :</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {

        // btn refresh
        $('.btn-refresh').click(function(e) {
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })

    })
</script>

@endsection