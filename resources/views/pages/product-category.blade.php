@extends('layouts.app', ['page' => __('Product-category'), 'pageSlug' => 'product-category'])

@section('content')
<div class="container ">
    <div class="container products-categories-container active">
      <div class="row justify-content-start">
        <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/المنتجات & التصنيفات </button>
      </div>
    <div>

    <div class="row justify-content-center">
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
    </div>

    <div class="product-block">
        @include('layouts.product-block')
    </div>

  </div>
@endsection


