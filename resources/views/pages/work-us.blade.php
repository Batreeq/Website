@extends('layouts.app', ['page' => __('Work-us'), 'pageSlug' => 'work-us'])

@section('content')
<div class="container work-us-container">
    <div class="row justify-content-start">
      <button  class="btn-control-panel btn-erp">لوحة التحكم/قسم اعمل معنا</button>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="row section-action">
            
            <div class="col-lg-6">
              <button class="btn-different btn-chat text-mar">
                <a href="/work-us-screens?type=1" style="color: white">
                  <span>شريك سوبر ماركت</span>
                </a>
              </button>
            </div>
            <div class="col-lg-6">
              <button  class="btn-different btn-erp text-mar">
                <a href="/work-us-screens?type=2" style="color: white">
                  <span>موظف معنا</span>
                </a>
              </button>
            </div>
            <div class="col-lg-6">
              <button  class="btn-different btn-app text-mar-mobile">
                <a href="/work-us-screens?type=3" style="color: white">
                  <span>تاجر</span>
                </a>
              </button>
            </div>
            <div class="col-lg-6">
              <button  class="btn-different btn-crm text-mar-mobile">
                <a href="/drivers" style="color: white">
                  <span>سائق</span>
                </a>
              </button>
            </div>
         </div>
      </div>
    </div>
  </div>
@endsection


