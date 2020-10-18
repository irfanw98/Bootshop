<div class="row-fluid">
    <div id="featured" class="carousel slide">
        <div class="carousel-inner">
            <div class="item active">
                <ul class="thumbnails">
                    @php
                    $featureds = \App\Produk::where('is_featured', 1)->get();
                    @endphp

                    @foreach($featureds as $featured)
                    <li class="span3">
                        <div class="thumbnail">
                            <i class="tag"></i>
                            <a href="{{ url('front/produk/'. $featured->id) }}"><img src="{{ asset($featured->photo) }}" alt=""></a>
                            <div class="caption">
                                <h5>{{ $featured->nama }}</h5>


                                <h4 style="text-align:center"><a class="btn" href="{{ url('front/produk/'.$featured->id) }}">View</a> <a class="btn" href="{{ url('front/add-cart/'.$featured->id) }}">Add to <i class="icon-shopping-cart"></i></a>
                                    <p>Rp. {{ number_format($featured->harga) }}</p>
                                </h4>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
        <a class="right carousel-control" href="#featured" data-slide="next">›</a>
    </div>
</div>