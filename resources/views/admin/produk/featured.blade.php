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
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ url('featured-produk') }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <select class="form-control" name="produk">
                                    <option value="-">-- PILIH PRODUK --</option>
                                    @foreach($produk as $hasil)
                                    <option value="{{ $hasil->id }}">{{ $hasil->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-md btn-success">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped table-bordered table-sm" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($featured as $featur)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $featur->nama }}</td>
                                    <td>{{ $featur->Kategori->nama }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function() {

        // btn refresh
        $('.btn-refresh').click(function(e) {
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })

    })

    $(document).ready(function() {
        $('#datatable').DataTable({

        })
    });
</script>

@endsection