@extends('layouts.app', ['page' => __('Different-parts'), 'pageSlug' => 'different-parts'])

@section('content')
  <div class="container ">
    <div class="row justify-content-start">
      <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/ أجزاء متغيرة </button>
    </div>
    <form id="addProduct" style="margin: 2%">
        <select class="form-control col-md-3" id="products" name="offer" required>
            <option value="" selected disabled>إضافة منتج اخر </option>
            @foreach ($allproducts as $oneProduct)
                <option value="{{ $oneProduct->id }}">{{ $oneProduct->name }}</option>
            @endforeach
        </select>
        <input type="submit" value="إضافة"  class="btn-add" style="height: 6vh">
        <input type="hidden" id="offer_id" value="<?php echo $_GET['offer'] ?>">
        </form>
    <div>

        <div class="table-responsive">
              <table class="table tablesorter " id="dt">
                <thead class=" text-primary">
                  <tr>
                    <th class="text-center">
                      اسم المنتج
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
                    <th class="text-center">
                        خيارات
                      </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $item)
                    <tr>
                    <td class="text-center">{{$item->name}}</td>
                    <td class="text-center">{{$item->quantity}}</td>
                    <td class="text-center">{{$item->price}}</td>
                    <td class="text-center">{{$item->name}}</td>
                    <td class="text-center">{{$item->name}}</td>
                    <td class="text-center"><a style="color: white;text-decoration: underline;" href="/deleteOffer?product={{ $item->id }}&offer_id=<?php echo $_GET['offer'] ?>">حذف</a></td>
                    </tr>
                 @endforeach
                </tbody>
              </table>
            </div>

    </div>

  </div>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#dt').DataTable();
        $('#dt_filter > label').text('بحث:')ك
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
