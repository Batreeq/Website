
@extends('layouts.app', ['page' => __('Copons'), 'pageSlug' => 'copons'])

@section('content')
    <div class="copons-continaer">
        <div class="row justify-content-start mar-0">
            <button class="btn-control-panel btn-erp">لوحة التحكم/الكوبونات</button>
        </div>

        <div class="table-responsive">
          <table class="table tablesorter " id="dt">
            <thead class=" text-primary">
              <tr>
                <th class="text-center">
                  اسم المنتج
                </th>
                <th class="text-center">
                  صورة المنتج
                </th>
                <th class="text-center">
                  رمز التفعيل
                </th>

              </tr>
            </thead>
            <tbody>
              @foreach ($products as $item)
            <tr>
              <td class="text-center">{{$item->name}}</td>
              <td class="text-center"><img width="40" src="images/{{$item->image}}"></td>
              <td class="text-center">{{$item->copons}}</td> 
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




