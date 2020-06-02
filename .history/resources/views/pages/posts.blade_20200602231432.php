
@extends('layouts.app', ['page' => __('posts'), 'pageSlug' => 'posts'])

@section('content')
    <div class="calculate-points-continaer">
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
            <button class="btn-control-panel btn-erp">لوحة التحكم/ أجزاء متغيرة/الإعلانات</button>
            <select class="list-lang">
                <option value="ar">عربي</option>
                <option value="en">English</option>
            </select>
        </div>
        <form action="add_calculate_point" method="POST" class="form-add-points" enctype="multipart/form-data" style="margin-bottom: 40px">
          @csrf
          <input type="hidden" name="add_product_id" value="">
          <div class="row mar-0">
            <div class="col-lg-4">
              <select class="form-control" id="select_add_point" name="product_add_point" required>
                  <option value="" selected disabled>اختر المنتج المراد إضافة نقاط له</option>
                  @foreach ($Products as $item)
                      <option class="{{ $item->copons }}"   value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
              </select>
               <br>
            </div>

            <div class="col-lg-4">
              <div class="input-group">
                  <input type="number" name="product_point" class="form-control " placeholder=" عدد النقاط" value="" required>
              </div>
              <br>
            </div>

            <div class="col-lg-4">
              <input type="submit" value="إضافة"  class="btn-add" >
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table tablesorter " id="dt">
            <thead class=" text-primary">
              <tr>
                <th class="text-center">
                  صورة الاعلان
                </th>
                <th class="text-center">
                  اسم المنتج
                </th>
                <th class="text-center">

                </th>
              </tr>
            </thead>
            <tbody>
             @foreach ($posts as $item)
            <tr>
              <td class="text-center" style="width: 15%"><img src="{{$item->image}}" alt="image" style="width: 100%;"></td>
              <td class="text-center"><img width="40" src="{{$item->product_name}}"></td>
              <td class="text-center"><span  id="{{ $item->id }}" class="reject-link">حذف</span></td>

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

            $("#select_add_point").change(function(){
              $('input[name="add_product_id"]').val($(this).val())
            });

            $("#select_update_point").change(function(){
              $('input[name="product_id"]').val($(this).val())
              $('input[name="new_points"]').val( $("#select_update_point option:selected").attr('class'))

            });

            $('#select_actions_points').change(function(){
              $('input[name="points"]').val($("#select_actions_points option:selected").attr('class'))
              $('input[name="action_id"]').val($(this).val())
            });

            $('.reject-link').on('click', function(){
            var r = confirm("هل انت متأكد من حذف الإعلان ؟");
            location.reload(true);if (r == true) {
                $.ajax({
                    url: "/remove_post?id="+$(this).attr('id'),
                    success: function(result){
                       location.reload(true);
                    }
                });
            }
        });
        });
    </script>
@endsection




