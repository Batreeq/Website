
@extends('layouts.app', ['page' => __('Different-parts'), 'pageSlug' => 'different-parts'])

@section('content')
  <div class="container ">
    <div class="row justify-content-start">
      <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/ أجزاء متغيرة </button>
      <button type="submit" onclick="window.open('/', '_self')" style="margin-right: 2%" class="btn-control-panel btn-erp">تعديل الأجزاء المتغيرة </button>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="row section-action">
            @foreach ($parts as $part)
                <div class="col-lg-6">
                <button onClick="window.open('/offers-screens?offer={{ $part->id }}','_self');" type="submit" href="" class="btn-different btn-chat text-mar">{{ $part->name }} </button>
                </div>
            @endforeach
            {{-- <div class="col-lg-6">
              <button onClick="window.open('/offers-screens?offer=عروض Jara','_self');" type="submit" href="" class="btn-different btn-crm text-mar">عروض Jara </button>
            </div>
            <div class="col-lg-6">
              <button type="submit" href="" class="btn-different btn-app text-mar">عروض خاصة </button>
            </div>

            <div class="col-lg-6">
              <button type="submit" href="" class="btn-different btn-chat">عروض أصنافي</button>
            </div>
            <div class="col-lg-6">
              <button type="submit" href="" class="btn-different btn-erp">عرض لمرة واحده</button>
            </div> --}}
         </div>
      </div>
    </div>
  </div>
@endsection
