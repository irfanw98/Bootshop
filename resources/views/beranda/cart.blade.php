@extends('layouts.master')

@section('content')
<table class="table table-sm" id="cart">
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Berat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total_berat = 0;
        @endphp
        @foreach($data as $dt)
        <tr>
            <td>{{ $dt->name }}</td>
            <td>Rp. {{ number_format($dt->price) }}</td>
            <td>{{ $dt->quantity }}</td>
            <td>{{ $dt['attributes']['berat'] * $dt['quantity']}} Gram</td>
            @php
            $total_berat += $dt['attributes']['berat'] * $dt['quantity'];
            @endphp
            <td>
                <a href="{{ url('front/hapus-cart/'.$dt->id) }}" class="btn btn-sm btn-danger hapusCart">Hapus</a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td><strong>Total</strong></td>
            <td><b>Rp. {{ number_format($totalHarga) }}</b></td>
            <td><b>{{ $totalQuantity }}</b></td>
            <td><b>{{ $total_berat }} Gram</b></td>
        </tr>
    </tfoot>
</table>

<table>
    <tbody>
        <tr>
            <td>
                <select name="provinsi" class="form-control">
                    <option selected="" disabled="">-- PILIH PROVINSI --</option>
                    @foreach($provinsi->rajaongkir->results as $prov)
                    <option value="{{ $prov->province_id }}">{{ $prov->province }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control" name="kota">
                    <option selected="" disabled="">-- PILIH KOTA --</option>

                </select>
            </td>
            <td>
                <select name="kurir" class="form-control">
                    <option selected="" disabled="">-- PILIH KURIR --</option>
                    <option value="jne">JNE</option>
                    <option value="tiki">TIKI</option>
                    <option value="pos">POS</option>
                </select>
            </td>
            <td>
                <button class="btn btn-cekongkir btn-primary">Cek Ongkir</button>
            </td>
        </tr>
        <tr>
            <td class="list-ongkir">

            </td>
        </tr>
    </tbody>
</table>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {

        $("select[name='provinsi']").change(function(e) {
            $("select[name='kota']").empty();
            const provinsi = $(this).val();
            const url = "{{ url('front/get-kota') }}" + '/' + provinsi;

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

        //Ketika tombol cekongkir di klik
        $('.btn-cekongkir').click(function(e) {
            e.preventDefault();
            $('.list-ongkir').empty();
            let kota_asal = '{{ $kota_asal }}';
            let kota_tujuan = $("select[name='kota']").val();
            let kurir = $("select[name='kurir']").val();
            let berat = '{{ $total_berat }}';
            let url = "{{ url('front/cekongkir') }}" + '/' + kota_asal + '/' + kota_tujuan + '/' + kurir + '/' + berat;

            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: url,
                success: function(data) {
                    // console.log(data);
                    let ongkirs = '';
                    $.each(data.data.rajaongkir.results, function(i, v) {
                        $.each(v.costs, function(a, b) {
                            // ongkirs += b.service + '' + b.cost[0].value;
                            ongkirs += '<input type="radio" name="servis">' + b.service + '' + b.cost[0].value;
                        })
                    })
                    $('.list-ongkir').append(ongkirs);
                }
            })
        })

    })
</script>

@endsection