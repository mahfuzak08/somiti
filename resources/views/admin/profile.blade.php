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
          @if(session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          @if ($errors->updateProfileInformation->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->updateProfileInformation->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          {{-- {{$address}} --}}
          {{-- {{$nominee}} --}}
          <nav>
            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
              <li class="nav-item active"><a href="#nav-home" class="nav-link active" data-toggle="tab">Basic Info</a></li>
              <li class="nav-item"><a href="#nav-address" class="nav-link" data-toggle="tab">Address</a></li>
              <li class="nav-item"><a href="#nav-nominee" class="nav-link" data-toggle="tab">Nominee</a></li>
            </ul>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <form action="{{ route('user-profile-information.update') }}" method="POST" enctype="multipart/form-data" class="forms-sample row" id="user-profile-information-update">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                <div class="col-12 col-md-8">
                  <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" id="exampleInputName1" placeholder="Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail3">Email address</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputMobile">Mobile</label>
                    <input type="number" name="mobile" value="{{ auth()->user()->mobile }}" class="form-control" id="exampleInputMobile" min="8800000000001" placeholder="880XXXXXXXXXX">
                  </div>
                  <div class="form-group form-inline">
                    <label for="exampleSelectGender">Gender</label>
                    <div class="form-radio" style="margin-left: 15px;">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" id="gender1" value="Male" {{ auth()->user()->gender === 'Male' ? 'checked' : '' }}> Male <i class="input-helper"></i></label>
                    </div>
                    <div class="form-radio" style="margin-left: 15px; margin-right: 15px;">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" id="gender2" value="Female" {{ auth()->user()->gender === 'Female' ? 'checked' : '' }}> Female <i class="input-helper"></i></label>
                    </div>
                    <div class="form-radio">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" id="gender3" value="Common" {{ auth()->user()->gender === 'Common' ? 'checked' : '' }}> Common <i class="input-helper"></i></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputNID">NID</label>
                    <input type="number" name="nid" value="{{ auth()->user()->nid }}" class="form-control" id="exampleInputNID" placeholder="NID">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputbod">Date of Birth</label>
                    <input type="date" name="dob" value="{{ auth()->user()->dob }}" class="form-control" id="exampleInputbod" placeholder="YYYY-MM-DD">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFatherName">Father Name</label>
                    <input type="text" name="father_name" value="{{ (auth()->user()->father_name) }}" class="form-control" id="exampleInputFatherName" placeholder="Father Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputMotherName">Mother Name</label>
                    <input type="text" name="mother_name" value="{{ auth()->user()->mother_name }}" class="form-control" id="exampleInputMotherName" placeholder="Mother Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputDesignation">Designation</label>
                    <input type="text" name="designation" value="{{ auth()->user()->designation }}" class="form-control" id="exampleInputDesignation" placeholder="Designation">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPosition">Position</label>
                    <select class="form-control" @if(auth()->user()->label > 2) disabled @endif name="label" id="exampleFormControlSelect1">
                        @foreach($role as $row)
                            <option value="{{ $row->id }}" {{auth()->user()->label == $row->id  ? 'selected' : ''}}>{{ $row->name}}</option>
                        @endforeach  
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="examplebiography">Biography</label>
                    <textarea class="form-control" name="bio" id="examplebiography" rows="4">{{ auth()->user()->bio }}</textarea>
                  </div>
                </div>
                <div class="col-12 col-md-4">
                  <img class="" src="{{ url('pro_pic/'. auth()->user()->img) }}" onerror="this.onerror=null;this.src='assets/images/faces/face8.jpg';" alt="Profile image">
                  <input type="hidden" name="old_img" value="{{ auth()->user()->img }}">
                  <div class="form-group">
                    <input type="file" name="img" class="file-upload-default">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
            <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
              <div class="row">
                <div class="col-12 col-md-8">
                  <form action="{{route('address.save') }}" method="POST" id="nav-add-form">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="user_type" value="User">
                    <div class="form-group form-inline">
                      <div class="form-radio" style="margin-left: 15px;">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="address_type" id="address_type1" value="Present"> Present <i class="input-helper"></i></label>
                      </div>
                      <div class="form-radio" style="margin-left: 15px; margin-right: 15px;">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="address_type" id="address_type2" value="Permanent"> Permanent <i class="input-helper"></i></label>
                      </div>
                      <div class="form-radio" style="margin-left: 15px; margin-right: 15px;">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="address_type" id="address_type3" value="Office"> Office <i class="input-helper"></i></label>
                      </div>
                      <div class="form-radio">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="address_type" id="address_type4" value="Business"> Business <i class="input-helper"></i></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" name="full_address" class="form-control" placeholder="Address">
                    </div>
                    <div class="row">
                      <div class="form-group col-12 col-md-6">
                        <label>City</label>
                        <input type="text" name="city" class="form-control" placeholder="City">
                      </div>
                      <div class="form-group col-12 col-md-6">
                        <label>District</label>
                        <input type="text" name="district" class="form-control" placeholder="District">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-12 col-md-6">
                        <label>Division</label>
                        <input type="text" name="division" class="form-control" placeholder="Division">
                      </div>
                      <div class="form-group col-12 col-md-6">
                        <label>ZIP Code</label>
                        <input type="text" name="zip" class="form-control" placeholder="ZIP Code">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <a href="{{ url('settings/users') }}" class="btn btn-light">Cancel</a>
                    </div>
                  </form>
                </div>
                <div class="col-12 col-md-4">
                  @foreach($address as $row)
                    <address id="address{{$row->id}}">
                      <h4>{{$row->address_type}} Address</h4>
                      <span class="fulladdress">{{$row->full_address}}</span><br>
                      <span class="city">{{$row->city}}</span>, <span class="district">{{$row->district}}</span><br>
                      <span class="division">{{$row->division}}</span>, <span class="zip">{{$row->zip}}</span>. 
                      <a href="#" onclick="edit({{$row->id}})" class="badge badge-warning"> Edit </a>
                      <a href="{{ url('settings/address-delete/'.$row->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{$loop->iteration}}').submit();" class="badge badge-danger"> Delete </a>
                      <form action="{{ url('settings/address-delete/'.$row->id) }}" method="POST" id="delete-form-{{$loop->iteration}}" class="d-none">
                        @csrf
                        @method('DELETE')
                      </form>
                    </address><br><br>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-nominee" role="tabpanel" aria-labelledby="nav-nominee-tab">
              <div class="row">
                <div class="col-12 col-md-8">
                  <form action="{{route('nominee.save') }}" method="POST" id="user-nominee-information-update">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="user_type" value="Nominee">
                    <input type="hidden" name="address_type" value="Present">
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name">
                    </div>
                    <div class="row">
                      <div class="form-group col-12 col-md-6">
                        <label for="exampleInputMobile">Mobile</label>
                        <input type="text" name="mobile" class="form-control" id="exampleInputMobile" placeholder="Mobile">
                      </div>
                      <div class="form-group col-12 col-md-6">
                        <label for="exampleInputNID">NID</label>
                        <input type="text" name="nid" class="form-control" id="exampleInputNID" placeholder="NID">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-12 col-md-6">
                        <label for="exampleInputFatherName">Father Name</label>
                        <input type="text" name="father_name" class="form-control" id="exampleInputFatherName" placeholder="Father Name">
                      </div>
                      <div class="form-group col-12 col-md-6">
                        <label for="exampleInputMotherName">Mother Name</label>
                        <input type="text" name="mother_name" class="form-control" id="exampleInputMotherName" placeholder="Mother Name">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-12 col-md-4">
                        <label for="exampleInputbod">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" id="exampleInputbod" placeholder="YYYY-MM-DD">
                      </div>
                      <div class="form-group col-12 col-md-4">
                        <label for="exampleInputRelatioName">Relation</label>
                        <input type="text" name="relation" class="form-control" id="exampleInputRelatioName" placeholder="Relation">
                      </div>
                      <div class="form-group col-12 col-md-4">
                        <label for="exampleInputShare">Share (%)</label>
                        <input type="text" name="share" class="form-control" id="exampleInputShare" placeholder="100%">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ url('settings/users') }}" class="btn btn-light">Cancel</a>
                  </form>
                </div>
                <div class="col-12 col-md-4">
                  @foreach($nominee as $row)
                    <address id="nominee{{$row->id}}">
                      <h4>{{$row->name}}</h4>
                      <b>Mobile:</b> <span class="nmobile">{{$row->mobile}}</span><br>
                      <b>NID:</b> <span class="nnid">{{$row->nid}}</span><br>
                      <b>Date of Birth:</b> <span class="ndob">{{$row->dob}}</span><br>
                      <b>Father:</b> <span class="nfn">{{$row->father_name}}</span><br>
                      <b>Mother:</b> <span class="nmn">{{$row->mother_name}}</span><br>
                      <b>Relation:</b> <span class="nrelation">{{$row->relation}}</span> (<span class="nshare">{{$row->share}}</span>%)<br>
                      <a href="#" onclick="editn({{$row->id}})" class="badge badge-warning"> Edit </a>
                      <a href="{{ url('settings/nominee-delete/'.$row->id) }}" onclick="event.preventDefault(); document.getElementById('nominee-delete-form-{{$row->id}}').submit();" class="badge badge-danger"> Delete </a>
                      <form action="{{ url('settings/nominee-delete/'.$row->id) }}" method="POST" id="nominee-delete-form-{{$row->id}}" class="d-none">
                        @csrf
                        @method('DELETE')
                      </form>
                    </address><br><br>
                  @endforeach
                </div>
              </div>
            </div>
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
  <script>
    function edit(id){
      let ele = $("#address"+id);
      $('#nav-add-form input[name=id]').val(id);
      switch($(ele).find('h4').text()){
        case 'Present Address':
          $('#nav-add-form #address_type1').attr("checked", "checked");
          break;
        case 'Permanent Address':
          $('#nav-add-form #address_type2').attr("checked", "checked");
          break;
        case 'Office Address':
          $('#nav-add-form #address_type3').attr("checked", "checked");
          break;
        case 'Business Address':
          $('#nav-add-form #address_type4').attr("checked", "checked");
          break;
      }
      $('#nav-add-form input[name=full_address]').val(ele.find('.fulladdress').text());
      $('#nav-add-form input[name=city]').val(ele.find('.city').text());
      $('#nav-add-form input[name=district]').val(ele.find('.district').text());
      $('#nav-add-form input[name=division]').val(ele.find('.division').text());
    }

    function editn(id){
      let ele = $("#nominee"+id);
      $('#user-nominee-information-update input[name=id]').val(id);
      $('#user-nominee-information-update input[name=name]').val($(ele).find('h4').text());
      $('#user-nominee-information-update input[name=mobile]').val(ele.find('.nmobile').text());
      $('#user-nominee-information-update input[name=nid]').val(ele.find('.nnid').text());
      $('#user-nominee-information-update input[name=relation]').val(ele.find('.nrelation').text());
      $('#user-nominee-information-update input[name=share]').val(ele.find('.nshare').text());
      $('#user-nominee-information-update input[name=dob]').val(ele.find('.ndob').text());
      $('#user-nominee-information-update input[name=father_name]').val(ele.find('.nfn').text());
      $('#user-nominee-information-update input[name=mother_name]').val(ele.find('.nmn').text());
    }
  </script>
@endpush