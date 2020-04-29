@extends('layouts.app', ['page' => __('Delivery-screens'), 'pageSlug' => 'delivery-screens'])

@section('content')
<div class="continaer-region-delivery ">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="row justify-content-start mar-0">

      <button class="btn-control-panel btn-erp">لوحة التحكم/التوصيل/@if ($_GET['type'] == '1')توصيل للمنطقة @else توصيلات مجانية @endif</button>
    </div>
    <form action="add_region_delivery" class="form-region-delivery" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="delivery_type" value="<?php echo $_GET['type'] ?>">
        <input type="hidden" name="delivery_id" value="0">
    
        <div class="row mar-0">
          <div class="col-lg-6  text-right">
            <span class="title ">المدينة</span>
            <div class="input-group input-group-active {{ $errors->has('city') ? ' has-danger' : '' }}">
              <select name="city" class="cities form-control {{ $errors->has('city') ? ' is-invalid' : '' }}"> 
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
                     name="region">
                  <option value="">اختر المنطقة المناسبة </option>
                </select>
              @include('alerts.feedback', ['field' => 'region'])
            </div>   
          </div>
          <div class="col-lg-6  text-right">
            <span class="title"> التوقيت</span>
            <div class="input-group input-group-active {{ $errors->has('timing') ? ' has-danger' : '' }}">
              <select name="timing" class="timing form-control {{ $errors->has('timing') ? ' is-invalid' : '' }}"> 
                <option value="">اختر التوقيت المناسب</option>
                <option value="8-10">8-10</option>
                <option value="10-12">10-12</option>
                <option value="12-14">12-14</option>
                <option value="14-16">14-16</option>
                <option value="16-18">16-18</option>
                <option value="18-20">18-20</option>
                <option value="20-22">20-22</option>
                <option value="22-24">22-24</option>
                @if ($_GET['type'] == '1')<option value="all-times">جميع الأوقات</option>@endif
              </select> 
              @include('alerts.feedback', ['field' => 'timing'])
            </div>   
          </div>

          <div class="col-lg-6  text-right">
            <span class="title">سعر التوصيل</span>
            
            <div class="input-group  {{ $errors->has('delivery_price') ? ' has-danger' : '' }}">
             
                <input type="number" name="delivery_price" class="form-control {{ $errors->has('delivery_price') ? ' is-invalid' : '' }}" value="{{ old('delivery_price') }}" @if ($_GET['type'] == '3') style="pointer-events: none;background: #E3E3E3;border-color: rgba(29, 37, 59, 0.3);" @endif  >
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
                alert("success")
                console.log(_response['regions'])
                var result="";          
                $.each( _response['regions'], function( key, value ) {
                    result+= "<option value="+value['id']+">"+value['location']+"</option>";
                    // console.log("11212121212",key,value['location'])
                });
                $(".regions-select").html(result); 
            },
            error: function( _response ){
             alert("لقد حدث خطأ ما أثناء تحميل المناطق الخاصة بهذه المد")
            }
        });
      });
    $("form .input-group-active").change(function(){
     
        var fetch_price=true
        $('select').each(function(index, value) {
          if($(this).val()==""){
            fetch_price=false
            return false;
          }     
        });

        if(fetch_price){
          console.log("yes, fetch price")
          $.ajax({
            url: '/fetch_regions_price',
            type: 'POST',
            data: {location_id: $(".regions-select").val(),time: $(".timing").val(),"_token": "{{ csrf_token() }}",},
            dataType: 'json',
            success: function( _response ){
               
                if(_response['data'][0]!=null){
                  
                  if($('input[name="delivery_type"]').val()=="1"){
                    alert("لقد تم تحديد سعر هذا التوصيل مسبقا, وتسطيع التعديل على السعر")
                    $('input[name="delivery_price"]').val(_response['data'][0].price)
                  }else{
                     $('input[name="delivery_price"]').val(0)
                  }
                  
                  $('input[name="delivery_id"]').val(_response['data'][0].id)
                  $("form").attr('action', 'update_region_delivery');
                }else{
                  $('input[name="delivery_price"]').val(0)
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
