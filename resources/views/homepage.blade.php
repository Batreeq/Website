@extends('layouts.app', ['pageSlug' => ''])

@section('content')
    <div class="homepage-container py-7 py-lg-8 ">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">

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
                            <button  class="btn-homepage btn-different btn-app text-mar">التطبيق </button>
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
    </div>
@endsection
