@extends('layouts.app', ['page' => __('Users'), 'pageSlug' => 'users'])

@section('content')
<div class="row section-action">
    <div class="col-lg-6">
       <button  class="btn-homepage btn-different btn-crm text-mar"><a style="color: white;" href="/dashboard">سائق </a></button>
     </div>
     <div class="col-lg-6">
       <button  class="btn-homepage btn-different btn-app text-mar">سوبر ماركت </button>
     </div>
    <div class="col-lg-6">
       <button  class="btn-homepage btn-different btn-chat text-mar-mobile">Chat Bot  </button>
     </div>
     <div class="col-lg-6">
       <button class="btn-homepage btn-different btn-erp text-mar-mobile">Erp System </button>
     </div>

  </div>
  @endsection
