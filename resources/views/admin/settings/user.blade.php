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
              @if(session('status'))
                <div class="alert alert-success" role="alert">
                  {{ session('status') }}
                </div>
              @endif
              <div class="wrapper d-flex">
                <div class="d-flex align-items-center mr-3">
                  <a href="{{url('settings/users-add/'.base64_encode('addnew'))}}" class="btn btn-outline-success btn-fw"><i class="mdi mdi-plus-circle-outline"></i>Add New</a>
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
                    <th> Status </th>
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
                        @if($user->email_verified_at)
                          <span class="badge badge-success"> Verified </span>
                        @else
                          <span class="badge badge-dark"> Unverified </span>
                        @endif 
                      </td>
                      <td>
                        <a href="{{ url('settings/users-add/'.base64_encode('view').'/'.$user->id)}}" class="badge badge-primary"> View </a>
                        <a href="{{ url('settings/users-add/'.base64_encode('edit').'/'.$user->id)}}" class="badge badge-warning"> Edit </a>
                        <a href="{{ url('settings/users-delete/'.$user->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{$loop->iteration}}').submit();" class="badge badge-danger"> Delete </a>
                        <form action="{{ url('settings/users-delete/'.$user->id) }}" method="POST" id="delete-form-{{$loop->iteration}}" class="d-none">
                          @csrf
                          @method('DELETE')
                        </form>
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