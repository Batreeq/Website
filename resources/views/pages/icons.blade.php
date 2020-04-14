
@extends('layouts.app', ['page' => __('Products'), 'pageSlug' => 'products'])

@section('content')
  <div class="container ">
    <div class="row justify-content-start">
      <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/ أجزاء متغيرة </button>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="row section-action">
            
            <div class="col-lg-6">
              <button type="submit" href="" class="btn-different btn-crm text-mar">عروض Jara </button>
            </div>
            <div class="col-lg-6">
              <button type="submit" href="" class="btn-different btn-app text-mar">عروض خاصة </button>
            </div>
            
            <div class="col-lg-6">
              <button type="submit" href="" class="btn-different btn-chat">عروض أصنافي</button>
            </div>
            <div class="col-lg-6">
              <button type="submit" href="" class="btn-different btn-erp">عرض لمرة واحده</button>
            </div>
         </div>
      </div>
    </div>
  </div>
@endsection
