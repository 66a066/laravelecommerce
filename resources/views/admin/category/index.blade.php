@extends('layouts.admin')

@section('title')
Category
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">All Categories</h2>
            <a class="au-btn au-btn-icon au-btn--blue btn-sm" href="{{url('/add-category')}}">
            add Category</a>
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->description}}</td>
                        <td><img src="{{asset('assets/category/'.$category->category_image)}}"  class="cate-image" alt="image here" ></td>
                        <td>
                            <a href="{{url('edit-category/'.$category->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{url('delete-category/'.$category->id)}}" class="btn btn-danger btn-sm">Delete</a>
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