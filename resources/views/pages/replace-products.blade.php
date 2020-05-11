@extends('layouts.app', ['page' => __('Replace-products'), 'pageSlug' => 'replace-products'])

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
        <button  class="btn-control-panel btn-erp">لوحة التحكم/ نظام اربح معنا/استبدال النقاط  </button>
        <select class="list-lang">
          <option value="ar">عربي</option>
          <option value="en">English</option>
        </select>
      </div>



      <form  action="replace_product_point"  method="POST" class="form-input-info" enctype="multipart/form-data">
        @csrf
        <div class="row mar-0">
          <div class="col-lg-4 ">
            <span class="title">اسم المنتج</span>
            <div class="input-group">
                <input type="text" name="name" class="form-control"  value="{{ old('product_name') }}" required>
            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">صورة المنتج</span>
            <div class="input-group">

              <input type="file" name="image" class="form-control"  
                value=""  required >

            </div>
          
          </div>
          <div class="col-lg-4 ">
            <span class="title">عدد النقاط المقابلة لهذا المنتج</span>
            <div class="input-group">
                <input type="number" name="point" class="form-control" value="" required>
            </div>
          </div>


        </div>

        </div>

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
  <script type="text/javascript">

  </script>
@endsection


