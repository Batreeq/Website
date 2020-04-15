@extends('layouts.app', ['page' => __('Category'), 'pageSlug' => 'category'])

@section('content')

<div class="container ">

    <div class="row justify-content-start">
        <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/ التصنيفات  </button>
    </div>
    <div class="row ">
    	<form action="submit" method="POST" class="form-input-info">
		 	@csrf
		 	<div class="row ">
		 		<div class="col-lg-6 ">
				 	<div class="input-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
		                <input type="text" name="category_name" class="form-control {{ $errors->has('category_name') ? ' is-invalid' : '' }}" placeholder="اسم التصنيف" value="{{ old('category_name') }}">
		                    @include('alerts.feedback', ['field' => 'category_name'])
		            </div>
		        </div>
		        <div class="col-lg-6">
		          <div class="row justify-content-start">
		          	<button type="submit" class="btn-add">إضافة</button>
		          </div>				 	
				</div>
		    </div>
		</form>
    </div>
    <div class="row categories-table">
    	@foreach ($data as $item)
            <div class="col-lg-3 col-md-6 category-row" >
            	<span>{{$item->name}}</span>
            </div>
             	 
	    @endforeach
    </div>
	 

	<ul>
		
	</ul>
</div>

	   @endsection