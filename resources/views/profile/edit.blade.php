@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
 @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
      <div class="row justify-content-start mar-0">
      <button class="btn-control-panel btn-erp">الحساب الشخصي</button>
    </div>
    <div class="row profile-container text-right">

        <div class="col-md-8">
            <div class="card ">
                <div class="card-header">
                    <h5 class="title">تعديل البروفايل</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body ">
                            @csrf
                            @method('put')
                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>الاسم</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="text-right">البريد الإلكتروني</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">حفظ</button>
                    </div>
                </form>
            </div>

            <div class="card " id="password">
                <div class="card-header">
                    <h5 class="title">كلمة السر</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>كلمة السر الحالية</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>كلمة السر الجديدة</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>تأكيد كلمة السر الجديدة</label>
                            <input type="password" name="password_confirmation" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">تغيير كلمة السر</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ auth()->user()->image }}" alt="">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>
                            <button class="btn-edit-photo btn btn-fill btn-primary">تعديل الصورة الشخصية</button>
                            <div class="block-edit-photo" style="display: none;">
                                <form  action="editPhoto"  method="POST" enctype="multipart/form-data">
        
                                   @csrf
                                   <input type="file" name="image" class="form-control form-photo {{ $errors->has('image') ? ' is-invalid' : '' }}"  value="{{ old('image') }}" required>
                                   @include('alerts.feedback', ['field' => 'image'])
                                   <input type="hidden" name="user" value="{{ auth()->user()->id }}">

                                   <div class="block-actions">
                                     <button class="btn-save" type="submit" action="{{ route('profile.update') }}">تعديل</button>
                                     <button class="btn-cancel">إلغاء</button>
                                   </div>

                               </form>

                            </div>
                        </div>
                    </p>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
       if(window.location.hash=="password"){
        window.location.hash = '#password';
      }
        $('.btn-edit-photo').click(function(){
            $('.block-edit-photo').show()
        })
    </script>
@endsection
