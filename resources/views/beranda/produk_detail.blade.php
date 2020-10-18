@extends('layouts.master')

@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
        <li><a href="{{ url('front/produk/'.$produk->id) }}">Products</a> <span class="divider">/</span></li>
        <li class="active">product Details</li>
    </ul>
    <div class="row">
        <div id="gallery" class="span3">
            <a href="{{ asset($produk->photo) }}" title="{{ $produk->nama }}">
                <img src="{{ asset($produk->photo) }}" style="width:100%" alt="{{ $produk->nama }}" />
            </a>
            <div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                    <div class="item active">
                        <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt="" /></a>
                        <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt="" /></a>
                        <a href="themes/images/products/large/f3.jpg"> <img style="width:29%" src="themes/images/products/large/f3.jpg" alt="" /></a>
                    </div>
                    <div class="item">
                        <a href="themes/images/products/large/f3.jpg"> <img style="width:29%" src="themes/images/products/large/f3.jpg" alt="" /></a>
                        <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt="" /></a>
                        <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt="" /></a>
                    </div>
                </div>
                <!--  
			  <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> 
			  -->
            </div>

            <div class="btn-toolbar">
                <div class="btn-group">
                    <span class="btn"><i class="icon-envelope"></i></span>
                    <span class="btn"><i class="icon-print"></i></span>
                    <span class="btn"><i class="icon-zoom-in"></i></span>
                    <span class="btn"><i class="icon-star"></i></span>
                    <span class="btn"><i class=" icon-thumbs-up"></i></span>
                    <span class="btn"><i class="icon-thumbs-down"></i></span>
                </div>
            </div>
        </div>
        <div class="span6">
            <h3>{{ $produk->nama }} </h3>
            <small>- {{ $produk->Kategori->nama }}</small>
            <hr class="soft" />
            <form class="form-horizontal qtyFrm">
                <div class="control-group">
                    <label class="control-label"><span>Rp. {{ number_format($produk->harga) }}</span></label>
                    <div class="controls">
                        <input type="number" class="span1" placeholder="Qty." />
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
                    </div>
                </div>
            </form>

            <hr class="soft" />
            <h4>{{ $produk->stock }} items in stock</h4>
            <hr class="soft clr" />

            <a href="#detail" class="btn btn-small pull-right">More Details</a>
            <br class="clr" />
            <a href="#" name="detail"></a>
            <hr class="soft" />
        </div>
    </div>
</div>
@endsection