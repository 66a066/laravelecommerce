@extends('layouts.admin')
@section('title')
Orders
@endsection
@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-primary">
          <h4 class="text-white">Order View
          <a href="{{url('orders')}}" class="btn btn-warning float-right">Back</a>
          </h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 order-details">
              <h4>Shipping Details</h4>
              <hr>
              <label for="">First Name</label>
              <div class="border">{{$order->fname}}</div>
              <label for="">Last Name</label>
              <div class="border">{{$order->lname}}</div>
              <label for="">Email</label>
              <div class="border">{{$order->email}}</div>
              <label for="">Contact Number</label>
              <div class="border">{{$order->pnumber}}</div>
              <label for="">Shipping Adrress</label>
              <div class="border">
                {{$order->address1}},<br>
                {{$order->address2}},<br>
                {{$order->city}},<br>
                {{$order->state}},
                {{$order->country}}
              </div>
              <label for="">Zip Code</label>
              <div class="border">{{$order->pcode}}</div>
            </div>
            <div class="col-md-6">
              <h4>Order Details</h4>
              <hr>
            <table class="table table-bordered">
            <thead>
              <tr>
                <td>Name</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Image</td>
              </tr>
            </thead>
            <tbody>
              @foreach($order->orderitems as $item)
              <tr>
                <td>{{$item->products->name}}</td>
                <td>{{$item->qty}}</td>
                <td>{{$item->price}}</td>
                <td><img src="{{asset('assets/product/'.$item->products->product_image)}}" width="50px" alt="Product Image"></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <h4 class="px-2">Grand Total : <span class="float-end">{{$order->total_price}}</span></h4>
          <div class="mt-5 p-2">
          <label for="">Order Status</label>
          <form action="{{url('update-order/'.$order->id)}}" method="POST">
            @csrf
            @method('PUT')
          <select class="form-select" name="order_status">
          <option  {{$order->status == '0' ? 'selected' : ''}} value="0">Pending</option>
          <option {{$order->status == '1' ? 'selected' : ''}} value="1">Completed</option>
          </select><br>
          <button type="submit" class="btn btn-primary mt-3">Update</button>
          </form>
          </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection