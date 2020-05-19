
@extends('layouts.app', ['page' => __('Copons'), 'pageSlug' => 'copons'])

@section('content')
    <div class="copons-continaer">
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
            <button class="btn-control-panel btn-erp">لوحة التحكم/الكوبونات</button>
            <select class="list-lang">
                <option value="ar">عربي</option>
                <option value="en">English</option>
            </select>
        </div>
        <form action="add_copouns" method="POST" class="form-edit-copons" enctype="multipart/form-data" style="margin-bottom: 40px">
          @csrf
          <input type="hidden" name="lang" class="lang" value="ar">

          <div class="row mar-0">
            <div class="col-lg-4 text-right">
              <span class="title ">الكود</span>
              <div class="input-group">
                  <input type="text" name="code" class="form-control "  value="" required>
              </div>
              <br>
            </div>
            <div class="col-lg-4 text-right">
              <span class="title ">نوع العرض</span>
              <select class="form-control" id="offer_type" name="offer_type" required>
                  <option value="" selected disabled></option>
                  <option value="عرض على التوصيل">عرض على التوصيل</option>
                  <option value="عرض قيمة السلة الشرائية">عرض قيمة السلة الشرائية</option>
                  <option value="عرض على منتج معين">عرض على منتج معين</option>
              </select>
               <br>
            </div>

            <div class="col-lg-4 text-right products-section" style="display: none;">
              <span class="title ">المنتج</span>
              <select class="form-control"  name="product_id" >
                <option value="" selected disabled></option>
                @foreach ($products as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
               <br>
            </div>

            <div class="col-lg-4 text-right">
              <span class="title ">قيمة العرض</span>
              <div class="input-group">
                  <input type="number" name="offer_value" class="form-control "  value="" required>
              </div>
              <br>
            </div>

            <div class="col-lg-4 text-right">
              <span class="title ">عدد مرات استخدام الكود</span>
              <select class="form-control" id="" name="num_usage" required>
                  <option value="" selected disabled></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
              </select>
               <br>
            </div>
            <div class="col-lg-12 text-center">
              <input type="submit" value="إضافة الكوبون"  class="btn-add" >
            </div>

          </div>
          <br>
            <br>
            <br>

        </form>

      
        <div class="table-responsive">
          <table class="table tablesorter " id="dt">
            <thead class=" text-primary">
              <tr>
                <th class="text-center">
                  الكود
                </th>
                <th class="text-center">
                  نوع العرض
                </th>
                <th class="text-center">
                  قيمة العرض
                </th>
                <th class="text-center">
                  عدد مرات استخدام الكود
                </th>
                <th class="text-center">

                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($copouns as $item)
            <tr>
              <td class="text-center">{{$item->code}}</td>
              <td class="text-center">{{$item->type}}</td>
              <td class="text-center">{{$item->value}}</td> 
              <td class="text-center">{{$item->num_usage}}</td>
              <td class="text-center">
                <span  id="{{ $item->id }}" class="reject-link remove-link">حذف</span>
              </td> 
            </tr>

             @endforeach
            </tbody>
          </table>
        </div>
        <!--<div class="display-flex justify-content-start align-items-xl-center enable-section ">
                <span class="title">
                   :رمز التفعيل 
                </span>
                <div class="block"><span>#1234567890</span></div>
                    
        </div> -->
        <p class="text-right">رمز التفعيل صالح للاستخدام مرة واحده </p>
        <br>
        <br>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
           // datatable config  

            $('#dt').DataTable({
                "oLanguage": {
                    "sSearch": "بحث:"
                },
                "language": {
                    "paginate": {
                        "previous": '<i class="fas fa-caret-right"></i>',
                        "next": '<i class="fas fa-caret-left"></i>'
                    },
                    "lengthMenu": "عرض _MENU_ منتجات",
                    "zeroRecords": "لا يوجد منتجات",
                    "info": "الصفحة _PAGE_ من _PAGES_ صفحات",
                }
            });
            $('#dt_filter').css('float', 'right');

            // end datatable config

            $("#offer_type").change(function(){
              if($(this).val()=="عرض على منتج معين"){

                $('.products-section').show();
                $('.products-section select').attr('required', true);

              }else{
                $('.products-section').hide()
                $('.products-section select').attr('required', false);

              }
            });

            $('.reject-link').on('click', function(){
              var r = confirm("هل انت متأكد من حذف الكوبون ؟");
              location.reload(true);if (r == true) {
                $.ajax({
                    url: "/remove_copouns?id="+$(this).attr('id'),
                    success: function(result){
                       location.reload(true);
                    }
                });
            }
        });
        });
    </script>
@endsection




