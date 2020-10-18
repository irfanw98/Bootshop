<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="themes/images/ico-cart.png" alt="cart">3 Items in your cart <span class="badge badge-warning pull-right">$155.00</span></a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @php
        $kategori = \App\Kategori::orderBy('nama', 'asc')->get();
        @endphp

        @foreach($kategori as $hasil)
        <li><a href="{{ url('front/kategori/'. $hasil->id) }}">{{ $hasil->nama }} [{{ $hasil->Produk->count() }}]</a></li>
        @endforeach
    </ul>
    <br />
    @php
    $randoms = \App\Produk::limit(2)->inRandomOrder()->get();
    @endphp
    @foreach($randoms as $acak)
    <div class="thumbnail">
        <img src="{{ asset($acak->photo) }}" alt="{{ $acak->nama }}" />
        <div class="caption">
            <h5>{{ $acak->nama }}</h5>
            <h4 style="text-align:center"><a class="btn" href="{{ url('front/produk/'.$acak->id) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{ url('front/add-cart/'.$acak->id) }}">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rp. {{ number_format($acak->harga) }}</a></h4>
        </div>
    </div><br />
    @endforeach
    <div class="thumbnail">
        <img src="themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>