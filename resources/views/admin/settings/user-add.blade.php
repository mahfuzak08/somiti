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
          <h4 class="card-title">{{$type}} User</h4>
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <nav>
            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
              <li class="nav-item active"><a href="#nav-home" class="nav-link active" data-toggle="tab">Basic Info</a></li>
              <li class="nav-item"><a href="#nav-address" class="nav-link" data-toggle="tab">Address</a></li>
              <li class="nav-item"><a href="#nav-nominee" class="nav-link" data-toggle="tab">Nominee</a></li>
            </ul>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <form action="{{route('user.save') }}" method="POST" enctype="multipart/form-data" class="forms-sample row" id="user-profile-information-update">
                @csrf
                <input type="hidden" name="id" value="{{ $type === 'addnew' ? '' : $user[0]->id}}">
                <input type="hidden" name="post_type" value="{{ $type }}">
                <div class="col-12 col-md-8">
                  <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input @if($type === 'view') disabled @endif type="text" name="name" value="{{$type!=='addnew' ? $user[0]->name : ''}}" class="form-control" id="exampleInputName1" placeholder="Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail3">Email address</label>
                    <input @if($type === 'view') disabled @endif type="email" name="email" value="{{$type!=='addnew' ? $user[0]->email : ''}}" class="form-control">
                  </div>
                  @if($type === 'addnew')
                  <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input type="password" name="password" value="" class="form-control">
                  </div>
                  @endif
                  <div class="form-group">
                    <label for="exampleInputMobile">Mobile</label>
                    <input @if($type === 'view') disabled @endif type="number" name="mobile" value="{{$type!=='addnew' ? $user[0]->mobile : ''}}" class="form-control" id="exampleInputMobile" min="8800000000001" placeholder="880XXXXXXXXXX">
                  </div>
                  <div class="form-group form-inline">
                    <label for="exampleSelectGender">Gender</label>
                    <div class="form-radio" style="margin-left: 15px;">
                      <label class="form-check-label">
                        <input @if($type === 'view') disabled @endif type="radio" class="form-check-input" name="gender" id="gender1" value="Male" {{$type==='addnew' ? 'checked' : $user[0]->gender === 'Male' ? 'checked' : ''}}> Male <i class="input-helper"></i></label>
                    </div>
                    <div class="form-radio" style="margin-left: 15px; margin-right: 15px;">
                      <label class="form-check-label">
                        <input @if($type === 'view') disabled @endif type="radio" class="form-check-input" name="gender" id="gender2" value="Female" {{$type==='addnew' ? '' : $user[0]->gender === 'Female' ? 'checked' : ''}}> Female <i class="input-helper"></i></label>
                    </div>
                    <div class="form-radio">
                      <label class="form-check-label">
                        <input @if($type === 'view') disabled @endif type="radio" class="form-check-input" name="gender" id="gender3" value="Common" {{$type==='addnew' ? '' : $user[0]->gender === 'Common' ? 'checked' : ''}}> Common <i class="input-helper"></i></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputNID">NID</label>
                    <input @if($type === 'view') disabled @endif type="number" name="nid" value="{{$type!=='addnew' ? $user[0]->nid : ''}}" class="form-control" id="exampleInputNID" placeholder="NID">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputbod">Date of Birth</label>
                    <input @if($type === 'view') disabled @endif type="date" name="dob" value="{{$type!=='addnew' ? $user[0]->dob : ''}}" class="form-control" id="exampleInputbod" placeholder="YYYY-MM-DD">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFatherName">Father Name</label>
                    <input @if($type === 'view') disabled @endif type="text" name="father_name" value="{{$type!=='addnew' ? $user[0]->father_name : ''}}" class="form-control" id="exampleInputFatherName" placeholder="Father Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputMotherName">Mother Name</label>
                    <input @if($type === 'view') disabled @endif type="text" name="mother_name" value="{{$type!=='addnew' ? $user[0]->mother_name : ''}}" class="form-control" id="exampleInputMotherName" placeholder="Mother Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputDesignation">Designation</label>
                    <input @if($type === 'view') disabled @endif type="text" name="designation" value="{{$type!=='addnew' ? $user[0]->designation : ''}}" class="form-control" id="exampleInputDesignation" placeholder="Designation">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPosition">Position</label>
                    <select class="form-control" @if($type === 'view') disabled @endif name="label" id="exampleFormControlSelect1">
                        @if(auth()->user()->label == 1)
                          <option value="{{ auth()->user()->label }}" selected>{{ $user[0]->role_name }}</option>
                        @endif
                        @foreach($role as $row)
                            <option value="{{ $row->id }}" {{auth()->user()->label == $row->id  ? 'selected' : ''}}>{{ $row->name}}</option>
                        @endforeach  
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="examplebiography">Biography</label>
                    <textarea @if($type === 'view') disabled @endif class="form-control" name="bio" id="examplebiography" rows="4">{{$type!=='addnew' ? $user[0]->bio : ''}}</textarea>
                  </div>
                </div>
                <div class="col-12 col-md-4">
                  @if (isset($user[0]->img) && $user[0]->img !== "")
                      <img src="{{ url('pro_pic/'.$user[0]->img) }}" alt="Profile image">
                  @else
                    <img class="" src="{{ url('assets/images/faces/face8.jpg') }}" alt="Profile image">
                  @endif              
                  <input type="hidden" name="old_img" value="{{$type!=='addnew' ? $user[0]->img : ''}}">
                  <div class="form-group">
                    <input @if($type === 'view') disabled @endif type="file" name="img" class="file-upload-default">
                  </div>
                </div>
                <button @if($type === 'view') disabled @endif type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ url('settings/users') }}" class="btn btn-light">Cancel</a>
              </form>
            </div>
            <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
              <form action="{{route('user.save') }}" method="POST" class="forms-sample row" id="user-profile-information-update">
                @csrf
                <input type="hidden" name="user_id" value="{{ $type === 'addnew' ? '' : $user[0]->id}}">
                <input type="hidden" name="user_type" value="User">
                @for($i=0; $i<count($address_type); $i++)
                <div class="col-12 col-md-6" style="margin-bottom: 50px">
                  <input type="hidden" name="address_type" value="{{$address_type[$i]}}">
                  <div class="form-group">
                    <label>{{$address_type[$i]}} Address</label>
                    <input @if($type === 'view') disabled @endif type="text" name="full_address[]" value="{{$type!=='addnew' ? $user[0]->name : ''}}" class="form-control" placeholder="{{$address_type[$i]}} Address">
                  </div>
                  <div class="row">
                    <div class="form-group col-12 col-md-6">
                      <label>Division</label>
                      <input @if($type === 'view') disabled @endif type="text" name="division[]" value="{{$type!=='addnew' ? $user[0]->name : ''}}" class="form-control" placeholder="Division">
                    </div>
                    <div class="form-group col-12 col-md-6">
                      <label>District</label>
                      <input @if($type === 'view') disabled @endif type="text" name="district[]" value="{{$type!=='addnew' ? $user[0]->name : ''}}" class="form-control" placeholder="District">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-12 col-md-6">
                      <label>City</label>
                      <input @if($type === 'view') disabled @endif type="text" name="city[]" value="{{$type!=='addnew' ? $user[0]->name : ''}}" class="form-control" placeholder="City">
                    </div>
                    <div class="form-group col-12 col-md-6">
                      <label>ZIP Code</label>
                      <input @if($type === 'view') disabled @endif type="text" name="zip[]" value="{{$type!=='addnew' ? $user[0]->name : ''}}" class="form-control" placeholder="ZIP Code">
                    </div>
                  </div>
                </div>
                @endfor
              </form>
            </div>
            <div class="tab-pane fade" id="nav-nominee" role="tabpanel" aria-labelledby="nav-nominee-tab">Nominee Form</div>
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