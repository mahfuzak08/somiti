@extends('layout.master-mini')
@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/login_1.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">
        @if(session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
        @endif
        <form action="{{route('password.request')}}" method="POST">
          @csrf
          <p style="text-align: center;">You must verify your email address, please check your email for a verification link.</p>
          <div class="form-group">
            <button class="btn btn-primary submit-btn btn-block">Resend email</button>
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