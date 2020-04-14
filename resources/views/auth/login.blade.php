@extends('layouts.app', ['class' => 'login-page', 'page' => _('Login Page'), 'contentClass' => 'login-page'])

@section('content')
  <div class="row">
    <div class="col-lg-6 col-md-6 ml-auto mr-auto">
        <form class="form form-login" method="post" action="{{ route('login') }}">
            @csrf

            <div class="form-container">
                <div class="form-header">
                    <h1 class="form-title text-center title-login">لوحة تحكم التطبيق </h1>
                </div>
                <div class="form-body">
                    <p class="text-dark  text-center text-login">تسجيل الدخول </p>
                    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="االبريد الإلكتروني" value="{{ old('email') }}">
                            @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <input type="password" placeholder="كلمة المرور" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                </div>

                <div class="form-check text-right {{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label class="form-check-label">
                            <span class="text-remember">تذكرني </span>
                            <input class="form-check-input {{ $errors->has('agree_terms_and_conditions') ? ' is-invalid' : '' }}" name="agree_terms_and_conditions"  type="checkbox"  {{ old('agree_terms_and_conditions') ? 'checked' : '' }}>
                            <span class="form-check-sign"></span>
                            
                        </label>
                    </div>
                </div>
                <br>
                <br>
                <div class="form-footer">
                    <button type="submit" href="" class=" btn-login  mb-3">تسجيل الدخول </button>
                  
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection