@extends('layouts.app', ['page' => __('Product-category'), 'pageSlug' => 'product-category'])

@section('content')
  <div class="continaer-products-categories">

    <div class="row justify-content-start mar-0">
        <button  class="btn-control-panel btn-erp">لوحة التحكم/المنتجات & التصنيفات </button>
    </div>

    <div class="row justify-content-center">
      <div class=" justify-content-center align-items-center  text-center btn-different btn-chat ">
        <a href="{{ route('pages.products') }}">
          <span>المنتجات  </span>
        </a>
      </div>
      <div class=" justify-content-center align-items-center text-center  btn-different btn-erp ">
        <a href="{{ route('pages.category') }}">
          <span>التصنيفات </span>
        </a>
      </div>
    </div>

  </div>
@endsection


