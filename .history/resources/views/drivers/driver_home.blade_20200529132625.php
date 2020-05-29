@extends('layouts.app', ['page' => __('driver_home'), 'pageSlug' => 'driver_home'])

@section('content')
<div class="row section-action">
    <div class="homepage-container container height-all-page py-7 py-lg-8 ">
        <div class="row justify-content-start mar-0">
            <button class="btn-control-panel btn-driver">لوحة التحكم/المستخدمين/السائق </button>
        </div>

        <div class="row justify-content-start mar-0">
            <div class="col-md-4">
                <div class=" justify-content-start align-items-center text-right tab-driver">
                       <span>الطلبات </span>
                </div>
                <button class="row btn-homepage btn-different green-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    1000
                    <br>
                    الطلبات المنجزة
                    </div>
                </button>
                <button class="row btn-homepage btn-different green-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    1000
                    <br>
                    الطلبات المنجزة
                    </div>
                </button>
                <button class="row btn-homepage btn-different green-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    1000
                    <br>
                    الطلبات المنجزة
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
