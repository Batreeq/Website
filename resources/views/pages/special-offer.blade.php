@extends('layouts.app', ['page' => __('Special-offer'), 'pageSlug' => 'special-offer'])

@section('content')
<div class="special-offer-container ">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

      <div class="row justify-content-between mar-0">
        <button  class="btn-control-panel btn-erp">لوحة التحكم/إضافة عرض خاص  </button>
        <select class="list-lang">
          <option value="ar">عربي</option>
          <option value="en">English</option>
        </select>
      </div>
      <table class="table tablesorter ">
        <thead class=" text-primary">
          <tr>
            <th class="text-center">
              اسم المنتج
            </th>
            <th class="text-center">
              سعر المنتج
            </th>
            <th class="text-center">
              سعر الجملة
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">{{$product[0]->name}}</td>
            <td class="text-center">{{$product[0]->price}}</td>
            <td class="text-center">{{$product[0]->name}}</td>
          </tr>
        </tbody>
      </table>

      <h2 class="text-center"> إضافة عرض خاص </h2>

      <form action="add_special_offer" class="form-offer" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{$product[0]->id}}" name="product_id">
        <div class="row mar-0">
          <div class="col-lg-6  text-right">
            <span class="title ">نوع المقدم له العرض الخاص</span>
            <div class="input-group {{ $errors->has('offer_type') ? ' has-danger' : '' }}">
              <select name="offer_type"
              class="form-control {{ $errors->has('offer_type') ? ' is-invalid' : '' }}">
                <option value="">اختر النوع المناسب</option>
                <option value="1">زبون</option>
                <option value="2">تاجر</option>
                <option value="3">سوبر ماركت</option>
              </select>
              @include('alerts.feedback', ['field' => 'offer_type'])
            </div>
          </div>

          <div class="col-lg-6  text-right">
            <span class="title ">فئة المقدم له العرض الخاص</span>
            <div class="input-group {{ $errors->has('product_special_price_for') ? ' has-danger' : '' }}">
               <select class="form-control  {{ $errors->has('product_special_price_for') ? ' is-invalid' : '' }}"
                     name="product_special_price_for">

                        <option value="">اختر الفئة المناسبة </option>
                        <option value="1">عدد مرات الشراء الكلي / اقل من ٣ مرات</option>
                        <option value="2">عدد مرات الشراء الكلي اكثر من ٣ مرات</option>
                        <option value="3">متوسط عدد مرات الشراء الشهري اقل من ٣ مرات</option>
                        <option value="4">متوسط عدد مرات الشراء الشهري اكثر من ٣ مرات</option>
                        <option value="5">قيمة الشراء الكلي اكثر من ١٠٠$ </option>
                        <option value="6">قيمة الشراء الكلي اقل من ١٠٠$ </option>
                        <option value="7">متوسط عدد  مرات استخدام التطبيق شهريا اكثر من ١٠ مرات </option>
                        <option value="8">متوسط عدد  مرات استخدام التطبيق شهريا اقل من ١٠ مرات</option>
                        <option value="9">متوسط قيمة الشراء الشهري اكثر من ٣٠$ </option>
                        <option value="10"> متوسط قيمة الشراء الشهري اقل من ٣٠$</option>
                        <option value="11">استخدام مستمر او متقطع لنفس الصنف او صنف منافس</option>
                        <option value="12">سعر خاص عشوائي لعدد معين من المستخدمين وفق الموقع الجغرافي</option>
                        <option value="13">اذا إنقطع المستخدم عن الشراء من التطبيق لفترة معينة</option>

                    </select>
              @include('alerts.feedback', ['field' => 'product_special_price_for'])
            </div>
          </div>

          <div class="col-lg-6  text-right">
            <span class="title">سعر العرض</span>

            <div class="input-group{{ $errors->has('product_special_price') ? ' has-danger' : '' }}">
              <input type="number" name="product_special_price" class="form-control {{ $errors->has('product_special_price') ? ' is-invalid' : '' }}" value="{{ old('product_special_price') }}">
              @include('alerts.feedback', ['field' => 'product_special_price'])
            </div>


          </div>
          <div class="col-lg-6  text-right">
            <span class="title"> الكمية   </span>
            <section class="range-slider">
              <span class="rangeValues"></span>
               <input value="80" min="0" max="120" step="1" type="range" name="max_quantity" >
              <input value="40" min="0" max="120" step="1" type="range" name="min_quantity" >

            </section>
          </div>
          <div class="col-lg-6  text-right">
            <span class="title">تاريخ بداية العرض</span>
            <div class="input-group{{ $errors->has('datepicker') ? ' has-danger' : '' }}">

                <input type="text"  name="datepicker" class="form-control {{ $errors->has('datepicker') ? ' is-invalid' : '' }}" value="{{ old('datepicker') }}">
                @include('alerts.feedback', ['field' => 'datepicker'])

            </div>
          </div>
          <div class="col-lg-6  text-right">
            <span class="title">تاريخ انتهاء العرض</span>
            <div class="input-group{{ $errors->has('datepicker_end') ? ' has-danger' : '' }}">

                <input type="text" name="datepicker_end"  class="form-control {{ $errors->has('datepicker_end') ? ' is-invalid' : '' }}" value="{{ old('datepicker_end') }}">
                @include('alerts.feedback', ['field' => 'datepicker_end'])

            </div>
          </div>
          <div class="col-lg-6  text-right">
            <span class="title"> المنطقة الجغرافية</span>
            <div class="input-group {{ $errors->has('offer_region') ? ' has-danger' : '' }}">
              <select name="offer_region" class="form-control {{ $errors->has('offer_region') ? ' is-invalid' : '' }}">
                <option value="">اختر المنطقة المناسب</option>
                <option value="1">الأردن</option>
                <option value="2">دبي</option>
              </select>
              @include('alerts.feedback', ['field' => 'offer_region'])
            </div>
          </div>

        </div>

        <div class="row justify-content-center mar-0">
          <button type="submit" class="btn-add">إضافة</button>
        </div>


      </form>



