@extends('layouts.app', ['page' => __('Product-add'), 'pageSlug' => 'product-add'])

@section('content')
<div class="container ">
    <div class="container products-container active">
      <div class="row justify-content-start">
        <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/المنتجات  </button>
      </div>

    <div>


    <div class="row ">
      <form action="add_product" method="POST" class="form-input-info" enctype="multipart/form-data">
        @csrf
        <div class="row ">
          <div class="col-lg-4 ">
            <span class="title">اسم المنتج</span>
            <div class="input-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                <input type="text" name="product_name" class="form-control {{ $errors->has('product_name') ? ' is-invalid' : '' }}"  value="{{ old('product_name') }}">
                    @include('alerts.feedback', ['field' => 'product_name'])

            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">صورة المنتج</span>

            <div class="input-group">
                <input type="file" name="product_image" class="form-control" placeholder="ملاحظات المنتج"
                 value="{{ old('product_image') }}">
                    
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
        
        <div class="row ">
          <div class="col-lg-4">
            <span class="title">صنف المنتج</span>
            <div class="input-group">
            <select name="product_details_text" 
            class="form-control"> 
              <option value="0"></option>
              @foreach ($data_categories as $item)
                    <option value={{$item->id}}>{{$item->name}}</option>

              @endforeach

            </select> 
               
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
        <div class="row ">
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

        <div class="row">

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
        </div>
        <div class="row special-section">
          <div class="col-lg-5">
            <span class="text-right title">إضافة سعر خاص </span>
             <div class="row justify-content-start align-items-xl-center">

                    <select class="form-control">
                        <option>نوع المستخدم/فئة </option>
                    </select>
                    <span class="input-group-btn arrow-select  justify-content-center align-items-xl-center">
                        <img width="27" src="{{ asset('white') }}/img/arrow.png" alt="arrow image">
                    </span>
                    
                </div>
          </div>
           <div class="col-lg-5">
            <span class="text-right title">إضافة عرض خاص </span>
            <div class="row justify-content-start align-items-xl-center">

                    <select class="form-control">
                        <option>نوع المستخدم/فئة </option>
                    </select>
                    <span class="input-group-btn arrow-select  justify-content-center align-items-xl-center">
                        <img width="27" src="{{ asset('white') }}/img/arrow.png" alt="arrow image">
                    </span>
                    
                </div>
          </div>
        </div>
        <div class="col-lg-12 ">
          <br>
          <br>
          <div class="row justify-content-center">
            <button type="submit" class="btn-add">إضافة</button>
          </div>          
        </div>
 

      </form>
    </div>
</div>


  </div>
@endsection


