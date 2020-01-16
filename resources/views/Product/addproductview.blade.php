@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-header bg-success">
              Product List
            </div>
            <div class="card-body">
              @if(session('deletestatus'))
              <div class="alert alert-danger">
                {{session('deletestatus')}}
              </div>
              @endif
              <table class="table">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">SL NO</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Produc Name</th>
                    <th scope="col">Product Description</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Alert Quantity</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($all_products as $product)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <!-- <td>{{ App\Category::find($product -> category_id)->category_name }}</td> -->
                    <td>{{$product->relationtocategory->category_name}}</td>
                    <td>{{ str_limit($product -> product_des, 20) }}</td>
                    <td>{{ $product -> product_price }}</td>
                    <td>{{ $product -> product_quantity }}</td>
                    <td>{{ $product -> alert_quantity }}</td>
                    <td>
                      <img src="{{asset('uploads/product_photos')}}/{{ $product -> product_image }}" alt="Not Found" width="50">
                    </td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ url('/delete/product') }}/{{$product-> id}}" class="btn btn-danger">Delete</a>
                        <a href="{{url('/edit/product')}}/{{$product-> id}}" class="btn btn-success">Update</a>
                      </div>
                    </td>
                  </tr>
                  @empty
                  <tr class="text-center text-danger">
                    <td colspan="6">No data available</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              {{$all_products->links()}}
            </div>
          </div>
          <div class="card">
            <div class="card-header bg-success">
              Deleted Products List
            </div>
            <div class="card-body">
              <table class="table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">SL NO</th>
                    <th scope="col">Produc Name</th>
                    <th scope="col">Product Description</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Alert Quantity</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($deleted_products as $deleted_product)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $deleted_product -> product_name }}</td>
                    <td>{{ str_limit($deleted_product -> product_des, 20) }}</td>
                    <td>{{ $deleted_product -> product_price }}</td>
                    <td>{{ $deleted_product -> product_quantity }}</td>
                    <td>{{ $deleted_product -> alert_quantity }}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ url('/restore/product') }}/{{$deleted_product-> id}}" class="btn btn-success">Restore</a>
                        <a href="{{ url('/force/delete/product') }}/{{$deleted_product-> id}}" class="btn btn-danger">Permananyly Delete</a>
                      </div>
                    </td>
                  </tr>
                  @empty
                  <tr class="text-center text-danger">
                    <td colspan="6">No data available</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              {{$all_products->links()}}
            </div>
          </div>
      </div>
      <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-success">
                Add Product Section
              </div>
              <div class="card-body">
                <form action="{{url('add/product/insert')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @if(session('status'))
                  <div class="alert alert-success">
                    {{session('status')}}
                  </div>
                  @endif
                  <div class="form-group">
                    @if($errors->all())
                    <div class="alert alert-danger">
                      @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                      @endforeach
                    </div>
                    @endif
                    <label for="">Add Category</label>
                    <select class="form-control" name="category_id">
                      <option value="">--Select One--</option>
                      @foreach($categories as $category)
                      <option value="{{ $category -> id }}">{{$category -> category_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Prouct Name</label>
                    <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="{{old('product_name')}}">
                  </div>
                  <div class="form-group">
                    <label for="">Prouct Description</label>
                    <textarea name="product_des" class="form-control" rows="3">{{old('product_des')}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Prouct Price</label>
                    <input type="text" class="form-control" name="product_price" placeholder="Enter Product Price" value="{{old('product_price')}}">
                  </div>
                  <div class="form-group">
                    <label for="">Prouct Quantity</label>
                    <input type="text" class="form-control" name="product_quantity" placeholder="Enter Product Quantity" value="{{old('product_quantity')}}">
                  </div>
                  <div class="form-group">
                    <label for="">Alert Quantity</label>
                    <input type="text" class="form-control" name="alert_quantity" placeholder="Enter Alert Quantity" value="{{old('alert_quantity')}}">
                  </div>
                  <div class="form-group">
                    <label for="">Upload Image</label>
                    <input type="file" class="form-control" name="product_image">
                  </div>
                  <button type="submit" class="btn btn-primary">Add Products</button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
