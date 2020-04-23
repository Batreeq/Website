@extends('layouts.app', ['page' => __('Products'), 'pageSlug' => 'products'])

@section('content')
<div class="container ">
    <div class="container products-categories-container active">
      <div class="row justify-content-start">
        <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/المنتجات  </button>
      </div>

    <div>

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
                  الكمية
                </th>
                <th class="text-center">
                  التكلفة
                </th>
                <th class="text-center">
                  مفعل/غير مفعل
                </th>
                <th class="text-center">
                  مضاف بواسطة
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $item)
            <tr>
              <td class="text-center">{{$item->name}}</td>
              <td class="text-center"><img width="40" src="images/{{$item->image}}"></td>
              <td class="text-center">{{$item->quantity}}</td>
              <td class="text-center">{{$item->price}}</td>
              <td class="text-center">{{$item->name}}</td>
              <td class="text-center">{{$item->name}}</td>
            </tr>

             @endforeach
            </tbody>
          </table>
        </div>

</div>

    </div>
    <div class="product-block">
        @include('layouts.product-block')
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

        $('#addProduct').on('submit', function(){
            $.ajax({
                url: "/addProductToOffer?product="+$('#products').val()+'&offer_id='+$('#offer_id').val(),
                success: function(result){
                    location.reload(true);
                }
            });
        });
    });
</script>
@endsection


