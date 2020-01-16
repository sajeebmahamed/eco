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
                    <th scope="col">Menu Status</th>
                    <th scope="col">Created At</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $category)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $category -> category_name }}</td>
                    <td>{{ ($category -> menu_status == 1 ) ? "YES":"NO" }}</td>
                    <td>{{ $category -> created_at->format('d-m-Y h:i:s A') }}
                      <br>
                      {{$category -> created_at -> diffForHumans()}}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
      <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-success">
                Add Product Section
              </div>
              <div class="card-body">
                <form action="{{url('add/category/insert')}}" method="POST">
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
                    <label for="">Category Name</label>
                    <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" value="{{old('category_name')}}">
                  </div>
                  <div class="form-group">
                    <input type="checkbox" id="menu" name="menu_status" value="1"> <label for="menu">Use as Menu</label>
                  </div>
                  <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
