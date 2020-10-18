@extends('layouts.master')

@section('content')
<ul class="thumbnails">
    @foreach($latest as $hasil)
    <li class="span3">
        <div class="thumbnail">
            <a href="{{ url('front/produk/'.$hasil->id) }}"><img src="{{ asset($hasil->photo) }}" style="width:100px; height:100px;" /></a>
            <div class="caption">
                <h5>{{ $hasil->nama }}</h5>
                <p>
                    {{ $hasil->Kategori->nama }}
                </p>

                <h4 style="text-align:center"><a class="btn" href="{{ url('front/produk/'.$hasil->id) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{ url('front/add-cart/'.$hasil->id) }}">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rp. {{ number_format($hasil->harga) }}</a></h4>
            </div>
        </div>
    </li>
    @endforeach
</ul>
@endsection