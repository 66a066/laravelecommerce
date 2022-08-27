@extends('layouts.frontend')
@section('title')
My Wishlist
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
  <div class="container">
    <h6 class="mb-0">
      <a href="{{url('/')}}">
        Home
      </a> /
      <a href="{{url('wishlist')}}">
        Wishlist
      </a>
    </h6>
  </div>
</div>
<div class="container my-5">
  <div class="card shadow wishitems">
    <div class="card-body">
      @if($wishlists->count() > 0)
      @foreach($wishlists as $wishlist)
      <div class="row product_data">
        <div class="col-md-2 my-auto">
          <img src="{{asset('assets/product/'.$wishlist->product->product_image)}}" height="70px" width="70px" alt="Product Image">
        </div>
        <div class="col-md-2 my-auto">
          <h6>{{$wishlist->product->name}}</h6>
        </div>
        <div class="col-md-2 my-auto">
          <h6> RS {{$wishlist->product->selling_price}}</h6>
        </div>
        <div class="col-md-2 my-auto">
          <input type="hidden" value="{{$wishlist->product_id}}" class="product_id">
          @if($wishlist->product->qty >= $wishlist->product_qty)
          <label for="Quantity">Quantity</label>
          <div class="input-group text-center mb-3" style="width: 130px;">
            <button class="input-group-text decreament-btn">-</button>
            <input type="text" name="quantity" value="1" class="form-control qty-input" />
            <button class="input-group-text increament-btn">+</button>
          </div>
          @else
          <h6>Out Of Stock</h6>
          @endif
        </div>
        <div class="col-md-2 my-auto">
          <button class="btn btn-success addToCartBtn"><i class="fa fa-shopping-cart"></i>Add to Cart</button>
        </div>
        <div class="col-md-2 my-auto">
          <button class="btn btn-danger delete-wishlist-item"><i class="fa fa-trash"></i>Remove</button>
        </div>
      </div>
      @endforeach
      @else
      <div class="card-body text-center">
        <h2>Your <i class="fa fa-heart"></i> Wishlist is empty</h2>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
