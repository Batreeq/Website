
@extends('layouts.app', ['page' => __('Different-parts'), 'pageSlug' => 'different-parts'])

@section('content')
  <div class="container ">
    <div class="row justify-content-start">
      <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/ أجزاء متغيرة </button>
    </div>
    <div>

        <div class="table-responsive">
              <table class="table tablesorter " id="">
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
@endsection
