@extends('layouts.app', ['page' => __('Product-add'), 'pageSlug' => 'product-add'])

@section('content')
<div class="container ">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

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
            <span class="title">اسم العرض</span>
            <div class="input-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                <input type="text" name="product_name" class="form-control {{ $errors->has('product_name') ? ' is-invalid' : '' }}"  value="{{ old('product_name') }}">
                    @include('alerts.feedback', ['field' => 'product_name'])

            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">صورة العرض على التطبيق</span>
            <div class="input-group{{ $errors->has('product_image') ? ' has-danger' : '' }}">
                <input type="file" name="product_image" class="form-control {{ $errors->has('product_image') ? ' is-invalid' : '' }}"  value="{{ old('product_image') }}">
                    @include('alerts.feedback', ['field' => 'product_image'])
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


