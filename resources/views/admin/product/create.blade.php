@extends('layouts.admin')

@section('title')
Product
@endsection

@section('content')
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <strong>Add Product</strong>
    </div>
    <form action="{{url('/insert')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-body card-block">
          <div class="has-success form-group">
          <label for="select" class="form-control-label">Select Category</label>
            <select name="category_id" class="is-valid form-control-success form-control" required>
              <option value="">Please select</option>
              @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
          </div>
        <div class="has-success form-group">
          <label for="inputIsValid" class=" form-control-label">Name</label>
          <input type="text" id="inputIsValid" name="name" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Slug</label>
          <input type="text" id="inputIsValid" name="slug" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Small Description</label>
          <textarea type="text" rows="3" name="small_description" id="small_summernote" class="is-valid form-control-success form-control" required></textarea>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Description</label>
          <textarea type="text" rows="3" name="description" id="desc_summernote" class="is-valid form-control-success form-control" required></textarea>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Original Price</label>
          <input type="number" id="inputIsValid" name="original_price" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Selling Price Price</label>
          <input type="number" id="inputIsValid" name="selling_price" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Quantity</label>
          <input type="number" id="inputIsValid" name="qty" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Tax</label>
          <input type="number" id="inputIsValid" name="tax" class="is-valid form-control-success form-control" required>
        </div>
        <div class="has-success form-group">
          <label for="inputIsValid" class=" form-control-label">Status</label>
          <input type="checkbox" name="status">
        </div>
        <div class="has-success form-group">
          <label for="inputIsInvalid" class=" form-control-label">Trending</label>
          <input type="checkbox" name="trending">
        </div>
        <div class="has-success form-group">
          <label for="inputIsvalid" class=" form-control-label">Product Image</label>
          <input type="file" id="inputIsvalid" name="product_image" class="is-valid form-control">
        </div>
        <div class="has-success form-group">
          <label for="inputIsvalid" class=" form-control-label">Meta Title</label>
          <input type="text" id="inputIsvalid" name="meta_title" class="is-valid form-control">
        </div>
        <div class="has-success form-group">
          <label for="inputIsvalid" class=" form-control-label">Meta Description</label>
          <textarea type="text" rows="3" name="meta_descrip" id="metadesc_summernote" class="is-valid form-control"></textarea>
        </div>
        <div class="has-success form-group">
          <label for="inputIsvalid" class=" form-control-label">Meta Keywords</label>
          <textarea type="text" name="meta_keywords" rows="3" id="meta_summernote" class="is-valid form-control"></textarea>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
          <i class="fa fa-dot-circle-o"></i> Submit
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
    $('#small_summernote').summernote({
        placeholder: 'Hello Bootstrap 5',
        tabsize: 2,
        height: 100
    });

    $('#desc_summernote').summernote({
        placeholder: 'Hello Bootstrap 5',
        tabsize: 4,
        height: 150
    });

    $('#metadesc_summernote').summernote({
        placeholder: 'Hello Bootstrap 5',
        tabsize: 2,
        height: 100
    });

    $('#meta_summernote').summernote({
        placeholder: 'Hello Bootstrap 5',
        tabsize: 2,
        height: 100
    });
</script>
@endsection