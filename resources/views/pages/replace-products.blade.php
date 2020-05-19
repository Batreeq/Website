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
        <input type="hidden" name="lang" class="lang" value="ar">
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

  

  


 <h2 class="text-center">المنتجات التي يمكن الحصول عليها بالنقاط</h2>
    <div class="table-responsive">
      <table class="table tablesorter " id="workers">
        <thead class=" text-primary">
          <tr>
            <th class="text-center">
              اسم المنتج
            </th>
            <th class="text-center">
              الصورة
            </th>
            <th class="text-center">
              النقاط
            </th>
            <th class="text-center">
              
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($PointsProducts as $item)
            <tr id="{{ $item->id }}">
              <td class="text-center">{{ $item->product_name }}</td>
              <td class="text-center"><img width="40" src="{{$item->product_image}}"></td>
              <td class="text-center">{{ $item->points }}</td>
              <td class="text-center">
                <!-- <span class="accept-link"></span> -->

                <span class="accept-link" data-toggle="modal" data-target="#myModal">
                  <span class="{{ $item->id }}"></span> تعديل</span>
                <span  class="reject-link"><span class="{{ $item->id }}"></span>حذف</span>
              </td>

            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!--   <h4 class="modal-title">Modal Header</h4> -->
        </div>
        <div class="modal-body">
          <form class="form-input-info " style="width: 100%" action="edit_replace_product_point"  method="POST" class="" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" value="">
        <div class="row mar-0">
          <div class="col-lg-12 text-right">
            <span class="title">اسم المنتج</span>
            <div class="input-group">
                <input type="text" name="name" class="form-control"  value="{{ old('product_name') }}" required>
            </div>
          </div>
          <div class="col-lg-12 text-right">
            <span class="title">صورة المنتج</span>
            <div class="input-group">

              <input type="file" name="image" class="form-control"  
                value="">
                <img class="image-pro" style="width: 65px;height: 46px;" src=""/>

            </div>
          
          </div>
          <div class="col-lg-12 text-right">
            <span class="title">عدد النقاط المقابلة لهذا المنتج</span>
            <div class="input-group">
                <input type="number" name="point" class="form-control" value="" required>
            </div>
          </div>


        </div>

        </div>

        <div class="col-lg-12 ">

          <div class="row justify-content-center mar-0">
            <button type="submit" class="btn-add">تعديل</button>
          </div>          
        </div>
           <br>
          <br>

      </form>
        </div>
        
      </div>
      
    </div>
  </div>
 <script type="text/javascript">
    $(document).ready(function(){
       // datatable config

        $('#workers,#requests').DataTable({
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
        $('.accept-link').on('click', function(){
          var specialRow = $(this).find('span').attr('class');
          $('tbody tr').each(function(index, value) {
           
            if( $(this).attr('id') == specialRow ){
              $('.modal input[name="product_id"]').val($(this).attr('id'))
              $('.modal input[name="name"]').val($(this).find('td:first-child').html())
              $('.modal img.image-pro').attr("src",$(this).find('td:nth-child(2) img').attr("src"))
              $('.modal input[name="point"]').val($(this).find('td:nth-child(3)').html())
            }
          });
        });
        $('.reject-link').on('click', function(){
        var r = confirm("هل انت متأكد من حذف المنتج ؟");
        if (r == true) {
            $.ajax({
                url: "/remove_replace_product_point?id="+$(this).find('span').attr('class'),
                success: function(result){
                   location.reload(true);
                }
            });
          }
        });

    });
</script>
@endsection


