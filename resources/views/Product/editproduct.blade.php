@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('/add/product')}}">Add Product</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$single_product_info->product_name}}</li>
            </ol>
          </nav>
            <div class="card">
              <div class="card-header bg-success">
                Update Product Section
              </div>
              <div class="card-body">
                <form action="{{url('/edit/product/insert')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @if(session('updatestatus'))
                  <div class="alert alert-success">
                    {{session('updatestatus')}}
                  </div>
                  @endif
                  <div class="form-group">
                    <label for="">Prouct Name</label>
                    <input type="hidden" name="product_id" value="{{$single_product_info->id}}">
                    <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="{{$single_product_info->product_name}}">
                  </div>
                  <div class="form-group">
                    <label for="">Prouct Description</label>
                    <textarea name="product_des" class="form-control" rows="3">{{$single_product_info->product_des}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Prouct Price</label>
                    <input type="text" class="form-control" name="product_price" placeholder="Enter Product Price"value="{{$single_product_info->product_price}}">
                  </div>
                  <div class="form-group">
                    <label for="">Prouct Quantity</label>
                    <input type="text" class="form-control" name="product_quantity" placeholder="Enter Product Quantity"value="{{$single_product_info->product_quantity}}">
                  </div>
                  <div class="form-group">
                    <label for="">Alert Quantity</label>
                    <input type="text" class="form-control" name="alert_quantity" placeholder="Enter Alert Quantity"value="{{$single_product_info->alert_quantity}}">
                  </div>
                  <div class="form-group">
                    <label for="">Product Image</label>
                    <input type="file" class="form-control" name="product_image">
                    <img src="{{asset('uploads/product_photos')}}\\{{$single_product_info -> product_image}}" alt="" width="100">
                  </div>
                  <button type="submit" class="btn btn-primary">Update Products</button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
