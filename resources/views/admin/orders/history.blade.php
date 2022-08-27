@extends('layouts.admin')

@section('title')
Orders
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="overview-wrap">
      <h2 class="title-1">Orders History</h2>
      <a href="{{url('orders')}}" class="au-btn au-btn-icon au-btn--blue btn-sm">New Orders</a>
    </div>
  </div>
</div>
<div class="row m-t-30">
  <div class="col-md-12">
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
      <table class="table table-borderless table-data3">
        <thead>
          <tr class="text-white">
            <td>Order Date</td>
            <td>Tracking Number</td>
            <td>Total Price</td>
            <td>Status</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td>{{date('d-m-Y',strtotime($order->created_at))}}</td>
            <td>{{$order->tracking_no}}</td>
            <td>{{$order->total_price}}</td>
            <td>{{$order->status == '0' ? 'pending' : 'completed'}}</td>
            <td>
              <a href="{{url('admin/view-order/'.$order->id)}}" class="btn btn-primary">View</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- END DATA TABLE-->
  </div>
</div>

@endsection