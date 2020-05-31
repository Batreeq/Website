@extends('layouts.app', ['page' => __('Delivery-screens'), 'pageSlug' => 'delivery-screens'])

@section('content')
<div class="continaer-region-delivery ">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="row justify-content-between mar-0">

      <button class="btn-control-panel btn-erp">لوحة التحكم/التوصيل/@if ($_GET['type'] == '1')توصيل للمنطقة @elseif ($_GET['type'] == '2')توصيل حسب الكيلو@else توصيلات مجانية @endif</button>
      <select class="list-lang">
          <option value="ar">عربي</option>
          <option value="en">English</option>
      </select>

    </div>
    <form action="add_region_delivery" class="form-region-delivery" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="delivery_type" @if($_GET['type'] == '1') value="region" @else value="free" @endif>
        <input type="hidden" name="delivery_id" value="0">
        <input type="hidden" name="lang" class="lang" value="ar">

        <div class="row mar-0">
          @if ($_GET['type'] != '2')
            <div class="col-lg-6  text-right">
              <span class="title ">المدينة</span>
              <div class="input-group input-group-active {{ $errors->has('city') ? ' has-danger' : '' }}">
                <select name="city" class="cities form-control {{ $errors->has('city') ? ' is-invalid' : '' }}" required>
                  <option value="">اختر المدينة المناسب</option>
                  @foreach ($locations as $item)
                     <option value="1">{{$item->city}}</option>
                  @endforeach
                </select>
                @include('alerts.feedback', ['field' => 'city'])
              </div>
            </div>

            <div class="col-lg-6  text-right">
              <span class="title ">المنطقة</span>
              <div class="input-group input-group-active {{ $errors->has('region') ? ' has-danger' : '' }}">
                 <select class="form-control regions-select {{ $errors->has('region') ? ' is-invalid' : '' }}"
                       name="region" required>
                    <option value="">اختر المنطقة المناسبة </option>
                  </select>
                @include('alerts.feedback', ['field' => 'region'])
              </div>
            </div>
          @endif
  
          <div class="col-lg-6  text-right">
            <span class="title"> التوقيت</span>
            <div class="input-group input-group-active {{ $errors->has('timing') ? ' has-danger' : '' }}">
              <select name="timing" class="timing form-control {{ $errors->has('timing') ? ' is-invalid' : '' }}" required>
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

          <div class="col-lg-6 text-right">
            <span class="title">الأقسام</span>
            <div class="input-group input-group-active">
              <select name="category_id" class="category_id form-control" required> 
                <option  value="" >اختر القسم المناسب</option>
                  @foreach ($main_categories as $item)
                    <option  value={{$item->id}}>{{$item->name}}</option>
                  @endforeach
              </select> 
            </div>
          </div>

          <div class="col-lg-6  text-right">
            <span class="title">سعر التوصيل</span>

            <div class="input-group  {{ $errors->has('delivery_price') ? ' has-danger' : '' }}">

                <input type="number" required name="delivery_price" class="form-control {{ $errors->has('delivery_price') ? ' is-invalid' : '' }}" value="{{ old('delivery_price') }}" @if ($_GET['type'] == '3') style="pointer-events: none;background: #E3E3E3;border-color: rgba(29, 37, 59, 0.3);" @endif  >
                @include('alerts.feedback', ['field' => 'delivery_price'])





            </div>
          </div>

        </div>

        <div class="row justify-content-center mar-0">
          <button type="submit" class="btn-add">إضافة</button>
        </div>


      </form>


  </div>
    <script type="text/javascript">
      $(".cities").change(function(){
        $.ajax({
            url: '/fetch_regions',
             type: 'POST',
            data: {name: $(".cities option:selected").html(), "_token": "{{ csrf_token() }}",},
            dataType: 'json',
            success: function( _response ){
                console.log(_response['regions'])
                var result="<option value=''>اختر المنطقة المناسبة </option>";
                $.each( _response['regions'], function( key, value ) {
                    result+= "<option value="+value['id']+">"+value['location']+"</option>";
                    // console.log("11212121212",key,value['location'])
                });
                $(".regions-select").html(result);
            },
            error: function( _response ){
             alert("لقد حدث خطأ ما أثناء تحميل المناطق الخاصة بهذه المدة")
            }
        });
      });
    $("form .input-group-active").change(function(){

      // if($('input[name="delivery_type"]').val()!="kilo"){
        var fetch_price=true
        $('select').each(function(index, value) {
          if($(this).val()==""){
            fetch_price=false
            console.log("no, fetch price")
            return false;
          }
        });

        if(fetch_price){
          console.log("yes, fetch price")
          $.ajax({
            url: '/fetch_regions_price',
            type: 'POST',
            data: {
              location_id: $(".regions-select").val(),
              category_id: $(".category_id").val(),
              delivery_type:"",time: $(".timing").val(),
              "_token": "{{ csrf_token() }}",
            },
            dataType: 'json',
            success: function( _response ){

                if(_response['data'][0]!=null){

                  if($('input[name="delivery_type"]').val()=="region"){
                    alert("لقد تم تحديد سعر هذا التوصيل مسبقا, وتسطيع التعديل على السعر")
                    $('input[name="delivery_price"]').val(_response['data'][0].price)
                  }else{
                     $('input[name="delivery_price"]').val(0)
                  }

                  $('input[name="delivery_id"]').val(_response['data'][0].id)
                  $("form").attr('action', 'update_region_delivery');
                }else{
                  $('input[name="delivery_price"]').val(0)
                  $("form").attr('action', 'add_region_delivery');
                }

            },
            error: function( _response ){
             alert("error")
            }
          });
        }
      // }else{

      //   if( $("form .input-group-active select").val()!=""){
      //     $.ajax({
      //       url: '/fetch_regions_price',
      //       type: 'POST',
      //       data: {distance: $('input[name="delivery_distance"]').val(),delivery_type:"kilo",time: $(".timing").val(),"_token": "{{ csrf_token() }}",},
      //       dataType: 'json',
      //       success: function( _response ){

      //           if(_response['data'][0]!=null){
      //             alert("لقد تم تحديد سعر هذا التوصيل مسبقا, وتسطيع التعديل على السعر")
      //             $('input[name="delivery_price"]').val(_response['data'][0].price)
      //             $('input[name="delivery_id"]').val(_response['data'][0].id)
      //             $("form").attr('action', 'update_region_delivery');
      //           }else{
      //             $('input[name="delivery_price"]').val(0)
      //           }

      //       },
      //       error: function( _response ){
      //        alert("error")
      //       }
      //     });

      //   }
      // }

    });



</script>
@endsection
