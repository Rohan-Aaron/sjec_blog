@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div
class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
<div class="d-flex align-items-center justify-content-center w-100">
  <div class="row justify-content-center w-100">
    <div class="col-md-8 col-lg-6 col-xxl-3">
      <div class="card mb-0">
        <div class="card-body">
          <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
            <img src="{{asset('images/dark-logo.svg')}}" width="180" alt="">
          </a>
          <p class="text-center">Access to our Dashboard</p>
          <form action="{{route('auth.login')}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Username</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              @error('email')
                <p class="text-danger mt-2">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-4">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1">
              @error('password')
                <p class="text-danger mt-2">{{ $message }}</p>
              @enderror
            </div>
            <div class="d-flex align-items-center justify-content-between mb-4">
              <div class="form-check">
                <input class="form-check-input primary" type="checkbox" value="" name="remember" id="flexCheckChecked" checked>
                <label class="form-check-label text-dark" for="flexCheckChecked">
                  Remeber this Device
                </label>
              </div>
              {{-- <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a> --}}
            </div>
            <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit">Sign In</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection