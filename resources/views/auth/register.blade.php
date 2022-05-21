@extends('layout.master-mini')

@section('content')
<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('assets/images/auth/register.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <h2 class="text-center mb-4">Register</h2>
      <div class="auto-form-wrapper">
        <form action="{{ route('register') }}" method="POST">
          @csrf
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" value="{{ old('name') }}">
              {{-- <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div> --}}
            </div>
              @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
            </div>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile" value="{{ old('mobile') }}">
            </div>
            @error('mobile')
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
          <div class="form-group d-flex justify-content-center">
            <div class="form-check form-check-flat mt-0">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" checked> I agree to the terms </label>
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-primary submit-btn btn-block">Register</button>
          </div>
          <div class="text-block text-center my-3">
            <span class="text-small font-weight-semibold">Already have and account ?</span>
            <a href="login" class="text-black text-small">Login</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection