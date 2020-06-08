@extends('layouts.app', ['page' => __('driver_details'), 'pageSlug' => 'driver_details'])

@section('content')
<div class="row section-action">
    <div class="driver-details-container container height-all-page py-7 py-lg-8 ">
        <div class="row justify-content-start mar-0">
            <button class="btn-control-driver">اسماء السائقين</button>
        </div>

        <div class="row justify-content-start mar-0">
          <div class="col-md-2 pad-0">
            <div class="title driver_title text-right"><p>اسم السائق</p></div>
            <div class="text driver_text text-right"><p>{{$drivers->name}}</p></div>
          </div>
          <div class="col-md-3 color-pink pad-0">
            <div class="title text-center"><p>عدد ساعات العمل</p></div>
            <div class="text  text-center"><p>@if($drivers->number_work!=null) {{$drivers->number_work}} @else 0 @endif</p></div>
          </div>
          <div class="col-md-2 color-green pad-0">
            <div class="title text-center"><p>أجر السائق</p></div>
            <div class="text  text-center"><p>@if($drivers->salary!=null) {{$drivers->salary}} J.D @else 0 @endif</p></div>
          </div>
          <div class="col-md-2 color-pink pad-0">
            <div class="title text-center"><p>عدد الجولات</p></div>
            <div class="text  text-center"><p>@if($drivers->number_rounds!=null) {{$drivers->number_rounds}} @else 0 @endif</p></div>
          </div>
          <div class="col-md-3 color-green pad-0">
            <div class="title text-center"><p>رصيده في التطبيق</p></div>
            <div class="text  text-center"><p>@if($drivers->balance!=null) {{$drivers->balance}} @else 0 @endif</p></div>
          </div>


        </div>
    </div>
</div>
@endsection
