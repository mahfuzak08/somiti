@extends('layout.master')

@push('plugin-styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/plugin.css')}}">
@endpush

@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
              <h2 class="card-title mb-0">Category Management</h2> 
              @if(session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <div class="wrapper d-flex">
                <div class="d-flex align-items-center mr-3">
                  <a href="{{url('inventory/categories-add')}}" class="btn btn-outline-success btn-fw"><i class="mdi mdi-plus-circle-outline"></i>Add New</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Category Name </th>
                    <th> Parent Category </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($categories)==0)
                    <tr>
                      <td colspan="4" class="text-center">No Data Found</td>
                    </tr>
                  @else
                    @foreach ($categories as $row)
                      <tr class="{{$loop->index % 2 == 1 ? 'table-primary' : '' }}">
                        <td class="font-weight-medium"> {{$loop->iteration}} </td>
                        <td> {{$row->brand_name}} </td>
                        <td>
                          <a href="{{ url('inventory/categories-add/'.$row->id)}}" class="badge badge-warning"> Edit </a>
                          <a href="{{ url('inventory/categories-delete/'.$row->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{$loop->iteration}}').submit();" class="badge badge-danger"> Delete </a>
                          <form action="{{ url('inventory/categories-delete/'.$row->id) }}" method="POST" id="delete-form-{{$loop->iteration}}" class="d-none">
                            @csrf
                            @method('DELETE')
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}" defer></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}" defer></script>
@endpush