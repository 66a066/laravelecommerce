@extends('layouts.admin')

@section('title')
Product
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">All Products</h2>
            <a class="au-btn au-btn-icon au-btn--blue btn-sm" href="{{url('/add-product')}}">
                add Product</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Original Price</th>
                        <th>Selling Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->original_price}}</td>
                        <td>{{$product->selling_price}}</td>
                        <td><img src="{{asset('assets/product/'.$product->product_image)}}" class="cate-image" alt="image here"></td>
                        <td>
                            <a href="{{url('edit-product/'.$product->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{url('delete-product/'.$product->id)}}" class="btn btn-danger btn-sm">Delete</a>
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

