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
                    <div class="col-md-4">
                        <form action="{{ url('alamat') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <select class="form-control" name="provinsi">
                                    <option value="-">-- PILIH PROVINSI --</option>
                                    @foreach($provinsi->rajaongkir->results as $hasil)
                                    <option value="{{ $hasil->province_id }}">{{ $hasil->province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="kota">
                                </select>
                            </div>
                            <button type="submit" class="btn btn-md btn-success">Submit</button>
                        </form>
                    </div>
                </div>
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

        $("select[name='provinsi']").change(function(e) {
            $("select[name='kota']").empty();
            const id = $(this).val();
            const url = "{{ url('alamat/get-kota') }}" + '/' + id;

            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: url,
                success: function(data) {
                    // console.log(data);
                    let hasil = '';
                    $.each(data.data.rajaongkir.results, function(i, v) {
                        hasil += '<option value="' + v.city_id + '" >';
                        hasil += v.type + '' + v.city_name;
                        hasil += '</option>';
                    });

                    $("select[name='kota']").append(hasil);
                }

            })
        })

    })
</script>

@endsection