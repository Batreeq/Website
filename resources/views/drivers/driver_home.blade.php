@extends('layouts.app', ['page' => __('driver_home'), 'pageSlug' => 'driver_home'])

@section('content')
<div class="row section-action">
    <div class="homepage-container container height-all-page py-7 py-lg-8 ">
        <div class="row justify-content-start mar-0">
            <button class="btn-control-panel btn-driver">لوحة التحكم/المستخدمين/السائق </button>
        </div>

        <div class="row justify-content-start mar-0">
            <div class="col-md-4">
                <div class=" justify-content-start align-items-center text-right tab-driver">
                       <span>الطلبات </span>
                </div>
                <button class="row btn-homepage btn-different green-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    1000
                    <br>
                    الطلبات المنجزة
                    </div>
                </button>
                <button class="row btn-homepage btn-different burble-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    200
                    <br>
                    الطلبات قيد الانتظار
                    </div>
                </button>
                <button class="row btn-homepage btn-different yellow-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    100
                    <br>
                    الطلبات قيد التأكيد
                    </div>
                </button>
            </div>
            <div class="col-md-4">
                <div class=" justify-content-start align-items-center text-right tab-driver">
                    <span><a href="/driver_availablity" style="color:white">السائقين المتاحين</a></span> 
                </div>
                <button class="row btn-homepage btn-different green-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    10
                    <br>
                    سائقين متاحين
                    </div>
                </button>
                <div class=" justify-content-start align-items-center text-right tab-driver">
                    <span>الجولات </span>
                </div>
                <button class="row btn-homepage btn-different yellow-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    1000
                    <br>
                    الجولات المنتهية
                    </div>
                </button>
            </div>
            <div class="col-md-4">
                <div class=" justify-content-start align-items-center text-right tab-driver">
                    <span>حسابات التوصيل </span>
                </div>
                <button class="row btn-homepage btn-different green-driver-btn text-mar-mobile">
                    <div class="col-md-3">
                        <img src="/images/request.png" alt="request">
                    </div>
                    <div class="col-md-8">
                    2000 jd
                    <br>
                    حسابات التوصيل
                    </div>
                </button>
                <div class=" justify-content-start align-items-center text-right tab-driver">
                    <span>مواقع السائقين </span>
                </div>
            

    <div id="map"></div>
            </div>
        </div>
    </div>
</div>
<!-- <?php 
// 
// echo "<script>neighborhoods = '" . $drivers  . "'</script>";
?>  -->

<script>

      // If you're adding a number of markers, you may want to drop them on the map
      // consecutively rather than all at once. This example shows how to use
      // window.setTimeout() to space your markers' animation.

      var neighborhoods = [
        {"lat":52.511, "lng": 13.447},
        {"lat": 52.549, "lng": 13.422}
      ];

      var markers = [];
      var map;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: 52.520, lng: 13.410}
        });
        drop()
      }

      function drop() {
        clearMarkers();
        for (var i = 0; i < neighborhoods.length; i++) {
          addMarkerWithTimeout(neighborhoods[i], i * 200);
        }
      }

      function addMarkerWithTimeout(position, timeout) {
        window.setTimeout(function() {
          markers.push(new google.maps.Marker({
            position: position,
            map: map,
            animation: google.maps.Animation.DROP
          }));
        }, timeout);
      }

      function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(null);
        }
        markers = [];
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoGC2F3TpXrPdoycon53N_vHN0WXCdBIg&v=3.31&language=en&libraries=places,geometry&callback=initMap">
    </script>

     <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        margin-top:20px;
        height: 400px;
      }
    </style>
@endsection
