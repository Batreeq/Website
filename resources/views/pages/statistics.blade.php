
@extends('layouts.app', ['page' => __('Statistics'), 'pageSlug' => 'statistics'])

@section('content')
    <div class="row continaer-app-pages">
        <div class="col-md-4">
            <div class="row justify-content-center align-items-xl-center">

                <select class="form-control">
                    <option>الخصوصية والأمان </option>
                </select>
                <span class="input-group-btn arrow-select  justify-content-center align-items-xl-center">
                    <img width="27" src="{{ asset('white') }}/img/arrow.png" alt="arrow image">
                </span>

            </div>
            <div class="row justify-content-center align-items-xl-center">

                <select class="form-control">
                    <option>الخصوصية والأمان </option>
                </select>
                <span class="input-group-btn arrow-select  justify-content-center align-items-xl-center">
                    <img width="27" src="{{ asset('white') }}/img/arrow.png" alt="arrow image">
                </span>
                
            </div>
            <div class="row justify-content-center align-items-xl-center">

                <select class="form-control">
                    <option>الخصوصية والأمان </option>
                </select>
                <span class="input-group-btn arrow-select  justify-content-center align-items-xl-center">
                    <img width="27" src="{{ asset('white') }}/img/arrow.png" alt="arrow image">
                </span>
                
            </div>
        </div>
    </div>
@endsection

