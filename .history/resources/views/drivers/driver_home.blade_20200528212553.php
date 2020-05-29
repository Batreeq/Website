@extends('layouts.app', ['page' => __('driver_home'), 'pageSlug' => 'driver_home'])

@section('content')
<div class="row section-action">
    <div class="row section-second mar-0">
        <div class="col-md-4 pad-0">

            <div class=" justify-content-start align-items-center text-right btn-delivery">
                <a href="{{ route('pages.privacy-policy') }}">
                   <span>الخصوصية والأمان </span>
               </a>
            </div>
            <div class=" justify-content-start align-items-center  text-right btn-delivery">
                <a href="{{ route('pages.terms') }}">
                   <span>السياسة العامة </span>
               </a>
            </div>
            <div class=" justify-content-start align-items-center  text-right btn-delivery">
                <a href="{{ route('pages.question') }}">
                   <span>أسئلة شائعة </span>
               </a>
            </div>
            <div class=" justify-content-start align-items-center  text-right btn-delivery">
                <a href="{{ route('pages.help') }}">
                   <span>المساعدة </span>
               </a>
            </div>


        </div>
    </div>
</div>
@endsection
