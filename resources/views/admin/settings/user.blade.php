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
              <h2 class="card-title mb-0">All Users</h2> 
              <div class="wrapper d-flex">
                <div class="d-flex align-items-center mr-3">
                  <a href="{{url('users-add')}}" class="btn btn-outline-success btn-fw"><i class="mdi mdi-plus-circle-outline"></i>Add New</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Mobile </th>
                    <th> Father's Name </th>
                    <th> Date of Birth </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr class="{{$loop->index % 2 == 1 ? 'table-primary' : '' }}">
                      <td class="font-weight-medium"> {{$loop->iteration}} </td>
                      <td> {{$user->name}} </td>
                      <td> {{$user->mobile}} </td>
                      <td> {{$user->father_name}} </td>
                      <td> {{$user->dob}} </td>
                      <td>
                        <a href="#" class="badge badge-warning"> Edit </a>
                        <a href="#" class="badge badge-success"> Details </a>
                      </td>
                    </tr>
                  @endforeach
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