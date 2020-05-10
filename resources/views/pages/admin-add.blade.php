@extends('layouts.app', ['page' => __('Admin-add'), 'pageSlug' => 'admin-add'])

@section('content')
<div class=" add-admin-container ">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="row justify-content-between mar-0">
      <button class="btn-control-panel btn-erp">كل ما يخص الأدمن</button>
      <select class="list-lang">
          <option value="ar">عربي</option>
          <option value="en">English</option>
      </select>
    </div>
     
    <form action="add_admin" class="form-offer form-add-admin" method="POST" enctype="multipart/form-data">
        @csrf
        

        <div class="row mar-0">

          <div class="col-lg-6 text-right">
            <span class="title">اسم الأدمن</span>
            <div class="input-group">
                <input type="text" name="name" class="form-control "  value="" required>
            </div>
          </div>
          <div class="col-lg-6  text-right">
            <span class="title">صورة الأدمن</span>
             <div class="input-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                <input type="file" name="image" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"  value="{{ old('image') }}" required>
                    @include('alerts.feedback', ['field' => 'image'])
            </div>

          </div>

          <div class="col-lg-6  text-right">
            <span class="title ">رقم هاتف</span>
            <input type="number" name="phone" class="form-control "  value="" required>
          </div>

          <div class="col-lg-6  text-right">
            <span class="title">البريد الإلكتروني</span>
            <div class="input-group">
                <input type="email" name="email" class="form-control "  value="" required>
            </div>
          </div>
          <div class="col-lg-6  text-right">
            <span class="title">كلمة السر</span>
            <input type="password" name="password" class="form-control "  value="" required>
          </div>
          
        </div>
      <br>
        <div class="row justify-content-center mar-0">
          <button type="submit" class="btn-add">إضافة</button>
        </div>
        <br> <br>
    </form>

      <h2 class="text-center">قائمة بكل الأدمن</h2>
      <br>
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
               
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users_admin as $item)
          <tr>
            <td class="text-center">@if ($item->name!=null ){{$item->name}} @else <span>_</span> @endif </td>
            <td class="text-center">{{$item->email}}</td>
            <td class="text-center">{{$item->phone}}</td>
            <td class="text-center"><img width="40" src="{{$item->image}}"></td>
            <td class="text-center">
              <a style="color: white;margin: 2%;" id="{{$item->id}}" class="deleteAdmin" href="/remove_admin/{{$item->id}}">
                <i class="fas fa-trash-alt fa-xs"></i>
              </a>
            </td>


             
          </tr>

           @endforeach
          </tbody>
        </table>
      </div>



<br><br>
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

        //  $('.deleteAdmin').on('click', function(){
        //   alert("klklklklk")
        //     // var r = confirm("هل انت متأكد من حذف الأدمن؟");
        //     // if (r == true) {
        //        $.ajax({
        //     url: '/remove_admin',
        //     type: 'POST',
        //     data: {},
        //     dataType: 'json',
        //     success: function( _response ){
        //     },
        //     error: function( _response ){
        //      alert("error")
        //     }
        //   });
                
        //     // }
        // });

    });
</script>
@endsection


