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
          <h4 class="card-title">Add New User</h4>
          @if ($errors->updateProfileInformation->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->updateProfileInformation->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <form action="{{ url('users-save') }}" method="POST" enctype="multipart/form-data" class="forms-sample row" id="user-profile-information-update">
            @csrf
            <div class="col-12 col-md-8">
              <div class="form-group">
                <label for="exampleInputName1">Name</label>
                <input type="text" name="name" value="" class="form-control" id="exampleInputName1" placeholder="Name">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail3">Email address</label>
                <input type="email" name="email" value="" class="form-control">
              </div>
              <div class="form-group">
                <label for="exampleInputMobile">Mobile</label>
                <input type="number" name="mobile" value="" class="form-control" id="exampleInputMobile" min="8800000000001" placeholder="880XXXXXXXXXX">
              </div>
              <div class="form-group form-inline">
                <label for="exampleSelectGender">Gender</label>
                <div class="form-radio" style="margin-left: 15px;">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" id="gender1" value="Male" checked> Male <i class="input-helper"></i></label>
                </div>
                <div class="form-radio" style="margin-left: 15px; margin-right: 15px;">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" id="gender2" value="Female"> Female <i class="input-helper"></i></label>
                </div>
                <div class="form-radio">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" id="gender3" value="Common"> Common <i class="input-helper"></i></label>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputNID">NID</label>
                <input type="number" name="nid" value="" class="form-control" id="exampleInputNID" placeholder="NID">
              </div>
              <div class="form-group">
                <label for="exampleInputbod">Date of Birth</label>
                <input type="date" name="dob" value="" class="form-control" id="exampleInputbod" placeholder="YYYY-MM-DD">
              </div>
              <div class="form-group">
                <label for="exampleInputFatherName">Father Name</label>
                <input type="text" name="father_name" value="" class="form-control" id="exampleInputFatherName" placeholder="Father Name">
              </div>
              <div class="form-group">
                <label for="exampleInputMotherName">Mother Name</label>
                <input type="text" name="mother_name" value="" class="form-control" id="exampleInputMotherName" placeholder="Mother Name">
              </div>
              <div class="form-group">
                <label for="exampleInputDesignation">Designation</label>
                <input type="text" name="designation" value="" class="form-control" id="exampleInputDesignation" placeholder="Designation">
              </div>
              <div class="form-group">
                <label for="exampleInputPosition">Position</label>
                <input type="text" name="label" value="" class="form-control" id="exampleInputPosition" placeholder="Position">
              </div>
              <div class="form-group">
                <label for="examplebiography">Biography</label>
                <textarea class="form-control" name="bio" id="examplebiography" rows="4"></textarea>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <img class="" src="assets/images/faces/face8.jpg" alt="Profile image">
              <input type="hidden" name="old_img" value="">
              <div class="form-group">
                <input type="file" name="img" class="file-upload-default">
              </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
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