@extends('layouts.app', ['page' => __('Delivery'), 'pageSlug' => 'delivery'])

@section('content')
<div class="continaer-delivery ">
    <div class="row justify-content-start mar-0">
      <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/التوصيل </button>
    </div>
    <div class="row justify-content-center mar-0">
      <div class=" justify-content-center align-items-center  text-center btn-different btn-chat ">
          <a style="color: white;" href="/delivery-screens?type=1">توصيل للمنطقة</a>
      </div>
      <div class=" justify-content-center align-items-center text-center  btn-different btn-erp ">
        <a style="color: white;" href="/delivery-screens?type=2">توصيل حسب الكيلو</a>
      </div>
    </div>
    <div class="row justify-content-center mar-0">
      <div class=" justify-content-center align-items-center text-center btn-different btn-app ">
        <a style="color: white;" href="/delivery-screens?type=3">توصيلات مجانية </a>
      </div>
    </div>
   
   
  </div>
@endsection
