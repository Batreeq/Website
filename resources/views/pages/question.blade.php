@extends('layouts.app', ['page' => __('Question'), 'pageSlug' => 'question'])

@section('content')
<div class="continaer-app-pages container-policy ">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="row justify-content-between">
      <button class="btn-control-panel btn-erp">لوحة التحكم/صفحات التطبيق/أسئلة شائعة   </button>
      <select class="list-lang">
          <option value="ar">عربي</option>
          <option value="en">English</option>
      </select>
    </div>
    <div class="row justify-content-center">
      <form action="add_question" method="POST" class="form-input-info">
      @csrf
       <input type="hidden" name="lang" class="lang" value="ar">
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
