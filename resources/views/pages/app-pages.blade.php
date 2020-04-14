
@extends('layouts.app', ['page' => __('App_pages'), 'pageSlug' => 'app-pages'])

@section('content')
    <div class=" continaer-app-pages ">
        <div class="row ">
          <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/ صفحات التطبيق  </button>
        </div>

        <div class="row section-second ">
            <div class="col-md-4">
                <div class="row justify-content-center align-items-xl-center">

                    <select class="form-control">
                        <option>الخصوصية والأمان </option>
                    </select>
                    <span class="input-group-btn arrow-select  justify-content-center align-items-xl-center">
                        <img width="27" src="{{ asset('white') }}/img/arrow.png" alt="arrow image">
                    </span>
     
                </div>
                <div class="row justify-content-center align-items-xl-center">

                    <select class="form-control">
                        <option>السياسة العامة </option>
                    </select>
                    <span class="input-group-btn arrow-select  justify-content-center align-items-xl-center">
                        <img width="27" src="{{ asset('white') }}/img/arrow.png" alt="arrow image">
                    </span>
                    
                </div>
                <div class="row justify-content-center align-items-xl-center">

                    <select class="form-control">
                        <option>أسئلة شائعة </option>
                    </select>
                    <span class="input-group-btn arrow-select  justify-content-center align-items-xl-center">
                        <img width="27" src="{{ asset('white') }}/img/arrow.png" alt="arrow image">
                    </span>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

