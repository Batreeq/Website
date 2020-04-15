@extends('layouts.app', ['page' => __('Products'), 'pageSlug' => 'products'])

@section('content')
<div class="container ">
    <div class="container products-categories-container active">
      <div class="row justify-content-start">
        <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/المنتجات  </button>
      </div>

    <div>

   <!--  <div class="panel panel-primary">

    
      <div class="panel-body">

   

        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

        </div>

        <img src="images/{{ Session::get('image') }}">

        @endif

  

        @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

  

      

  

      </div>

    </div> -->


    <div class="row ">
      <form action="add_product" method="POST" class="form-input-info" enctype="multipart/form-data">
        @csrf
        <div class="row ">
          <div class="col-lg-6 ">
            <div class="input-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                <input type="text" name="product_name" class="form-control {{ $errors->has('product_name') ? ' is-invalid' : '' }}" placeholder="اسم المنتج" value="{{ old('product_name') }}">
                    @include('alerts.feedback', ['field' => 'product_name'])

            </div>
          </div>
          <div class="col-lg-6">
              <div class="input-group">
            <select name="product_details_text" 
            class="form-control"> 
              <option value="0">اختر التصنيف المناسب</option>
              @foreach ($data as $item)
                    <option value={{$item->id}}>{{$item->name}}</option>

              @endforeach

            </select> 
               
            </div>
                    
          </div>

        </div>
        
        <div class="row ">
          <div class="col-lg-4 ">
            <div class="input-group{{ $errors->has('product_size') ? ' has-danger' : '' }}">
                <input type="number" name="product_size" class="form-control {{ $errors->has('product_size') ? ' is-invalid' : '' }}" placeholder="الحجم" value="{{ old('product_size') }}">
                    @include('alerts.feedback', ['field' => 'product_size'])
            </div>
          </div>
          <div class="col-lg-4 ">
            <div class="input-group{{ $errors->has('product_quantity') ? ' has-danger' : '' }}">
                <input type="number" name="product_quantity" class="form-control {{ $errors->has('product_quantity') ? ' is-invalid' : '' }}" placeholder="الكمية" value="{{ old('product_quantity') }}">
                    @include('alerts.feedback', ['field' => 'product_quantity'])
            </div>
          </div>

          <div class="col-lg-4 ">
            <div class="input-group{{ $errors->has('product_price') ? ' has-danger' : '' }}">
                <input type="number" name="product_price" class="form-control {{ $errors->has('product_price') ? ' is-invalid' : '' }}" placeholder="السعر" value="{{ old('product_price') }}">
                    @include('alerts.feedback', ['field' => 'product_price'])
            </div>
          </div>

        </div>
        <div class="row ">
          <div class="col-lg-4 ">
            <div class="input-group{{ $errors->has('product_details_text') ? ' has-danger' : '' }}">
                <input type="text" name="product_details_text" class="form-control {{ $errors->has('product_details_text') ? ' is-invalid' : '' }}" placeholder="تفاصيل النص" value="{{ old('product_details_text') }}">
                    @include('alerts.feedback', ['field' => 'product_details_text'])
            </div>
          </div>
          <div class="col-lg-4 ">
            <div class="input-group{{ $errors->has('product_details_title') ? ' has-danger' : '' }}">
                <input type="text" name="product_details_title" class="form-control {{ $errors->has('product_details_title') ? ' is-invalid' : '' }}" placeholder="تفاصيل العنوان" value="{{ old('product_details_title') }}">
                    @include('alerts.feedback', ['field' => 'product_details_title'])
            </div>
          </div>
          
          <div class="col-lg-4 ">
            <div class="input-group{{ $errors->has('product_notice') ? ' has-danger' : '' }}">
                <input type="text" name="product_notice" class="form-control {{ $errors->has('product_notice') ? ' is-invalid' : '' }}" placeholder="ملاحظات المنتج" value="{{ old('product_notice') }}">
                    @include('alerts.feedback', ['field' => 'product_notice'])
            </div>
          </div>

        </div>
        <br>
        <div class="row">
          <div class="col-lg-6">
            <span class="title">صورة المنتج</span>

            <div class="input-group{{ $errors->has('product_image') ? ' has-danger' : '' }}">
                <input type="file" name="product_image" class="form-control {{ $errors->has('product_image') ? ' is-invalid' : '' }}" placeholder="ملاحظات المنتج" value="{{ old('product_image') }}">
                    @include('alerts.feedback', ['field' => 'product_image'])
            </div>
            
          </div>
          <div class="col-lg-6">
            <span class="title">صورة تفاصيل المنتج</span>
            <div class="input-group{{ $errors->has('product_details_image') ? ' has-danger' : '' }}">
                <input type="file" name="product_details_image" class="form-control {{ $errors->has('product_details_image') ? ' is-invalid' : '' }}" placeholder="ملاحظات المنتج" value="{{ old('product_details_image') }}">
                    @include('alerts.feedback', ['field' => 'product_details_image'])
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

     <div class="row categories-table">
      @foreach ($data as $item)
            <div class="col-lg-3 col-md-6 category-row" >
              <span>{{$item->name}}</span>
            </div>
               
      @endforeach
    </div>
</div>
      
    <!--   <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="row section-action">
              
              <div class="col-lg-6">
                <button class="btn-different btn-chat" onclick="">المنتجات  </button>
              </div>
              <div class="col-lg-6">
                <button  class="btn-different btn-erp">التصنيفات </button>
              </div>
           </div>
        </div>
      </div> -->
    </div>
    <div class="product-block">
        @include('layouts.product-block')
    </div>

  </div>
@endsection


