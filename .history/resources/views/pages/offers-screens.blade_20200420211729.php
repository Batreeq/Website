
@extends('layouts.app', ['page' => __('Different-parts'), 'pageSlug' => 'different-parts'])

@section('content')
  <div class="container ">
    <div class="row justify-content-start">
      <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/ أجزاء متغيرة </button>
    </div>
    <div>
        <select class="form-control"
            name="product_special_price_for">
            <option value="" selected disabled>نوع المستخدم/فئة </option>

            <option value="2">عدد مرات الشراء الكلي اكثر من ٣ مرات</option>
            <option value="3">متوسط عدد مرات الشراء الشهري اقل من ٣ مرات</option>
            <option value="4">متوسط عدد مرات الشراء الشهري اكثر من ٣ مرات</option>
            <option value="5">قيمة الشراء الكلي اكثر من ١٠٠$ </option>
            <option value="6">قيمة الشراء الكلي اقل من ١٠٠$ </option>
            <option value="7">متوسط عدد  مرات استخدام التطبيق شهريا اكثر من ١٠ مرات </option>
            <option value="8">متوسط عدد  مرات استخدام التطبيق شهريا اقل من ١٠ مرات</option>
            <option value="9">متوسط قيمة الشراء الشهري اكثر من ٣٠$ </option>
            <option value="10"> متوسط قيمة الشراء الكلي اقل من ٣٠$</option>
            <option value="11">استخدام مستمر او متقطع لنفس الصنف او صنف منافس</option>
            <option value="12">سعر خاص عشوائي لعدد معين من المستخدمين وفق الموقع الجغرافي</option>
            <option value="13">اذا إنقطع المستخدم عن الشراء من التطبيق لفترة معينة</option>

        </select>

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
                  @foreach ($products as $item)
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
