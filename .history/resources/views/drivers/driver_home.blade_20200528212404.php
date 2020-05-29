@extends('layouts.app', ['page' => __('driver_home'), 'pageSlug' => 'driver_home'])

@section('content')
<div class="row section-action">
    <div class="homepage-container container height-all-page py-7 py-lg-8 ">
        <div class="row justify-content-start mar-0">
            <button class="btn-control-panel btn-erp">لوحة التحكم/المستخدمين/السائق </button>
        </div>

        <div class="row justify-content-start mar-0">
            <div class="col-md-4">
                {{-- <div class=" justify-content-start align-items-center text-right btn-delivery">
                    <a href="{{ route('pages.privacy-policy') }}">
                       <span>الطلبات </span>
                   </a>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
