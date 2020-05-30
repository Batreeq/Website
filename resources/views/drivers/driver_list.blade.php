@extends('layouts.app', ['page' => __('driver_list'), 'pageSlug' => 'driver_list'])

@section('content')
<div class="row section-action">
    <div class="driver-list-container container height-all-page py-7 py-lg-8 ">
        <div class="row justify-content-start mar-0">
            <button class="btn-control-driver">اسماء السائقين</button>
        </div>
        <div class="row justify-content-start mar-0">
          <div class="col-md-3">
            <div class="driver_title text-right"><p>اسم السائق</p></div>
          </div>
        </div>
        <div class="row justify-content-start mar-0">
          <div class="col-md-3">
            <div class="driver_name text-right"><a  href="{{ url('/driver_details/1') }}">محمد</a></div>
          </div>
          <div class="col-md-3">
            <div class="driver_name text-right"><a  href="{{ url('/driver_details/1') }}">محمد</a></div>
          </div>
          <div class="col-md-3">
            <div class="driver_name text-right"><a  href="{{ url('/driver_details/1') }}">محمد</a></div>
          </div>
          <div class="col-md-3">
            <div class="driver_name text-right"><a  href="{{ url('/driver_details/1') }}">محمد</a></div>
          </div>
          <div class="col-md-3">
            <div class="driver_name text-right"><a  href="{{ url('/driver_details/1') }}">محمد</a></div>
          </div>
          <div class="col-md-3">
            <div class="driver_name text-right"><a  href="{{ url('/driver_details/1') }}">محمد</a></div>
          </div>
          <div class="col-md-3">
            <div class="driver_name text-right"><a  href="{{ url('/driver_details/1') }}">محمد</a></div>
          </div>
        </div>
    </div>
</div>
@endsection
