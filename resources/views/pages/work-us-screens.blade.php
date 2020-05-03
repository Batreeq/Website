@extends('layouts.app', ['page' => __('Work-us-screens'), 'pageSlug' => 'work-us-screens'])

@section('content')
<div class="container work-us-screens-container">
    <div class="row justify-content-start">
        
      <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/قسم اعمل معنا/
        @if($_GET['type'] == '1')
        شريك سوبر ماركت
        @elseif($_GET['type'] == '2')
        موظف معنا
        @elseif($_GET['type'] == '3')
        تاجر
        @else
        سائق
        @endif
      </button>

    </div>
    
    <h2 class="text-center">الموظفين</h2>
    <div class="table-responsive">
      <table class="table tablesorter " id="workers">
        <thead class=" text-primary">
          <tr>
            <th class="text-center">
              اسم الموظف
            </th>
            <th class="text-center">
              رقم الهاتف
            </th>
            <th class="text-center">
              العنوان
            </th>
            <th class="text-center">
              الراتب
            </th>
            <th class="text-center">
              العمر
            </th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td class="text-center">جارة</td>
              <td class="text-center">000000000</td>
              <td class="text-center">amman</td>
              <td class="text-center">40000</td>
              <td class="text-center">45</td>
            </tr>
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
              اسم المستخدم
            </th>
            <th class="text-center">
              رقم الهاتف
            </th>
            <th class="text-center">
              العنوان
            </th>
            <th class="text-center">
              الراتب المتوقع
            </th>
            <th class="text-center">
              العمر
            </th>
            <th class="text-center">
              المهنة
            </th>
            <th class="text-center">
             
            </th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td class="text-center">جارة</td>
              <td class="text-center">000000000</td>
              <td class="text-center">amman</td>
              <td class="text-center">40000</td>
              <td class="text-center">45</td>
              <td class="text-center">سائق</td>
              <td class="text-center"><a href="#" class="accept-link">قبول</a><a href="#" class="reject-link">رفض</a></td>
            </tr>
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

    });
</script>
@endsection
