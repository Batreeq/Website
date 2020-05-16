@extends('layouts.app', ['page' => __('Round'), 'pageSlug' => 'round'])

@section('content')
<div class="continaer-region-delivery ">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="row justify-content-between mar-0">

      <button class="btn-control-panel btn-erp">لوحة التحكم/التوصيل/نظام الجولات</button>
      <select class="list-lang">
          <option value="ar">عربي</option>
          <option value="en">English</option>
      </select>

    </div>
    <form action="add_round" class="form-region-delivery" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="delivery_id" value="0">

        <div class="row mar-0">
            <div class="col-lg-6  text-right">
              <span class="title"> التوقيت</span>
              <div class="input-group input-group-active">
                <select name="timing" class="timing form-control form-control-active" required>
                  <option value="">اختر التوقيت المناسب</option>
                  <option value="8-10 ص">8-10 ص</option>
                  <option value="10-12 ص">10-12 ص</option>
                  <option value="12-2 م">12-2 م</option>
                  <option value="2-4 م">2-4 م</option>
                  <option value="4-6 م">4-6 م</option>
                  <option value="all-times">جميع الأوقات</option>
                </select>
                @include('alerts.feedback', ['field' => 'timing'])
              </div>
            </div>

            <div class="col-lg-6  text-right">
              <span class="title">سعة الجولة</span>

              <div class="input-group">
                  <input type="number" name="capacity" class="form-control form-control-active" value="{{ isset($driver->id) ? $driver->id : '' }}" required>
                  @include('alerts.feedback', ['field' => 'delivery_distance'])
              </div>

            </div>

            <div class="col-lg-6  text-right">
              <span class="title">عدد الطلبات</span>

              <div class="input-group">
                  <input type="number" name="num_orders" class="form-control form-control-active" value="{{ isset($driver->id) ? $driver->id : '' }}" required>
                  @include('alerts.feedback', ['field' => 'delivery_distance'])
              </div>

            </div>
       
         

          <div class="col-lg-6  text-right">
            <span class="title">سعر التوصيل</span>

            <div class="input-group">

                <input disabled="" type="number" required name="price" class="form-control form-price" value="{{ isset($driver->id) ? $driver->id : '' }}" >

            </div>
          </div>

        </div>

        <div class="row justify-content-center mar-0">
          <button type="submit" class="btn-add">إضافة</button>
        </div>


      </form>


  </div>
<script type="text/javascript">
  $("form .form-control-active").change(function(){
    
        var fetch_price=true
        $('form .form-control-active').each(function(index, value) {
          if($(this).val()==""){
            fetch_price=false
            $('.form-price').attr('disabled', true);
            return false;
          }

         
        });
        // alert(fetch_price)
        if(fetch_price){
          $('.form-price').attr('disabled', false);
          console.log("yes, fetch price")
          $.ajax({
            url: '/fetch_round_price',
            type: 'POST',
            data: {
              round_capacity:$("input[name='capacity']").val(),
              delivery_type:"round_system",
              orders_num:$("input[name='num_orders']").val(),
              time:$(".timing").val(),
              "_token": "{{ csrf_token() }}",
            },
            dataType: 'json',
            success: function( _response ){

                if(_response['data'][0]!=null){
                  $('input[name="price"]').val(_response['data'][0].price)
                  $('input[name="delivery_id"]').val(_response['data'][0].id)
                  $("form").attr('action', 'update_round');
                }else{
                  $('input[name="price"]').val(0)
                }

            },
            error: function( _response ){
             alert("error")
            }
          });
        }


    });
</script>
@endsection
