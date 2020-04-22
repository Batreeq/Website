
@extends('layouts.app', ['page' => __('Different-parts'), 'pageSlug' => 'different-parts'])

@section('content')
  <div class="container ">
    <div class="row justify-content-start">
      <button type="submit" href="" class="btn-control-panel btn-erp">لوحة التحكم/ أجزاء متغيرة </button>
      <button type="submit" onclick="window.open('/edit-different-parts', '_self')" style="margin-right: 2%" class="btn-control-panel btn-erp"><i class="fas fa-plus fa-xs"></i> إضافة عرض جديد  </button>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="row section-action">
            @foreach ($parts as $part)
                <div class="col-lg-6">

                <button type="submit" href="" class="btn-different btn-chat text-mar">
                    <a style="color: white;" href="/offers-screens?offer={{ $part->id }}">{{ $part->name }}</a>
                    <br>
                    <a style="color: white;margin: 2%;" href="/offers-screens?offer={{ $part->id }}"><i class="fas fa-eye fa-xs"></i></a>
                    <a style="color: white;margin: 2%;" href="/edit-different-parts?offer={{ $part->id }}"><i class="fas fa-edit fa-xs"></i></a>
                    <span style="color: white;margin: 2%;" onClick="deleteOffer({{ $part->id }})"><i class="fas fa-trash-alt fa-xs"></i></span>
                </button>
            </div>
            @endforeach
         </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
    function deleteOffer(offer_id){
        var r = confirm("هل انت متأكد من حذف العرض؟");
            if (r == true) {
                $.ajax({
                    url: "/delete_offer?offer="+offer_id,
                    success: function(result){
                        location.reload(true);
                    }
                });
            }
    }
    $(document).ready(function(){

    });
</script>
@endsection
