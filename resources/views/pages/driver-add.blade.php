@extends('layouts.app', ['page' => __('Driver-add'), 'pageSlug' => 'driver-add'])

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
        <button class="btn-control-panel btn-erp">لوحة التحكم/إضافة سائق</button>
        <select class="list-lang">
          <option value="ar">عربي</option>
          <option value="en">English</option>
        </select>
      </div>

    <div>

      <form  @if(isset($driver->name)) action="edit_driver_action" @else action="add_driver_action" @endif
       method="POST" class="form-input-info" enctype="multipart/form-data">
        @csrf
        <div class="row ">
          <div class="col-lg-4 ">
            <span class="title">اسم السائق</span>

            <div class="input-group">
                <input type="text" name="name" class="form-control"  value="{{ isset($driver->name) ? $driver->name : '' }}" required>

            </div>
          </div>
          <input type="hidden" name="driver_id" id="driver_id" value="{{ isset($driver->id) ? $driver->id : '' }}">

          <div class="col-lg-4 ">
            <span class="title">كلمة السر</span>
            <div class="input-group">
                <input type="password" name="password" class="form-control"  value="{{ isset($driver->password) ? $driver->password : '' }}" required>

            </div>
          </div>

          <div class="col-lg-4 ">
            <span class="title">رقم الهاتف</span>
            <div class="input-group">
                <input type="number" name="phone" class="form-control"  value="{{ isset($driver->phone) ? $driver->phone : '' }}" required>

            </div>
          </div>

          
          <div class="col-lg-4 ">
            <span class="title">رقم الهاتف2</span>
            <div class="input-group">
                <input type="number" name="phone2" class="form-control"  value="{{ isset($driver->second_phone) ? $driver->second_phone : '' }}" >

            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">العنوان</span>
            <div class="input-group">
                <input type="text" name="location" class="form-control"  value="{{ isset($driver->location) ? $driver->location : '' }}" required>

            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">السيارة</span>
            <div class="input-group">
                <input type="text" name="car" class="form-control"  value="{{ isset($driver->car) ? $driver->car : '' }}" required>

            </div>
          </div>
          <div class="col-lg-4 ">
            <span class="title">الموديل</span>
            <div class="input-group">
                <input type="text" name="model" class="form-control"  value="{{ isset($driver->car_model) ? $driver->car_model : '' }}" required>

            </div>
          </div>
        </div>

        <div class="col-lg-12 ">
          <br>
          <br>
          <div class="row justify-content-center">
            <button type="submit" class="btn-add">@if(isset($driver->name))تعديل@else إضافة @endif </button>
          </div>
        </div>
      </form>
  <br>
  <br>
  <br>
  </div>
</div>

@endsection


