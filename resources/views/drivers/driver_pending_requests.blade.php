@extends('layouts.app', ['page' => __('driver_pending_requests'), 'pageSlug' => 'driver_pending_requests'])

@section('content')
<div class="row section-action">
    <div class="driver-request-container container height-all-page py-7 py-lg-8 ">
        <div class="row justify-content-start mar-0">
            <button class="btn-control-driver">سائق/ طلبات قيد الانتظار</button>
        </div>

        <div class="row justify-content-start mar-0  driver-pending-request-tab">
                <div class="col-sm-3 pad-0">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a data-toggle="pill" href="#1">طلب قيد الانتظار رقم 1</a></li>
                    <li><a  data-toggle="pill" href="#2">طلب قيد الانتظار رقم 2</a></li>
                    <li><a data-toggle="pill" href="#2">طلب قيد الانتظار رقم3</a></li>
                    <li><a data-toggle="pill" href="#2">طلب قيد الانتظار رقم4</a></li>
                  </ul>
                </div>
                <div class="col-md-7 col-sm-9  pad-0">
                    <div class="tab-content">
                        <div id="1" class="tab-pane fade in active show">
                            <p class="text-right">طلب قيد الانتظار رقم 1</p>
                            <div class="body-section">
                              <div class="row mar-0">
                                <div class="col-sm-4">
                                  <div class="title text-center color_8bddd8"><p>وقت الجولة</p></div>
                                  <div class="text text-center color_8bddd8"><p>11:30 AM</p></div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="title text-center color_cba6fe"><p>مكان الجولة</p></div>
                                  <div class="text text-center color_cba6fe"><p>أم السماق</p></div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="title text-center color_8bddd8"><p>عدد الطلبات</p></div>
                                  <div class="text text-center color_8bddd8"><p>2</p></div>
                                </div>
                              </div>
                            </div>
                            <br>
                            <div class="actions display-flex justify-content-between">
                                <button class="btn-accept btn">موافق</button>
                                <button class="btn-not-accept btn">غير موافق</button>
                            </div>
                        </div>
                        <div id="2" class="tab-pane fade">
                          
                        </div>
                      
                    </div>

                </div>
       

        </div>
    </div>
</div>
@endsection
