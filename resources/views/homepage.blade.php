@extends('layouts.app', ['page' => __('homepage'), 'pageSlug' => 'homepage'])

@section('content')
    <div class="homepage-container container height-all-page py-7 py-lg-8 ">
        <div class="header-body height-all-page text-center mb-7">
            <div class="row height-all-page justify-content-center align-items-center">

                <div class="col-lg-6 col-md-6">
                   <div class="row section-texts">
                       <div class="col-lg-6">
                         <span class="text-common-color text-center  ">مرحبا بك في </span>
                      </div>
                      <div class="col-lg-6">
                        <span class="text-common-color text-center">JARA </span>
                      </div>
                     
                   </div>

                   <div class="row section-action">
                     <div class="col-lg-6">
                        <button  class="btn-homepage btn-different btn-crm text-mar">CRM </button>
                      </div>
                      <div class="col-lg-6">
                        <button  class="btn-homepage btn-different btn-app text-mar"><a style="color: white;" href="/dashboard">التطبيق</a> </button>
                      </div>
                     <div class="col-lg-6">
                        <button  class="btn-homepage btn-different btn-chat text-mar-mobile">Chat Bot  </button>
                      </div>
                      <div class="col-lg-6">
                        <button class="btn-homepage btn-different btn-erp text-mar-mobile">Erp System </button>
                      </div>
                      
                   </div>
                </div>
              
            </div>
        </div>
    </div>
@endsection
