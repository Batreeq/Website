@extends('layouts.app', ['page' => __('Region-delivery'), 'pageSlug' => 'region-delivery'])

@section('content')
<div class="continaer-region-delivery ">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="row justify-content-start mar-0">
      <button class="btn-control-panel btn-erp">لوحة التحكم/التوصيل/توصيل للمنطقة </button>
    </div>
    <form action="add_region_delivery" class="form-region-delivery" method="POST" enctype="multipart/form-data">
        @csrf
    
        <div class="row mar-0">
          <div class="col-lg-6  text-right">
            <span class="title ">المدينة</span>
            <div class="input-group {{ $errors->has('city') ? ' has-danger' : '' }}">
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
            <div class="input-group {{ $errors->has('region') ? ' has-danger' : '' }}">
               <select class="form-control regions-select {{ $errors->has('region') ? ' is-invalid' : '' }}"
                     name="region">

                        <option value="">اختر المنطقة المناسبة </option>

                    </select>
              @include('alerts.feedback', ['field' => 'region'])
            </div>   
          </div>
          <div class="col-lg-6  text-right">
            <span class="title"> التوقيت</span>
            <div class="input-group {{ $errors->has('timing') ? ' has-danger' : '' }}">
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
              </select> 
              @include('alerts.feedback', ['field' => 'timing'])
            </div>   
          </div>

          <div class="col-lg-6  text-right">
            <span class="title">سعر التوصيل</span>
            
            <div class="input-group{{ $errors->has('delivery_price') ? ' has-danger' : '' }}">
              <input type="number" name="delivery_price" class="form-control {{ $errors->has('delivery_price') ? ' is-invalid' : '' }}" value="{{ old('delivery_price') }}">
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
          type: 'GET',
          data: {name: $(".cities option:selected").html()},
          dataType: 'json',
          success: function( _response ){
              alert("success")
              console.log(_response['regions'])
              var result="";          
              $.each( _response['regions'], function( key, value ) {
                  result+= "<option value="+value['id']+">"+value['location']+"</option>";
                  // console.log("11212121212",key,value['location'])
              });
              $(".regions-select").append(result); 
          },
          error: function( _response ){
           alert("error")
          }
      });
    });
      $('.btn-add1').click(function( event ) {
    event.preventDefault();
    $.ajax({
        url: '/add_region_delivery',
        type: 'GET',
        data: {name: $(".cities option:selected").html()},
         // data:{ name: $(".cities option:selected").html() ,_token = <?php echo csrf_token() ?>},
        dataType: 'json',
        success: function( _response ){
           alert("success")
           $('.offer_region').html(response);
        },
        error: function( _response ){
         alert("error")
        }
    });
});
   

</script>
@endsection
