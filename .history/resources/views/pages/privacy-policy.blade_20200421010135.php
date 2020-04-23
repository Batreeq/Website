@extends('layouts.app', ['page' => __('Privacy-policy'), 'pageSlug' => 'privacy-policy'])

@section('content')
<div class="continaer-app-pages container-policy ">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-right" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="row justify-content-start mar-0">
      <button type="submit" class="btn-control-panel btn-erp">لوحة التحكم/صفحات التطبيق/الخصوصية والأمان  </button>
    </div>
   
   
    
    <div class="row justify-content-center mar-0">
      <form   method="POST" class="form-input-info"
          @if (count($data) == 0) 
             action="add_policy"
          @else
              action="update_policy"
          @endif>

        @csrf
        <div class="input-group{{ $errors->has('title') ? ' has-danger' : '' }}">
              <input type="text" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="العنوان" 
                @if (count($data) == 0) 
                  value="{{ old('title') }}"
                @else
                  value="{{$data[0]->title }}"
                @endif

              >
              @include('alerts.feedback', ['field' => 'title'])
        </div>
        @if (count($data) != 0) 
           <input type="hidden" name="id" value="{{$data[0]->id}}" >
        @endif
        
  
        <div class="input-group{{ $errors->has('text') ? ' has-danger' : '' }}">

          <textarea class="form-control {{ $errors->has('text') ? ' is-invalid' : '' }}" 
            @if (count($data) == 0) 
              value="{{ old('text') }}"
            @else
              value="{{$data[0]->text }}"
            @endif
            
            placeholder="الوصف" rows="10" cols="105" name="text">@if (count($data) == 0){{ old('text') }}@else{{$data[0]->text }}@endif</textarea>

                  @include('alerts.feedback', ['field' => 'text'])
          
        </div>

            <button type="submit" class="btn-add">إضافة</button>
      
      
    </form>
    </div>
  </div>
@endsection
