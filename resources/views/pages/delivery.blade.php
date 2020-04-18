@extends('layouts.app', ['page' => __('Delivery'), 'pageSlug' => 'delivery'])

@section('content')
<div class="continaer-delivery ">
    <div class="row justify-content-start">
      <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/التوصيل </button>
    </div>
    <div class="row justify-content-center">
      <div class=" justify-content-center align-items-center  text-center btn-different btn-chat ">
          <span>توصيل للمنطقة </span>
      </div>
      <div class=" justify-content-center align-items-center text-center  btn-different btn-erp ">
          <span>توصيل حسب الكيلو </span>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class=" justify-content-center align-items-center text-center btn-different btn-app ">
          <span>توصيلات مجانية </span>
      </div>
    </div>
   
   
  </div>
@endsection
