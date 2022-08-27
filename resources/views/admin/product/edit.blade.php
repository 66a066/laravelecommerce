@extends('layouts.admin')

@section('title')
Product
@endsection

@section('content')
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <strong>Update Product</strong>
    </div>
    <form action="{{url('update-product/'.$products->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card-body card-block">
          <div class="has-success form-group">
          <label for="select" class="form-control-label">Select Category</label>
            <select name="category_id" class="is-valid form-control-success form-control" required>
              <option value="{{$products->category->id}}">{{$products->category->name}}</option>
            </select>
          </div>
        <div class="has-success form-group">
          <label for="inputIsValid" class=" form-control-label">Name</label>
          <input type="text" id="inputIsValid" name="name" value="{{$products->name}}" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Slug</label>
          <input type="text" id="inputIsValid" name="slug" value="{{$products->slug}}" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Small Description</label>
          <textarea type="text" rows="3" name="small_description" id="inputIsValid" class="is-valid form-control-success form-control" required>{{$products->small_description}}</textarea>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Description</label>
          <textarea type="text" rows="3" name="description" id="inputIsValid" class="is-valid form-control-success form-control" required>{{$products->description}}</textarea>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Original Price</label>
          <input type="number" id="inputIsValid" name="original_price" value="{{$products->original_price}}" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Selling Price Price</label>
          <input type="number" id="inputIsValid" name="selling_price" value="{{$products->selling_price}}" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Quantity</label>
          <input type="number" id="inputIsValid" name="qty" value="{{$products->qty}}" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Tax</label>
          <input type="number" id="inputIsValid" name="tax" value="{{$products->tax}}" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsValid" class=" form-control-label">Status</label>
          <input type="checkbox" name="status" {{$products->status == "1" ? 'checked' : ''}}>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Trending</label>
          <input type="checkbox" name="trending" {{$products->trending == "1" ? 'checked' : ''}}>
        </div>
        @if($products->product_image)
        <img src="{{asset('assets/product/'.$products->product_image)}}"  class="cate-image" alt="image here">
        @endif
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Product Image</label>
          <input type="file" id="inputIsInvalid" name="product_image" class="is-invalid form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Meta Title</label>
          <input type="text" id="inputIsInvalid" name="meta_title" value="{{$products->meta_title}}" class="is-invalid form-control">
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Meta Description</label>
          <textarea type="text" rows="3" name="meta_descrip" id="inputIsInvalid" class="is-invalid form-control">{{$products->meta_descrip}}</textarea>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Meta Keywords</label>
          <textarea type="text" name="meta_keywords" rows="3" id="inputIsInvalid" class="is-invalid form-control">{{$products->meta_keywords}}</textarea>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
          <i class="fa fa-dot-circle-o"></i> Update
        </button>
      </div>
    </form>
  </div>
</div>
@endsection