<br><br>
  </div>
<style type="text/css">
  section.range-slider {
      position: relative;
      width: 100%;
      height: 35px;
      text-align: center;
  }

  section.range-slider input {
      pointer-events: none;
      position: absolute;
      overflow: hidden;
      left: 0;
      top: 15px;
      width: 100%;
      outline: none;
      height: 18px;
      margin: 0;
      padding: 0;
  }

  section.range-slider input::-webkit-slider-thumb {
      pointer-events: all;
      position: relative;
      z-index: 1;
      outline: 0;
  }

  section.range-slider input::-moz-range-thumb {
      pointer-events: all;
      position: relative;
      z-index: 10;
      -moz-appearance: none;
      width: 9px;
  }

  section.range-slider input::-moz-range-track {
      position: relative;
      z-index: -1;
      background-color: rgba(0, 0, 0, 1);
      border: 0;
  }
  section.range-slider input:last-of-type::-moz-range-track {
      -moz-appearance: none;
      background: none transparent;
      border: 0;
  }
  section.range-slider input[type=range]::-moz-focus-outer {
      border: 0;
  }

</style>

<script src="{{ asset('white') }}/js/datepicker/datepicker-full.min.js"></script>
<script src="{{ asset('white') }}/js/datepicker/datepicker.min.js"></script>
<script type="text/javascript">
  function getVals(){
    // Get slider values
    var parent = this.parentNode;
    var slides = parent.getElementsByTagName("input");
    var slide1 = parseFloat( slides[0].value );
    var slide2 = parseFloat( slides[1].value );
    // Neither slider will clip the other, so make sure we determine which is larger
    if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }

    var displayElement = parent.getElementsByClassName("rangeValues")[0];
    displayElement.innerHTML = slide1 + " - " + slide2;
  }

  window.onload = function(){
    // Initialize Sliders
    var sliderSections = document.getElementsByClassName("range-slider");
    for( var x = 0; x < sliderSections.length; x++ ){
      var sliders = sliderSections[x].getElementsByTagName("input");
      for( var y = 0; y < sliders.length; y++ ){
        if( sliders[y].type ==="range" ){
          sliders[y].oninput = getVals;
          // Manually trigger event first time to display values
          sliders[y].oninput();
        }
      }
    }
  }

  const elem = document.querySelector('input[name="datepicker"]');
  const datepicker = new Datepicker(elem, {
        format: 'yyyy-mm-dd',
  });
  const elemEnd = document.querySelector('input[name="datepicker_end"]');
  const datepickerEnd = new Datepicker(elemEnd, {
       format: 'yyyy-mm-dd',

  });
</script>
@endsection


