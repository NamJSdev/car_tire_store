@extends('layouts.login')

@section('title', 'Đăng Nhập')

@section('content')
<section class="login-content">
    <div class="container">
       <div class="row align-items-center justify-content-center height-self-center">
          <div class="col-lg-8">
             <div class="card auth-card">
                <div class="card-body p-0">
                   <div class="d-flex align-items-center auth-content">
                      <div class="col-lg-7 align-self-center">
                         <div class="p-3">
                            <h2 class="mb-2">Đăng Nhập</h2>
                            <p>Đăng nhập để duy trì kết nối.</p>
                            <form method="POST" action="{{ route('login') }}">
                            @csrf
                               <div class="row">
                                  <div class="col-lg-12">
                                     <div class="floating-label form-group">
                                        <input class="floating-input form-control" name="email" type="email" placeholder=" " required>
                                        <label>Email</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                     </div>
                                  </div>
                                  <div class="col-lg-12">
                                     <div class="floating-label form-group">
                                        <input class="floating-input form-control" name="password" type="password" placeholder=" " required>
                                        <label>Mật Khẩu</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                     </div>
                                  </div>
                                  <div class="col-lg-6">
                                  </div>
                                  <div class="col-lg-6">
                                  </div>
                               </div>
                               <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                               <p class="mt-3">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                               </p>
                            </form>
                         </div>
                      </div>
                      <div class="col-lg-5 content-right">
                         <img src="../assets/images/login/01.png" class="img-fluid image-right" alt="">
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
@endsection