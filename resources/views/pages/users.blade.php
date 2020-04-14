@extends('layouts.app', ['page' => __('Users'), 'pageSlug' => 'users'])

@section('content')
<div class="container ">
    <div class="row justify-content-start">
      <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/المنتجات & التصنيفات  </button>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="row section-action">
            
            <div class="col-lg-6">
              <button type="submit" href="" class="btn-different btn-chat">المنتجات  </button>
            </div>
            <div class="col-lg-6">
              <button type="submit" href="" class="btn-different btn-erp">التصنيفات </button>
            </div>
         </div>
      </div>
    </div>
  </div>
@endsection
