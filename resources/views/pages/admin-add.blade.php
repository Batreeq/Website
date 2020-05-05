@extends('layouts.app', ['page' => __('Admin-add'), 'pageSlug' => 'admin-add'])

@section('content')
<div class=" add-admin-container ">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

      <form action="add_admin" class="form-offer form-add-admin" method="POST" enctype="multipart/form-data">
        @csrf
        

        <div class="row mar-0">

          <div class="col-lg-6 text-right">
            <span class="title">اسم الأدمن</span>
            <div class="input-group">
                <input type="text" name="name" class="form-control "  value="" required>
            </div>
          </div>
          <div class="col-lg-6  text-right">
            <span class="title">صورة الأدمن</span>
             <div class="input-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                <input type="file" name="image" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"  value="{{ old('image') }}" required>
                    @include('alerts.feedback', ['field' => 'image'])
            </div>

          </div>

          <div class="col-lg-6  text-right">
            <span class="title ">رقم هاتف</span>
            <input type="number" name="phone" class="form-control "  value="" required>
          </div>

          <div class="col-lg-6  text-right">
            <span class="title">البريد الإلكتروني</span>
            <div class="input-group">
                <input type="email" name="email" class="form-control "  value="" required>
            </div>
          </div>
          <div class="col-lg-6  text-right">
            <span class="title">كلمة السر</span>
            <input type="password" name="password" class="form-control "  value="" required>
          </div>
          
        </div>
      <br>
        <div class="row justify-content-center mar-0">
          <button type="submit" class="btn-add">إضافة</button>
        </div>


      </form>



<br><br>
  </div>


<script type="text/javascript">
 
</script>
@endsection


