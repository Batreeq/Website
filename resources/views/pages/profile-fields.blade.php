@extends('layouts.app', ['page' => __('profile-fields'), 'pageSlug' => 'profile-fields'])

@section('content')
  <div class="continaer-profile-fields ">

    <div class="row justify-content-start mar-0">
        <button  class="btn-control-panel btn-erp">لوحة التحكم/ حقول الملف الشخصي</button>
    </div>
    <div class=" row justify-content-center " >

      <div class="col-lg-6 fileds">
        <div class="display-flex justify-content-center  align-items-center">
           
          <input disabled="" type="text" class="form-control" placeholder="الاسم" >
          <span  class="reject-link" style="padding-right:10px">
            <i class="fas fa-trash-alt fa-xs"></i>
          </span>
         
        </div>
        <br>
        <div class="display-flex justify-content-center  align-items-center">
          <input disabled="" type="number" class="form-control" placeholder="رقم الهاتف" >
          <span  class="reject-link" style="padding-right:10px">
              <i class="fas fa-trash-alt fa-xs"></i>
          </span>
        </div>
        <br>
        <div class="display-flex justify-content-center  align-items-center">
          <input disabled="" type="email" class="form-control" placeholder="البريد الإلكتروني" >
          <span  class="reject-link" style="padding-right:10px">
              <i class="fas fa-trash-alt fa-xs"></i>
          </span>
        </div>
        <br>
      </div>

    </div>

    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-8">
            <input type="text" class="form-control" name="field-name" value="">
            <br>
          </div>
          <div class="col-lg-4 text-center">
            <button  class="btn-add">إضافة</button>
          </div>
        </div>
      </div>
    </div>
 

  </div>
  <script type="text/javascript">
    $('.reject-link').click(function(){
       $(this).parent().hide()
    })
    $('.btn-add').click(function(){
      var elm = '<div class="display-flex justify-content-center  align-items-center"><input disabled="" type="number" required  class="form-control" placeholder="'+$('input[name=field-name]').val()+'" ><span  class="reject-link" onClick="$(this).parent().hide();" style="padding-right:10px"><i class="fas fa-trash-alt fa-xs"></i></span></div><br>';
      $(elm).appendTo('.fileds');
    })
  </script>
@endsection
