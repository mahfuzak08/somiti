@extends('layout.master-mini')
@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/login_1.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">
        <form action="{{route('password.update')}}" method="POST">
          @csrf
          <input type="hidden" name="token" value="{{ $req->token }}">
          <h3 style="text-align: center;">Reset Password</h3>
          <div class="form-group">
            <div class="input-group">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $req->email }}">
            </div>
            @error('email')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
            </div>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-primary submit-btn btn-block">Update</button>
          </div>
          <div class="text-block text-center my-3">
            <span class="text-small font-weight-semibold">Not a member ?</span>
            <a href="register" class="text-black text-small">Create new account</a>
          </div>
        </form>
      </div>
      <ul class="auth-footer">
        <li>
          <a href="#">Conditions</a>
        </li>
        <li>
          <a href="#">Help</a>
        </li>
        <li>
          <a href="#">Terms</a>
        </li>
      </ul>
      <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
    </div>
  </div>
</div>

@endsection