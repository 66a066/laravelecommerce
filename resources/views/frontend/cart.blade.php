@extends('layouts.frontend')
@section('title')
My Cart
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
  <div class="container">
    <h6 class="mb-0">
      <a href="{{url('/')}}">
        Home
      </a> /
      <a href="{{url('cart')}}">
        Cart
      </a>
    </h6>
  </div>
</div>
<div class="container my-5">
  <div class="card shadow cartitems">
    @if($carts->count() > 0)
    <div class="card-body">
      @php $total=0; @endphp
      @foreach($carts as $cart)
      <div class="row product_data">
        <div class="col-md-2 my-auto">
          <img src="{{asset('assets/product/'.$cart->product->product_image)}}" height="70px" width="70px" alt="Product Image">
        </div>
        <div class="col-md-3 my-auto">
          <h6>{{$cart->product->name}}</h6>
        </div>
        <div class="col-md-2 my-auto">
          <h6> RS {{$cart->product->selling_price}}</h6>
        </div>
        <div class="col-md-3 my-auto">
          <input type="hidden" value="{{$cart->product_id}}" class="prod_id">
          @if($cart->product->qty >= $cart->product_qty)
          <label for="Quantity">Quantity</label>
          <div class="input-group text-center mb-3" style="width: 130px;">
            <button class="input-group-text changeQunatity decreament-btn">-</button>
            <input type="text" name="quantity" value="{{$cart->product_qty}}" class="form-control qty-input" />
            <button class="input-group-text changeQunatity increament-btn">+</button>
          </div>
          @php $total += $cart->product->selling_price * $cart->product_qty; @endphp
          @else
          <h6>Out Of Stock</h6>
          @endif
        </div>
        <div class="col-md-2 my-auto">
          <button class="btn btn-danger delete-cart-item"><i class="fa fa-trash"></i>Remove</button>
        </div>
      </div>
      @endforeach
    </div>
    @if($cart->product->qty > 0)
    <div class="card-footer">
      <h6>Total Price : RS {{number_format($total)}}
      <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Proceed to Checkout</a>
      </h6>
    </div>
    @endif
    @else
    <div class="card-body text-center">
      <h2>Your <i class="fa fa-shopping-cart"></i> Cart is empty</h2>
      <a href="{{url('category')}}" class="btn btn-outline-primary float-end">Continue Shopping</a>
    </div>
    @endif
  </div>
</div>
@endsection

<h5></h5>