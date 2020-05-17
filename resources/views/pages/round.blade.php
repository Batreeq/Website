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
    <h2 class="text-center">إضافة جولة</h2>
    <form action="add_round" class="form-region-delivery" method="POST" enctype="multipart/form-data">
        @csrf
     
        <div class="row mar-0">
            <div class="col-lg-6  text-right">
              <span class="title">سقف الجولة</span>
              <div class="input-group input-group-active">
                <select name="round_type" class="round_type form-control" required>
                  <option value="السعر">السعر</option>
                  <option value="الكمية">الكمية</option>
                  <option value="الوقت">الوقت</option>
                </select>
              </div>
            </div>

            <div class="col-lg-6  text-right">
              <span class="title">قيمة السقف المختار</span>

              <div class="input-group">
                  <input type="number" name="round_value" class="round_value form-control" value="0" >
                  <select  name="round_timing" class="round_timing form-control" required style="display: none;">
                    <option value="8-10 ص">8-10 ص</option>
                    <option value="10-12 ص">10-12 ص</option>
                    <option value="12-2 م">12-2 م</option>
                    <option value="2-4 م">2-4 م</option>
                    <option value="4-6 م">4-6 م</option>
                  </select>
                  
              </div>

            </div>
        </div>
        <div class="row justify-content-center mar-0">
          <button type="submit" class="btn-add">إضافة جولة</button>
        </div>
        <br><br><br><br>
    </form>

    <h2 class="text-center">ربط الطلبيات مع الجولات المناسبة</h2>

    <form action="link_round_request" class="form-region-delivery" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="delivery_id" value="0">

        <div class="row mar-0">
            <div class="col-lg-6  text-right">
              <span class="title">المنطقة</span>
              <div class="input-group input-group-active">

                <select name="location" class="location form-control form-control-active" required>
                  <option value="">اختر المنطقة</option>
                  @foreach($deliveryLocations as $item)
                  <option value="{{$item->id}}">{{$item->location}}</option>
                  @endforeach
                </select>
              
              </div>
            </div>
            <div class="col-lg-6  text-right">
              <span class="title"> التوقيت</span>
              <div class="input-group input-group-active">
                <select name="timing" class="timing form-control form-control-active" required>
                  <option value="">اختر التوقيت المناسب</option>
                </select>
                
              </div>
            </div>

            <div class="col-lg-6  text-right">
              <span class="title">الجولات</span>

              <div class="input-group">
                <select name="rounds_id" class="rounds form-control" required>
                  <option value="">اختر الجولات المناسبة</option>
                </select>
              </div>

            </div>

            <!-- <div class="col-lg-6  text-right">
              <span class="title">سعر التوصيل</span>

              <div class="input-group">

                  <input disabled="" type="number" required name="price" class="form-control form-price" value="{{ isset($driver->id) ? $driver->id : '' }}" >

              </div>
            </div> -->

        </div>

        <div class="row justify-content-center mar-0">
          <button type="submit" class="btn-add">إضافة</button>
        </div>


      </form>


  </div>
<script type="text/javascript">
  $("form select[name='round_type']").change(function(){
    
    if($(this).val()=="الوقت"){
      $('form select.round_timing').show();
      $('form input.round_value').hide();
    
      // $('form input.round_value').attr('name','no');
      // $('form input.round_value').attr('required','false');
      // $('form select.round_timing').attr('name','round_value');
    }else{
      $('form select.round_timing').hide();
      $('form input.round_value').show();
      // $('form select.round_timing').attr('name','no');
      // $('form select.round_timing').attr('required','false');
      // $('form input.round_value').attr('name','round_value');
    }

  })

  $("form select[name='location']").change(function(){
      $.ajax({
            url: '/fetch_timing_round',
            type: 'POST',
            data: {
              location:$(this).val(),
              "_token": "{{ csrf_token() }}",
            },
            dataType: 'json',
            success: function( _response ){
              var result="<option value=''>اختر التوقيت المناسب </option>";
                $.each( _response['data'], function( key, value ) {
                    result+= "<option value="+ value['id'] +">"+value['time']+"</option>";
                    // console.log("11212121212",key,value['location'])
                });
                $("select.timing").html(result);
            },
            error: function( _response ){
             alert("error")
            }
          });
  })
  $("form .form-control-active").change(function(){
    var fetch_price=true
    $('form .form-control-active').each(function(index, value) {
      if($(this).val()==""){
        fetch_price=false
        
        return false;
      }
    })
       if(fetch_price){  
    $.ajax({
            url: '/fetch_rounds',
            type: 'POST',
            data: {
              time:$(".timing option:selected").html(),
              "_token": "{{ csrf_token() }}",
            },
            dataType: 'json',
            success: function( _response ){
              var result="<option value=''>اختر الجولة المناسبة </option>";
              $.each( _response['data'], function( key, item ) {
                  
                     
                     $.each( item, function( key, val ) {
                      console.log(val)
                      result+= "<option value="+ val['id'] +">"+val['type']+":"+val['value']+"</option>";
                      });

                });
              $("select.rounds").html(result);
            },
            error: function( _response ){
             alert("error")
            }
          });
  }
  }
)
  //$("form .form-control-active").change(function(){
    
  //       var fetch_price=true
  //       $('form .form-control-active').each(function(index, value) {
  //         if($(this).val()==""){
  //           fetch_price=false
  //           $('.form-price').attr('disabled', true);
  //           return false;
  //         }

         
  //       });
  //       // alert(fetch_price)
  //       if(fetch_price){
  //         $('.form-price').attr('disabled', false);
  //         console.log("yes, fetch price")
  //         $.ajax({
  //           url: '/fetch_round_price',
  //           type: 'POST',
  //           data: {
  //             round_capacity:$("input[name='capacity']").val(),
  //             delivery_type:"round_system",
  //             orders_num:$("input[name='num_orders']").val(),
  //             time:$(".timing").val(),
  //             "_token": "{{ csrf_token() }}",
  //           },
  //           dataType: 'json',
  //           success: function( _response ){

  //               if(_response['data'][0]!=null){
  //                 $('input[name="price"]').val(_response['data'][0].price)
  //                 $('input[name="delivery_id"]').val(_response['data'][0].id)
  //                 $("form").attr('action', 'update_round');
  //               }else{
  //                 $('input[name="price"]').val(0)
  //               }

  //           },
  //           error: function( _response ){
  //            alert("error")
  //           }
  //         });
  //       }


  //   });
</script>
@endsection
