@extends('layouts.app', ['page' => __('Users'), 'pageSlug' => 'users'])

@section('content')
<div class="users-container ">
    <div class="row justify-content-start mar-0">
      <button  class="btn-control-panel btn-erp">لوحة التحكم/المستخدمين</button>
    </div>

     <div class="table-responsive">
      <table class="table tablesorter " id="dt">
        <thead class=" text-primary">
          <tr>
            <th class="text-center">
              اسم المستخدم
            </th>
            <th class="text-center">
             البريد الإلكتروني
            </th>
            <th class="text-center">
             رقم الهاتف
            </th>
            <th class="text-center">
              صورة المستخدم
            </th>
            <th class="text-center">
              العنوان
            </th>
            <th class="text-center">
              عدد النقاط
            </th>
            <th class="text-center">
              الرصيد المفعل
            </th>
            <th class="text-center">
             الرصيد الغير مفعل
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $item)
        <tr>
          <td class="text-center">@if ($item->name!=null ){{$item->name}} @else <span>_</span> @endif </td>
          <td class="text-center">{{$item->email}}</td>
          <td class="text-center">{{$item->phone}}</td>
          <td class="text-center"><img width="40" src="{{$item->image}}"></td>
          <td class="text-center">@if ($item->location!=null ){{$item->location}} @else <span>_</span> @endif </td>
          <td class="text-center">@if ($item->points!=null ){{$item->points}} @else <span>_</span> @endif</td>
          <td class="text-center">@if ($item->active_balance!=null ){{$item->active_balance}} @else <span>_</span> @endif </td>
          <td class="text-center"> @if ($item->inactive_balance!=null ){{$item->inactive_balance}} @else <span>_</span> @endif</td>

           
        </tr>

         @endforeach
        </tbody>
      </table>
    </div>
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

    });
</script>
@endsection
