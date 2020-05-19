@extends('layouts.app', ['page' => __('Product-add'), 'pageSlug' => 'product-add'])

@section('content')
<div class="container ">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="products-container ">

      <div class="row justify-content-between">
        <button class="btn-control-panel btn-erp">لوحة التحكم/أجزاء متغيرة  </button>
        <select class="list-lang">
          <option value="ar">عربي</option>
          <option value="en">English</option>
        </select>
      </div>

    <div>

      <form action="add_offer" method="POST" class="form-input-info" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="lang" class="lang" value="ar">
        <div class="row ">
          <div class="col-lg-4 ">
            <span class="title">اسم العرض</span>
            <div class="input-group">
                <input type="text" name="name" class="form-control"  value="{{ isset($offer->name) ? $offer->name : '' }}">
                    @include('alerts.feedback', ['field' => 'product_name'])

            </div>
          </div>
          <input type="hidden" name="offer_id" id="offer_id" value="{{ isset($offer->id) ? $offer->id : '' }}">
          <div class="col-lg-4 ">
            <span class="title">صورة العرض على التطبيق</span>
            <div class="input-group">
                <input type="file" name="image" class="form-control">
                @if (isset($offer->image) )
                    <img style="width: 12%;" src="{{$offer->image}}" />
                @endif

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
@endsection


