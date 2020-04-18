@extends('layouts.app', ['page' => __('Security'), 'pageSlug' => 'security'])

@section('content')
<div class="continaer-app-pages container-security ">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="row justify-content-start">
      <button type="submit" class="btn-control-panel btn-erp">لوحة التحكم/صفحات التطبيق/الخصوصية والأمان </button>
    </div>
    <div class="row justify-content-center">
      <form action="add_security" method="POST" class="form-input-info">
      @csrf
       
        <div class="input-group{{ $errors->has('title') ? ' has-danger' : '' }}">
              <input type="text" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="العنوان" value="{{ old('title') }}">
                  @include('alerts.feedback', ['field' => 'title'])
        </div>

  
        <div class="input-group{{ $errors->has('description') ? ' has-danger' : '' }}">
          <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{old('description')}}" placeholder="الوصف" rows="10" cols="105" name="description"></textarea>

                  @include('alerts.feedback', ['field' => 'description'])
        </div>

            <button type="submit" class="btn-add">إضافة</button>
      
      
    </form>
    </div>
  </div>
@endsection
