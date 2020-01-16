@extends('layouts.app')

@section('content')
<!-- @php
 error_reporting(0);
@endphp -->
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md">
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
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <!-- <th scope="col">Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  @forelse($contactMessages as $contactMessage)
                  <tr class={{ ($contactMessage -> read_status==1)?"bg-info":"" }}>
                    <td>{{ $loop->index+1 }}</td>
                    <!-- <td>{{ App\Category::find($product -> category_id)->category_name }}</td> -->
                    <td>{{$contactMessage -> first_name}}</td>
                    <td>{{ $contactMessage -> last_name }}</td>
                    <td>{{ $contactMessage -> subject }}</td>
                    <td>{{ $contactMessage -> message }}</td>
                  </tr>
                  @empty
                  <tr class="text-center text-danger">
                    <td colspan="6">No data available</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
