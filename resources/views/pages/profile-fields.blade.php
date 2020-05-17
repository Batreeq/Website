@extends('layouts.app', ['page' => __('profile-fields'), 'pageSlug' => 'profile-fields'])

@section('content')
  <div class="continaer-delivery ">

    <div class="row justify-content-start mar-0">
        <button  class="btn-control-panel btn-erp">لوحة التحكم/ حقول الملف الشخصي</button>
    </div>
    <div class=" row justify-content-center " >

      <div class="col-lg-6 fileds">
        <input disabled="" type="text" class="form-control form-price" placeholder="الاسم" >
        <br>
        <input disabled="" type="number" class="form-control form-price" placeholder="رقم الهاتف" >
        <br>
        <input disabled="" type="email" class="form-control form-price" placeholder="البريد الإلكتروني" >
        <br>
      </div>

    </div>

    <div class="row justify-content-center">
      <div class="col-lg-6">
         <div class="row">
          <div class="col-lg-8">
      <input type="text" name="field-name" value="">
      </div>
      <div class="col-lg-4">
      <button  class="btn-add">إضافة</button>
      </div>
      </div>
      </div>
    </div>

  </div>
  <script type="text/javascript">
    $('.btn-add').click(function(){
       var elm = '<input disabled="" type="number" required name="price" class="form-control form-price" placeholder="'+$('input[name=field-name]').val()+'" ><br>';
$(elm).appendTo('.fileds');
    })
  </script>
@endsection
