@extends('layouts.app', ['page' => __('driver_requests'), 'pageSlug' => 'driver_requests'])

@section('content')
<div class="row section-action">
    <div class="driver-request-container container height-all-page py-7 py-lg-8 ">
        <div class="row justify-content-start mar-0">
            <button class="btn-control-driver">سائق/ طلبات التوظيف</button>
        </div>

        <div class="row justify-content-start mar-0 drivers-tab">
         @if(sizeof($drivers)>0 )
                <div class="col-sm-3 pad-0">
                  <ul class="nav nav-pills nav-stacked">
                     <?php $index=1 ?>
                      @foreach ($drivers as $item)
                        <li @if($index == 1 ) class="active" @endif><a data-toggle="pill" href="#{{$index}}">طلب توظيف / رقم {{$index}}</a></li>
                        <?php $index++ ?>
                      @endforeach
                    
                  </ul>
                </div>
                <div class="col-md-6 col-sm-9  pad-0">
                    <div class="tab-content">
                      <?php $index=1 ?>
                      @foreach ($drivers as $item)
                        <div id="{{$index}}" class="tab-pane fade @if($index == 1 ) in active show @endif">
                         <p class="text-right">طلب توظيف / رقم {{$index}}</p>
                         <div class="body-section">
                              <div class="display-flex">
                                  <div class="title text-right color_8bddd8"><p>اسم السائق</p></div>
                                  <div class="text text-right color_cba6fe"><p>{{$item->name}}</p></div>
                              </div>

                              <div class="display-flex">
                                  <div class="title text-right color_8bddd8"><p>رقم الهاتف</p></div>
                                  <div class="text text-right color_cba6fe"><p>{{$item->  phone}}</p></div>
                              </div>
                              <div class="display-flex">
                                  <div class="title text-right color_8bddd8"><p>العنوان</p></div>
                                  <div class="text text-right color_cba6fe"><p>{{$item->location}}</p></div>
                              </div>
                              <div class="display-flex">
                                  <div class="title text-right color_8bddd8"><p>المركبة</p></div>
                                  <div class="text text-right color_cba6fe"><p>{{$item->car}}</p></div>
                              </div>
                              <div class="display-flex">
                                  <div class="title text-right color_8bddd8"><p>موديل المركبة</p></div>
                                  <div class="text text-right color_cba6fe"><p>{{$item->car_model}}</p></div>
                              </div>
                            </div>
                            <div class="actions display-flex justify-content-between">
                                <a href="/driver_requests_approved?id={{ $item->id }}" class="btn-accept btn">موافق</a>
                                <a href="/driver_requests_declined?id={{ $item->id }}" class="btn-not-accept btn">غير موافق</a>
                                
                            </div>
                            <div class="msg-send-action">
                                <button class="btn btn-send">ارسل رسالة</button>
                            </div>
                        </div>
                        <?php $index++ ?>
                      @endforeach
                    </div>

                </div>
          @else
            <div style="display: flex;align-items: center;justify-content: center;height: 100px; width: 100%;background: #F1F1F1;font-size: 20px;"><span>لا يوجد طلبات توظيف للعرض</span></div>
          @endif
       

        </div>
    </div>
</div>
@endsection
