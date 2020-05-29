@extends('layouts.app', ['page' => __('Users'), 'pageSlug' => 'users'])

@section('content')
<div class="row section-action">
    <div class="homepage-container container height-all-page py-7 py-lg-8 ">
        <div class="header-body height-all-page text-center mb-7">
            <br><br>
            <div class="row height-all-page justify-content-center align-items-center">

                <div class="col-lg-6 col-md-6 mt-5">
                    <div class="col-lg-6">
                    <button  class="btn-homepage btn-different btn-crm text-mar"><a style="color: white;" href="/dashboard">سائق </a></button>
                    </div>
                    <div class="col-lg-6">
                    <button  class="btn-homepage btn-different btn-app text-mar">سوبر ماركت </button>
                    </div>
                    <div class="col-lg-6">
                    <button  class="btn-homepage btn-different btn-chat text-mar-mobile">تاجر  </button>
                    </div>
                    <div class="col-lg-6">
                    <button class="btn-homepage btn-different btn-erp text-mar-mobile">موظف معنا </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
