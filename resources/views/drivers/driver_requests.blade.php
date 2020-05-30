@extends('layouts.app', ['page' => __('driver_requests'), 'pageSlug' => 'driver_requests'])

@section('content')
<div class="row section-action">
    <div class="driver-request-container container height-all-page py-7 py-lg-8 ">
        <div class="row justify-content-start mar-0">
            <button class="btn-control-driver">سائق/ طلبات التوظيف</button>
        </div>

        <div class="row justify-content-start mar-0 drivers-tab">
                <div class="col-sm-3 pad-0">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a data-toggle="pill" href="#1">طلب توظيف / رقم 1</a></li>
                    <li><a  data-toggle="pill" href="#2">طلب توظيف / رقم 2</a></li>
                    <li><a data-toggle="pill" href="#2">طلب توظيف / رقم 3</a></li>
                    <li><a data-toggle="pill" href="#2">طلب توظيف / رقم 4</a></li>
                    <li><a data-toggle="pill" href="#2">طلب توظيف / رقم 5</a></li>
                    <li><a data-toggle="pill" href="#2">طلب توظيف / رقم 6</a></li>
                    <li><a data-toggle="pill" href="#2">طلب توظيف / رقم 7</a></li>
                    <li><a data-toggle="pill" href="#2">طلب توظيف / رقم 8</a></li>
                    <li><a data-toggle="pill" href="#2">طلب توظيف / رقم 9</a></li>
                    <li><a data-toggle="pill" href="#2">طلب توظيف / رقم 10</a></li>
                     <li><a data-toggle="pill" href="#2">طلب توظيف / رقم 11</a></li>
                     <li><a data-toggle="pill" href="#2">طلب توظيف / رقم 12</a></li>
                  </ul>
                </div>
                <div class="col-md-6 col-sm-9  pad-0">
                    <div class="tab-content">
                        <div id="1" class="tab-pane fade in active show">
                            <p class="text-right">طلب توظيف / رقم 1</p>
                            <div class="body-section">
                              <div class="display-flex">
                                  <div class="title text-right"><p>اسم السائق</p></div>
                                  <div class="text text-right"><p>محمد محمد</p></div>
                              </div>

                              <div class="display-flex">
                                  <div class="title text-right"><p>رقم الهاتف</p></div>
                                  <div class="text text-right"><p>0000000000</p></div>
                              </div>
                              <div class="display-flex">
                                  <div class="title text-right"><p>العنوان</p></div>
                                  <div class="text text-right"><p>الأردن</p></div>
                              </div>
                              <div class="display-flex">
                                  <div class="title text-right"><p>رقم المركبة</p></div>
                                  <div class="text text-right"><p>000000</p></div>
                              </div>
                              <div class="display-flex">
                                  <div class="title text-right"><p>موديل المركبة</p></div>
                                  <div class="text text-right"><p>00000000</p></div>
                              </div>
                            </div>
                            <div class="actions display-flex justify-content-between">
                                <button class="btn-accept btn">موافق</button>
                                <button class="btn-not-accept btn">غير موافق</button>
                            </div>
                            <div class="msg-send-action">
                                <button class="btn btn-send">ارسل رسالة</button>
                            </div>
                        </div>
                        <div id="2" class="tab-pane fade">
                          <h3>Menu 1</h3>
                          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                      
                    </div>

                </div>
       

        </div>
    </div>
</div>
@endsection
