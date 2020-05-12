@extends('layouts.app', ['page' => __('Drivers'), 'pageSlug' => 'drivers'])

@section('content')
<div class="container work-us-screens-container">
   @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="row justify-content-between">
      <div class="display-flex">
        <button  class="btn-control-panel btn-erp">لوحة التحكم/قسم اعمل معنا/</button>
        <button  onclick="window.open('/driver', '_self')" style="margin-right: 2%" class="btn-control-panel btn-erp"><i class="fas fa-plus fa-xs"></i> إضافة سائق</button>
      </div>  
      
      <select class="list-lang">
          <option value="ar">عربي</option>
          <option value="en">English</option>
      </select>

    </div>
    
    <h2 class="text-center">الموظفين</h2>
    <div class="table-responsive">
      <table class="table tablesorter " id="workers">
        <thead class=" text-primary">
          <tr>
            <th class="text-center">
              اسم السائق
            </th>
            <th class="text-center">
              رقم الهاتف
            </th>
            <th class="text-center">
              العنوان
            </th>
            <th class="text-center">
              السيارة
            </th>
            <th class="text-center">
              الموديل
            </th>
            <th class="text-center">
              
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($Drivers as $item)
            <tr>
              <td class="text-center">{{$item->name}}</td>
              <td class="text-center">{{$item->phone}}</td>
              <td class="text-center">{{$item->location}}</td>
              <td class="text-center">{{$item->car}}</td>
              <td class="text-center">{{$item->car_model}}</td>
              <td class="text-center">
                <a href="/driver?id={{ $item->id }}" class="accept-link">تعديل</a>
                <span  id="{{ $item->id }}" class="reject-link remove-link">حذف</span>
                <!-- <a href="/remove_driver/{{$item->id}}" class="reject-link"></a> -->
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <br>
    <h2 class="text-center">طلبات التوظيف</h2>
    <div class="table-responsive">
      <table class="table tablesorter " id="requests">
        <thead class=" text-primary">
          <tr>
            <th class="text-center">
              اسم السائق
            </th>
            <th class="text-center">
              رقم الهاتف
            </th>
            <th class="text-center">
              العنوان
            </th>
            <th class="text-center">
              السيارة
            </th>
            <th class="text-center">
              الموديل
            </th>
            <th class="text-center">
             
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($PendingDrivers as $item)
            <tr>
              <td class="text-center">{{$item->name}}</td>
              <td class="text-center">{{$item->phone}}</td>
              <td class="text-center">{{$item->location}}</td>
              <td class="text-center">{{$item->car}}</td>
              <td class="text-center">{{$item->car_model}}</td>
              <td class="text-center">
                <a href="/approved_driver/{{$item->id}}" class="accept-link">قبول</a>
                <span  id="{{ $item->id }}" class="reject-link declined-link">رفض</span>
                <!-- <a href="/declined_driver/{{$item->id}}" class="reject-link declined-link">رفض</a> -->
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
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
        $('.declined-link').on('click', function(){
            var r = confirm("هل انت متأكد من رفض السائق ؟");
            location.reload(true);if (r == true) {
                $.ajax({
                    url: "/declined_driver?id="+$(this).attr('id'),
                    success: function(result){
                       location.reload(true);
                    }
                });
            }
        });

        $('.remove-link').on('click', function(){
            var r = confirm("هل انت متأكد من حذف السائق ؟");
            location.reload(true);if (r == true) {
                $.ajax({
                    url: "/remove_driver?id="+$(this).attr('id'),
                    success: function(result){
                       location.reload(true);
                    }
                });
            }
        });

    });
</script>
@endsection
