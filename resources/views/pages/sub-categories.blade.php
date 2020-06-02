@extends('layouts.app', ['page' => __('sub-categories'), 'pageSlug' => 'sub-categories'])

@section('content')

<div class="categories-container ">

    <div class="row justify-content-between mar-0">
        <button class="btn-control-panel btn-erp">لوحة التحكم/ التصنيفات  </button>
        <select class="list-lang">
          <option value="ar">عربي</option>
          <option value="en">English</option>
        </select>
    </div>


    <div class="row mar-0 ">
    	<form action="add_sub_category" method="POST" class="form-input-info">
		 	@csrf
      <input type="hidden" name="lang" class="lang" value="ar">
		 	<div class="row mar-0 ">
		 		<div class="col-lg-6 ">
				 	  <div class="input-group">
                <input type="text" name="category_name" class="form-control" required="required" placeholder="اسم التصنيف" value="{{ old('category_name') }}">
                    
		        </div>
		      </div>
          <div class="col-lg-6 ">
            <div class="input-group">
              <select name="category_id" class="form-control" required> 
                <option  value="" selected disabled="">اختر القسم المناسب</option>
                  @foreach ($data_categories as $item)
                    <option  value={{$item->id}}>{{$item->name}}</option>
                  @endforeach
              </select> 
            </div>
          </div>
		        <div class="col-lg-6">
		          <div class="row justify-content-start mar-0">
		          	<button type="submit" class="btn-add">إضافة</button>
		          </div>				 	
				</div>
		    </div>
		</form>
    </div>
    <div class="row categories-table">
    	@foreach ($sub_categories as $item)
            <div class="col-lg-3 col-md-6 category-row" id="{{ $item->id }}" >
            	<div>

            		<span class="category_name">{{$item->name}}</span>
                <span class="category_id" style="display: none;">{{$item->category_id}}</span>
            		<span style="float: left;font-size: 20px;" class="accept-link"  data-toggle="modal" data-target="#myModal">
            			<span class="{{ $item->id }}"></span> 
            			<i class="fas fa-edit fa-xs"></i>
            		</span>
	                <span  class="reject-link" style="float: left;font-size: 20px;padding-left:10px">
	                	<span class="{{ $item->id }}"></span>
	                	<i class="fas fa-trash-alt fa-xs"></i>
	                </span>
	                
	            </div>

            	 
            </div>
             	 
	    @endforeach
    </div>
	 

	<ul>
		
	</ul>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!--   <h4 class="modal-title">Modal Header</h4> -->
        </div>
        <div class="modal-body">
          <form action="edit_sub_category" method="POST" style="width: 100%" class="form-input-info">
		 	@csrf
		 	<input type="hidden" name="category_id" value="">
		 	<div class="row mar-0 ">
		 		<div class="col-lg-12 ">
				 	<div class="input-group">
		                <input type="text" name="category_name" class="form-control" placeholder="اسم التصنيف" value="" required>
		                  
		            </div>
		        </div>
            <div class="col-lg-12 ">
            <div class="input-group{{ $errors->has('category_name') ? ' has-danger' : '' }}">
              <select name="main_category" 
              class="form-control" required> 
                  @foreach ($data_categories as $item)
                    <option  value={{$item->id}} >{{$item->name}}</option>
                  @endforeach
              </select> 
            </div>
          </div>
		        <div class="col-lg-4">
		          <div class="row justify-content-start mar-0">
		          	<button type="submit" class="btn-add">تعديل</button>
		          </div>				 	
				</div>
		    </div>
		</form>
        </div>
        
      </div>
      
    </div>
 </div>
<script type="text/javascript">
    
        $('.accept-link').on('click', function(){
           var specialRow = $(this).find('span').attr('class');
           $('.category-row').each(function(index, value) {
           
             if( $(this).attr('id') == specialRow ){
              $('.modal input[name="category_id"]').val($(this).attr('id'))
              var main_category=$(this).find('span.category_id').html()
              $('.modal select[name="main_category"] option').each(function(index, value) {
               $(this).removeAttr("selected")
                if(main_category == $(this).val()){
                  $(this).attr("selected","selected")
                }
               
              })
              // $('.modal select[name="main_category"]').val($(this).find('span.category_id').html())
          //     $('.modal input[name="name"]').val($(this).find('td:first-child').html())
          //     $('.modal img.image-pro').attr("src",$(this).find('td:nth-child(2) img').attr("src"))
               $('.modal input[name="category_name"]').val($(this).find('span.category_name').html())
            }
          });
        });
        $('.reject-link').on('click', function(){
        var r = confirm("هل انت متأكد من حذف التصنيف ؟");
        if (r == true) {
            $.ajax({
                url: "/remove_sub_category?id="+$(this).find('span').attr('class'),
                success: function(result){
                   location.reload(true);
                }
            });
          }
        });

 
</script>
	   @endsection