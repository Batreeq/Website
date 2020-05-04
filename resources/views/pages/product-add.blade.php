@extends('layouts.app', ['page' => __('Product-add'), 'pageSlug' => 'product-add'])

@section('content')
<div class="products-container ">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger  alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    

      <div class="row justify-content-start mar-0">
        <button  class="btn-control-panel btn-erp">لوحة التحكم/المنتجات  </button>
      </div>


      <form action="add_product" method="POST" class="form-input-info" enctype="multipart/form-data">
        @csrf
        <div class="row mar-0">
          <div class="col-lg-4 ">
            <span class="title">اسم المنتج</span>
            <div class="input-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                <input type="text" name="product_name" class="form-control {{ $errors->has('product_name') ? ' is-invalid' : '' }}"  value="{{ old('product_name') }}">
                    @include('alerts.feedback', ['field' => 'product_name'])

            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">صورة المنتج</span>
            <div class="input-group{{ $errors->has('product_image') ? ' has-danger' : '' }}">
                <input type="file" name="product_image" class="form-control {{ $errors->has('product_image') ? ' is-invalid' : '' }}"  value="{{ old('product_image') }}">
                    @include('alerts.feedback', ['field' => 'product_image'])
            </div>
          
          </div>
          <div class="col-lg-4 ">
            <span class="title">مصدر المنتج</span>
            <div class="input-group{{ $errors->has('product_src') ? ' has-danger' : '' }}">
                <input type="text" name="product_src" class="form-control {{ $errors->has('product_src') ? ' is-invalid' : '' }}"  value="{{ old('product_src') }}">
                    @include('alerts.feedback', ['field' => 'product_src'])

            </div>
          </div>


        </div>
        
        <div class="row  mar-0">
          <div class="col-lg-4">

            <span class="title">صنف المنتج</span>
            <div class="input-group {{ $errors->has('product_category') ? ' has-danger' : '' }}">
              <select name="product_category" 
              class="form-control {{ $errors->has('product_category') ? ' is-invalid' : '' }}"> 
                <option value="">اختر الصنف المناسب</option>
                @foreach ($data_categories as $item)
                  <option value={{$item->id}}>{{$item->name}}</option>
                @endforeach
              </select> 
              @include('alerts.feedback', ['field' => 'product_category'])
            </div>
                    
          </div>
          <div class="col-lg-4 ">
            <span class="title">حجم المنتج</span>
            <div class="input-group{{ $errors->has('product_size') ? ' has-danger' : '' }}">
                <input type="number" name="product_size" class="form-control {{ $errors->has('product_size') ? ' is-invalid' : '' }}"  value="{{ old('product_size') }}">
                    @include('alerts.feedback', ['field' => 'product_size'])
            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">كمية المنتج</span>
            <div class="input-group{{ $errors->has('product_quantity') ? ' has-danger' : '' }}">
                <input type="number" name="product_quantity" class="form-control {{ $errors->has('product_quantity') ? ' is-invalid' : '' }}"  value="{{ old('product_quantity') }}">
                    @include('alerts.feedback', ['field' => 'product_quantity'])
            </div>
          </div>

         

        </div>
        <div class="row mar-0">
          <div class="col-lg-4 ">
            <span class="title">سعر المنتج</span>
            <div class="input-group{{ $errors->has('product_price') ? ' has-danger' : '' }}">
                <input type="number" name="product_price" class="form-control {{ $errors->has('product_price') ? ' is-invalid' : '' }}" value="{{ old('product_price') }}">
                    @include('alerts.feedback', ['field' => 'product_price'])
            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">تفاصيل النص</span>
            <div class="input-group{{ $errors->has('product_details_text') ? ' has-danger' : '' }}">
                <input type="text" name="product_details_text" class="form-control {{ $errors->has('product_details_text') ? ' is-invalid' : '' }}"  value="{{ old('product_details_text') }}">
                    @include('alerts.feedback', ['field' => 'product_details_text'])
            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">تفاصيل العنوان</span>
            <div class="input-group{{ $errors->has('product_details_title') ? ' has-danger' : '' }}">
                <input type="text" name="product_details_title" class="form-control {{ $errors->has('product_details_title') ? ' is-invalid' : '' }}" value="{{ old('product_details_title') }}">
                    @include('alerts.feedback', ['field' => 'product_details_title'])
            </div>
          </div>
          
         
        </div>

        <div class="row mar-0">

          <div class="col-lg-4 ">
            <span class="title">ملاحظات المنتج</span>
            <div class="input-group{{ $errors->has('product_notice') ? ' has-danger' : '' }}">
                <input type="text" name="product_notice" class="form-control {{ $errors->has('product_notice') ? ' is-invalid' : '' }}" value="{{ old('product_notice') }}">
                    @include('alerts.feedback', ['field' => 'product_notice'])
            </div>
          </div>

          <div class="col-lg-4">
            <span class="title">صورة تفاصيل المنتج</span>
            <div class="input-group{{ $errors->has('product_details_image') ? ' has-danger' : '' }}">
                <input type="file" name="product_details_image" class="form-control {{ $errors->has('product_details_image') ? ' is-invalid' : '' }}"  value="{{ old('product_details_image') }}">
                    @include('alerts.feedback', ['field' => 'product_details_image'])
            </div>
          </div>
          <div class="col-lg-4">
            <span class="title">عدد النقاط</span>
            <div class="input-group{{ $errors->has('product_point') ? ' has-danger' : '' }}">
                <input type="number" name="product_point" class="form-control {{ $errors->has('product_point') ? ' is-invalid' : '' }}" value="{{ old('product_point') }}">
                    @include('alerts.feedback', ['field' => 'product_point'])
            </div>
          </div>

        </div>
        <div class="row mar-0">
          <div class="col-lg-4">
            <span class="title">الكوبون</span>
            <div class="input-group{{ $errors->has('product_copons') ? ' has-danger' : '' }}">
                <input type="text" name="product_copons" class="form-control {{ $errors->has('product_copons') ? ' is-invalid' : '' }}" value="{{ old('product_copons') }}">
                    @include('alerts.feedback', ['field' => 'product_copons'])
            </div>
          </div>
        </div>
        <div class="row special-section mar-0">
          <div class="col-lg-5">
            <span class="text-right title">إضافة سعر الجملة </span>
             <div class="row justify-content-start align-items-xl-center">
                <div class="input-group{{ $errors->has('product_special_price') ? ' has-danger' : '' }}">
                <!-- <input type="number" name="product_special_price" class="form-control {{ $errors->has('product_special_price') ? ' is-invalid' : '' }}" value="{{ old('product_special_price') }}">
                    @include('alerts.feedback', ['field' => 'product_special_price']) -->
                <input type="number" name="product_wholesale_price" class="form-control {{ $errors->has('product_wholesale_price') ? ' is-invalid' : '' }}" value="{{ old('product_wholesale_price') }}">
                @include('alerts.feedback', ['field' => 'product_wholesale_price'])
            </div>
                    
                </div>
          </div>
           <div class="col-lg-5">
            <span class="text-right title">إضافة عرض خاص </span>
            <div class="row justify-content-start align-items-xl-center mar-0">

                    <select class="form-control"
                     name="product_special_price_for">

                        <option value="">نوع المستخدم/فئة </option>
                        <option value="1">عدد مرات الشراء الكلي / اقل من ٣ مرات</option>
                        <option value="2">عدد مرات الشراء الكلي اكثر من ٣ مرات</option>
                        <option value="3">متوسط عدد مرات الشراء الشهري اقل من ٣ مرات</option>
                        <option value="4">متوسط عدد مرات الشراء الشهري اكثر من ٣ مرات</option>
                        <option value="5">قيمة الشراء الكلي اكثر من ١٠٠$ </option>
                        <option value="6">قيمة الشراء الكلي اقل من ١٠٠$ </option>
                        <option value="7">متوسط عدد  مرات استخدام التطبيق شهريا اكثر من ١٠ مرات </option>
                        <option value="8">متوسط عدد  مرات استخدام التطبيق شهريا اقل من ١٠ مرات</option>
                        <option value="9">متوسط قيمة الشراء الشهري اكثر من ٣٠$ </option>
                        <option value="10"> متوسط قيمة الشراء الكلي اقل من ٣٠$</option>
                        <option value="11">استخدام مستمر او متقطع لنفس الصنف او صنف منافس</option>
                        <option value="12">سعر خاص عشوائي لعدد معين من المستخدمين وفق الموقع الجغرافي</option>
                        <option value="13">اذا إنقطع المستخدم عن الشراء من التطبيق لفترة معينة</option>

                    </select>
                    <span class="input-group-btn arrow-select  justify-content-center align-items-xl-center">
                        <img width="27" src="{{ asset('white') }}/img/arrow.png" alt="arrow image">
                    </span>
                    
                </div>
          </div>
        </div>
                  <br>
          <br>
        <div class="col-lg-12 ">

          <div class="row justify-content-center mar-0">
            <button type="submit" class="btn-add">إضافة</button>
          </div>          
        </div>
           <br>
          <br>

      </form>



<br><br>
  </div>
@endsection


