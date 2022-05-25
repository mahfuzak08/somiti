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
          <h4 class="card-title">My Profile</h4>
          @if ($errors->updatePassword->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->updatePassword->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          @if(session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <form action="{{ route('user-password.update') }}" method="POST" class="forms-sample row">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
            <div class="col-12 col-md-8">
              <div class="form-group">
                <label class="label">Current Password</label>
                <div class="input-group">
                  <input type="password" name="current_password" class="form-control" placeholder="*********">
                </div>
              </div>
              <div class="form-group">
                <label class="label">Password</label>
                <div class="input-group">
                  <input type="password" name="password" class="form-control" placeholder="*********">
                </div>
              </div>
              <div class="form-group">
                <label class="label">Confirm Password</label>
                <div class="input-group">
                  <input type="password" name="password_confirmation" class="form-control" placeholder="*********">
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4"></div>
            <button type="submit" class="btn btn-primary mr-2">Update</button>
            <button class="btn btn-light">Cancel</button>
          </form>
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