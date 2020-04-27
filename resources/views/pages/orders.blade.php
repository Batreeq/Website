
@extends('layouts.app', ['page' => __('Orders'), 'pageSlug' => 'orders'])

@section('content')
  <div class="orders-container ">
    <div class="row mar-0 justify-content-start">
      <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/ الطلبات </button>
    </div>
    <div class="table-responsive">
      <table class="table tablesorter " id="dt">
        <thead class=" text-primary">
          <tr>
            <th class="text-center">
              اسم الطالب
            </th>
            <th class="text-center">
              رقم الهاتف
            </th>
            <th class="text-center">
              العناون
            </th>
            <th class="text-center">
              نوع الاستلام
            </th>
            <th class="text-center">
              طريقة الدفع
            </th>
            <th class="text-center">
              السعر الكلي
            </th>
            <th class="text-center">
             
            </th>
          </tr>
        </thead>
        <tbody>

        @foreach ($orders as $item)

         <tr>
            <td class="text-center">{{$item->user_name}}</td>
            <td class="text-center">{{$item->phone}}</td>
            <td class="text-center">{{$item->city}}, {{$item->region}}, {{$item->location}}</td>
            <td class="text-center">{{$item->delivery_type}}</td>
            <td class="text-center">{{$item->payment_type}}</td>
            <td class="text-center">{{$item->total_price}}</td>
            <td class="text-center">
              <p class="btn-add-offer display-flex justify-content-center align-items-center"><a  href="#">تفاصيل الطلب</a></p>
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
 



