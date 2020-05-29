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
                <button class="row btn-homepage btn-different burble-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    200
                    <br>
                    الطلبات قيد الانتظار
                    </div>
                </button>
                <button class="row btn-homepage btn-different yellow-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    100
                    <br>
                    الطلبات قيد التأكيد
                    </div>
                </button>
            </div>
            <div class="col-md-4">
                <div class=" justify-content-start align-items-center text-right tab-driver">
                    <span>السائقين المتاحين </span>
                </div>
                <button class="row btn-homepage btn-different green-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    10
                    <br>
                    سائقين متاحين
                    </div>
                </button>
                <div class=" justify-content-start align-items-center text-right tab-driver">
                    <span>الجولات </span>
                </div>
                <button class="row btn-homepage btn-different yellow-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    1000
                    <br>
                    الجولات المنتهية
                    </div>
                </button>
            </div>
            <div class="col-md-4">
                <div class=" justify-content-start align-items-center text-right tab-driver">
                    <span>حسابات التوصيل </span>
                </div>
                <button class="row btn-homepage btn-different green-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    2000 jd
                    <br>
                    حسابات التوصيل
                    </div>
                </button>
                <div class=" justify-content-start align-items-center text-right tab-driver">
                    <span>مواقع السائقين </span>
                </div>
                <iframe width="100%" style="height: 60vh;margin: 10% 0%;" src="https://maps.google.com/maps?q=amman&t=&z=14&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net"></a>
            </div>
        </div>
    </div>
</div>
@endsection
