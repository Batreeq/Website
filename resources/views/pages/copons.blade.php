
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
        <form action="update_copons" method="POST" class="form-edit-copons" enctype="multipart/form-data" style="margin-bottom: 40px">
          @csrf

          <div class="row mar-0">
            <div class="col-lg-4">
              <select class="form-control" id="products" name="product_old_copons" required>
                  <option value="" selected disabled>اختر المنتج المراد تغيير كوبونه</option>
                  @foreach ($products as $item)
                      <option @if( ($item->copons) !=null) class="{{ $item->copons }}" @else class="0" @endif   value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
              </select>
               <br>
            </div>

            <div class="col-lg-4">
              <div class="input-group">
                  <input type="text" name="product_new_copons" class="form-control "  value="" required>
              </div>
              <br>
            </div>
            <div class="col-lg-4">
            <input type="submit" value="تعديل الكوبون"  class="btn-add" >
          </div>
          </div>

        </form>
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

            $("#products").change(function(){
              $('input[name="product_new_copons"]').val( $("#products option:selected").attr('class'))

            });
        });
    </script>
@endsection




