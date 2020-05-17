@extends('layouts.app', ['page' => __('Home-differents-parts'), 'pageSlug' => 'home-differents-parts'])

@section('content')
  <div class="continaer-delivery ">

    <div class="row justify-content-start mar-0">
        <button  class="btn-control-panel btn-erp">لوحة التحكم/ أجزاء متغيرة  </button>
    </div>

   <div class="row justify-content-center mar-0">
      <div class=" justify-content-center align-items-center  text-center btn-different btn-chat ">
          <a style="color: white;" href="/different-parts">الصفحة الرئيسية</a>
      </div>
      <div class=" justify-content-center align-items-center text-center  btn-different btn-erp ">
        <a style="color: white;" href="/profile-fields">الملف الشخصي</a>
      </div>
    </div>

  </div>
@endsection
