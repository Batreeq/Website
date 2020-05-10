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
    

      <div class="row justify-content-between mar-0">
        <button  class="btn-control-panel btn-erp">لوحة التحكم/المنتجات  </button>
        <select class="list-lang">
          <option value="ar">عربي</option>
          <option value="en">English</option>
        </select>
      </div>

      <form @if($data_product!=null) action="edit_product" @else action="add_product" @endif  method="POST" class="form-input-info" enctype="multipart/form-data">
        @csrf
        @if($data_product!=null)
          <input type="hidden" name="product_id" value="{{$data_product[0]->id }}" >
        @endif
        <div class="row mar-0">
          <div class="col-lg-4 ">
            <span class="title">اسم المنتج</span>
            <div class="input-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                <input type="text" name="product_name" class="form-control {{ $errors->has('product_name') ? ' is-invalid' : '' }}"  
                @if($data_product!=null)
                  value="{{$data_product[0]->name }}" 
                @else
                  value="{{ old('product_name') }}" 
                @endif
                required>
                    @include('alerts.feedback', ['field' => 'product_name'])

            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">صورة المنتج</span>
            <div class="input-group{{ $errors->has('product_image') ? ' has-danger' : '' }}">
                @if($data_product!=null)
                 <input type="hidden" name="old_product_image" value="{{$data_product[0]->image }}" >
                @endif
                <input type="file" name="product_image" class="form-control {{ $errors->has('product_image') ? ' is-invalid' : '' }}"  
                @if($data_product!=null)
                  value="{{$data_product[0]->image }}" 
                @else
                  value="{{ old('product_image') }}" 
                @endif
                  
                >
                @if ($data_product!=null)
                   <img style="width: 30%;height: 46px;" src="{{ $data_product[0]->image }}"/>
                @endif
                @include('alerts.feedback', ['field' => 'product_image'])
            </div>
          
          </div>
          <div class="col-lg-4 ">
            <span class="title">مصدر المنتج</span>
            <div class="input-group{{ $errors->has('product_src') ? ' has-danger' : '' }}">
                <input type="text" name="product_src" class="form-control {{ $errors->has('product_src') ? ' is-invalid' : '' }}" 
                @if($data_product!=null)
                  value="{{$data_product[0]->product_source }}" 
                @else
                  value="{{ old('product_src') }}" 
                @endif
                 
                 >
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
                @if($data_product!=null)
                  @foreach ($data_categories as $item)

                    <option @if($data_product[0]->category_id ==$item->id ) selected @endif value={{$item->id}}>{{$item->name}}</option>
                  @endforeach
                @else
                  <option value="">اختر الصنف المناسب</option>
                  @foreach ($data_categories as $item)
                    <option value={{$item->id}}>{{$item->name}}</option>
                  @endforeach
                @endif
              </select> 
              @include('alerts.feedback', ['field' => 'product_category'])
            </div>
                    
          </div>
          <div class="col-lg-4 ">
            <span class="title">حجم المنتج</span>
            <div class="input-group{{ $errors->has('product_size') ? ' has-danger' : '' }}">
                <input type="number" name="product_size" class="form-control {{ $errors->has('product_size') ? ' is-invalid' : '' }}"  
                @if($data_product!=null)
                  value="{{$data_product[0]->size }}" 
                @else
                  value="{{ old('product_size') }}" 
                @endif
                required="">
                @include('alerts.feedback', ['field' => 'product_size'])
            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">كمية المنتج</span>
            <div class="input-group{{ $errors->has('product_quantity') ? ' has-danger' : '' }}">
                <input type="number" name="product_quantity" class="form-control {{ $errors->has('product_quantity') ? ' is-invalid' : '' }}" 
                @if($data_product!=null)
                  value="{{$data_product[0]->quantity }}" 
                @else
                  value="{{ old('product_quantity') }}" 
                @endif
                required>
                    @include('alerts.feedback', ['field' => 'product_quantity'])
            </div>
          </div>

         

        </div>
        <div class="row mar-0">
          <div class="col-lg-4 ">
            <span class="title">سعر المنتج</span>
            <div class="input-group{{ $errors->has('product_price') ? ' has-danger' : '' }}">
                <input type="number" name="product_price" class="form-control {{ $errors->has('product_price') ? ' is-invalid' : '' }}"
                @if($data_product!=null)
                  value="{{$data_product[0]->price }}" 
                @else
                  value="{{ old('product_price') }}" 
                @endif
                required
                >
                    @include('alerts.feedback', ['field' => 'product_price'])
            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">تفاصيل النص</span>
            <div class="input-group{{ $errors->has('product_details_text') ? ' has-danger' : '' }}">
                <input type="text" name="product_details_text" class="form-control {{ $errors->has('product_details_text') ? ' is-invalid' : '' }}" 
                @if($data_product!=null)
                  value="{{$data_product[0]->details_text }}" 
                @else
                  value="{{ old('product_details_text') }}" 
                @endif
                required >
                    @include('alerts.feedback', ['field' => 'product_details_text'])
            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">تفاصيل العنوان</span>
            <div class="input-group{{ $errors->has('product_details_title') ? ' has-danger' : '' }}">
                <input type="text" name="product_details_title" class="form-control {{ $errors->has('product_details_title') ? ' is-invalid' : '' }}"
                @if($data_product!=null)
                  value="{{$data_product[0]->details_title }}" 
                @else
                  value="{{ old('product_details_title') }}" 
                @endif
                required
                >
                    @include('alerts.feedback', ['field' => 'product_details_title'])
            </div>
          </div>
          
         
        </div>

        <div class="row mar-0">

          <div class="col-lg-4 ">
            <span class="title">ملاحظات المنتج</span>
            <div class="input-group{{ $errors->has('product_notice') ? ' has-danger' : '' }}">
                <input type="text" name="product_notice" class="form-control {{ $errors->has('product_notice') ? ' is-invalid' : '' }}" 
                @if($data_product!=null)
                  value="{{$data_product[0]->notice }}" 
                @else
                  value="{{ old('product_notice') }}" 
                @endif
                required
                >
                    @include('alerts.feedback', ['field' => 'product_notice'])
            </div>
          </div>

          <div class="col-lg-4">
            <span class="title">صورة تفاصيل المنتج</span>
            <div class="input-group{{ $errors->has('product_details_image') ? ' has-danger' : '' }}">
                @if($data_product!=null)
                 <input type="hidden" name="old_details_image" value="{{$data_product[0]->details_image }}" >
                @endif
                <input type="file" name="product_details_image" class="form-control {{ $errors->has('product_details_image') ? ' is-invalid' : '' }}"
                @if($data_product!=null)
                  value="{{$data_product[0]->details_image }}" 
                @else
                  value="{{ old('product_details_image') }}" 
                @endif
                 
                >
                @if ($data_product!=null)
                   <img style="width: 30%;height: 46px;" src="{{ $data_product[0]->details_image }}"/>
                @endif
                    @include('alerts.feedback', ['field' => 'product_details_image'])
            </div>
          </div>
          <div class="col-lg-4">
            <span class="title">عدد النقاط</span>
            <div class="input-group{{ $errors->has('product_point') ? ' has-danger' : '' }}">
                <input type="number" name="product_point" class="form-control {{ $errors->has('product_point') ? ' is-invalid' : '' }}" 
                @if($data_product!=null)
                  value="{{$data_product[0]->points }}" 
                @else
                  value="{{ old('product_point') }}" 
                @endif
                required
                >
                    @include('alerts.feedback', ['field' => 'product_point'])
            </div>
          </div>

        </div>
        <div class="row mar-0">
          <div class="col-lg-4">
            <span class="title">الكوبون</span>
            <div class="input-group{{ $errors->has('product_copons') ? ' has-danger' : '' }}">
                <input type="text" name="product_copons" class="form-control {{ $errors->has('product_copons') ? ' is-invalid' : '' }}"
                @if($data_product!=null)
                  value="{{$data_product[0]->copons }}" 
                @else
                  value="{{ old('product_copons') }}" 
                @endif
                required
                 >
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
                <input type="number" name="product_wholesale_price" class="form-control {{ $errors->has('product_wholesale_price') ? ' is-invalid' : '' }}" 
                @if($data_product!=null)
                  value="{{$data_product[0]->wholesale_price }}" 
                @else
                  value="{{ old('product_wholesale_price') }}" 
                @endif
                required
               >
                @include('alerts.feedback', ['field' => 'product_wholesale_price'])
            </div>
                    
                </div>
          </div>
           <div class="col-lg-5">
            <span class="text-right title">إضافة عرض خاص </span>
            <div class="row justify-content-start align-items-xl-center mar-0">

                    <select class="form-control"
                     name="product_special_price_for">

                        <option  value="">نوع المستخدم/فئة </option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="1" ) selected @endif @endif value="1">عدد مرات الشراء الكلي / اقل من ٣ مرات</option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="2" ) selected @endif @endif value="2">عدد مرات الشراء الكلي اكثر من ٣ مرات</option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="3" ) selected @endif @endif value="3">متوسط عدد مرات الشراء الشهري اقل من ٣ مرات</option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="4" ) selected @endif @endif value="4">متوسط عدد مرات الشراء الشهري اكثر من ٣ مرات</option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="5" ) selected @endif @endif value="5">قيمة الشراء الكلي اكثر من ١٠٠$ </option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="6" ) selected @endif @endif value="6">قيمة الشراء الكلي اقل من ١٠٠$ </option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="7" ) selected @endif @endif value="7">متوسط عدد  مرات استخدام التطبيق شهريا اكثر من ١٠ مرات </option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="8" ) selected @endif @endif value="8">متوسط عدد  مرات استخدام التطبيق شهريا اقل من ١٠ مرات</option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="9" ) selected @endif @endif value="9">متوسط قيمة الشراء الشهري اكثر من ٣٠$ </option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="10" ) selected @endif @endif value="10"> متوسط قيمة الشراء الكلي اقل من ٣٠$</option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="11" ) selected @endif @endif value="11">استخدام مستمر او متقطع لنفس الصنف او صنف منافس</option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="12" ) selected @endif @endif value="12">سعر خاص عشوائي لعدد معين من المستخدمين وفق الموقع الجغرافي</option>
                        <option @if($data_product!=null)@if($data_product[0]->special_price_for =="13" ) selected @endif @endif value="13">اذا إنقطع المستخدم عن الشراء من التطبيق لفترة معينة</option>

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
            <button type="submit" class="btn-add">@if($data_product!=null)تعديل@elseإضافة@endif</button>
          </div>          
        </div>
           <br>
          <br>

      </form>



<br><br>
  </div>
  <script type="text/javascript">

  </script>
@endsection


