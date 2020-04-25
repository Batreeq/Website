
@extends('layouts.app', ['page' => __('Copons'), 'pageSlug' => 'copons'])

@section('content')
    <div class="copons-continaer">
        <div class="row justify-content-start mar-0">
            <button class="btn-control-panel btn-erp">لوحة التحكم/الكوبونات</button>
        </div>
        <div class="display-flex justify-content-start align-items-xl-center enable-section ">
            <span class="title">
               :رمز التفعيل 
            </span>
            <div class="block"><span>#1234567890</span></div>
                
        </div>
        <p class="text-right">صالح للاستخدام مرة واحده </p>

    </div>
@endsection

