@extends('layouts.frontend')
@section('title')
Welcome to E-Shop
@endsection
@section('content')
@include('layouts.inc.slider')

<!-- Trending Products -->
<div class="py5 mb-5">
  <div class="container">
    <div class="row">
      <h2>Featured Products</h2>
      <div class="owl-carousel featured-carousel owl-theme">
        @foreach($featured_products as $prod)
        <div class="item">
          <div class="card">
            <img class="featured-images" src="{{asset('assets/product/'.$prod->product_image)}}" alt="Product Image">
            <div class="card-body">
              <h5>{{$prod->name}}</h5>
              <span class="float-start">{{$prod->selling_price}}</span>
              <span class="float-end"><s>{{$prod->original_price}}</s></span>
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </div>
</div>

<!-- Popular Categories -->
<div class="py5 mb-5">
  <div class="container">
    <div class="row">
      <h2>Trending Category</h2>
      <div class="owl-carousel featured-carousel owl-theme">
        @foreach($featured_categories as $cate)
        <div class="item">
        <a href="{{url('category/'.$cate->slug)}}">
          <div class="card">
            <img class="featured-images" src="{{asset('assets/category/'.$cate->category_image)}}" alt="Product Image">
            <div class="card-body">
              <h5>{{$cate->name}}</h5>
              <p>
                {{$cate->description}}
              </p>
            </div>
          </div>
          </a>
        </div>
        @endforeach
      </div>

    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $('.featured-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    dots: false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      },
      1000: {
        items: 4
      }
    }
  })
</script>
@endsection