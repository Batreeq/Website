
@extends('layouts.app', ['page' => __('Statistics'), 'pageSlug' => 'statistics'])


@section('content')
<div class="container-dashboard-page">
    <div class="row justify-content-start mar-0">
      <button  class="btn-control-panel btn-erp">لوحة التحكم/ احصائيات </button>
    </div>
    <div class="row">
        <div class="col-md-3"> 
            <div class="display-flex justify-content-center align-items-center block-num-customers">
                <div class="image">
                    <img width="27" src="{{ asset('white') }}/img/customers.png" alt="arrow image">
                </div>
                <div class="text text-center">
                    <p class="number">1000</p>
                    <p>عدد العملاء </p>
                </div>                   
            </div>
        </div>
        <div class="col-md-3"> 
            <div class="display-flex justify-content-center align-items-center block-requests">
                <div class="image">
                    <img width="27" src="{{ asset('white') }}/img/request.png" alt="arrow image">
                </div>
                <div class="text text-center">
                    <p class="number">1000</p>
                    <p>الطلبات </p>
                </div>                   
            </div>
        </div>
        <div class="col-md-3"> 
            <div class="display-flex justify-content-center align-items-center block-all-accounts">
                <div class="image">
                    <img width="27" src="{{ asset('white') }}/img/tag.png" alt="arrow image">
                </div>
                <div class="text text-center">
                    <p class="number">000.0000</p>
                    <p>إجمالي الحسابات </p>
                </div>                   
            </div>
        </div>
        <div class="col-md-3"> 
            <div class="display-flex justify-content-center align-items-center block-current-customers">
                <div class="image">
                    <img width="27" src="{{ asset('white') }}/img/customers.png" alt="arrow image">
                </div>
                <div class="text text-center">
                    <p class="number">1000</p>
                    <p>العملاء الحاليين </p>
                </div>                   
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header text-right" data-background-color="#9C56FE">
                    <span>إجمالي الارباح</span>
                </div>
                <div class="card-body">
                     <div id="chartContainer5" style="height: 200px; width: 100%;"></div>
               </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header text-right" data-background-color="#9C56FE">
                    <span>إجمالي المبيعات </span>
                </div>
                <div class="card-body">
                     <div id="chartContainer6" style="height: 200px; width: 100%;"></div>
               </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header text-right" data-background-color="#9C56FE">
                    <span>الطلبات </span>
                </div>
                <div class="card-body">
                   <div id="chartContainer" style="height: 200px; width: 100%;"></div>
               </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header text-right" data-background-color="#9C56FE">
                    <span>نسبة أرباح اليوم لأمس </span>
                </div>
                <div class="card-body">
                   <div id="chartContainer4" style="height: 200px; width: 100%;"></div>
               </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart users">
                <div class="card-header text-right" data-background-color="#9C56FE">
                    <span>المستخدمين </span>
                </div>
                <div class="card-body" >
                    <div class="display-flex justify-content-end info" >
                        <p class="number">102480</p>
                        <img  src="{{ asset('white') }}/img/icon.png" alt="icon image">
                        
                    </div>
                    <div id="chartContainer7" style="height: 150px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-chart analytic-statistics">
                <div class="card-header display-flex justify-content-between" >
                    <div class="display-flex">
                        <div class="text-yearly">Yearly</div>
                        <div class="display-flex justify-content-center align-items-center">
                            <span>Revenue</span>
                            <div class="index-revenue"></div>
                        </div>
                        <div class="display-flex justify-content-center align-items-center">
                            <span >Income</span>
                            <div class="index-income"></div>
                        </div>
                    </div>
                    <div>
                        <span class="title">Analytic Statistics</span>
                    </div>
                </div>
                <div class="card-body">
                   <div id="chartContainer3" style="height: 200px; width: 100%;"></div>
               </div>
            </div>
        </div>
    </div>


</div>



@endsection

@push('js')
    
    <script type="text/javascript">
        window.onload = function () {
            var chart7 = new CanvasJS.Chart("chartContainer7", {
            animationEnabled: true,  
            title:{

            },

            axisY: {             
                lineColor:"transparent",
                tickLength:10,
                tickThickness: 0,
                gridColor:"transparent",
                margin:20,
                labelFormatter: function(e){
                    return  ""
                }

            },
            axisX: {             
                lineColor:"transparent",
                tickLength:10,
                tickThickness: 0,
                labelFormatter: function(e){
                        return  ""
                    }
            },
            data: [{
                markerType:"none",
                xValueFormatString: "YYYY",
                type: "spline",
                color:"#465AFF",
                showInLegend: false,
                legendText: "2010",
                name: "Income",
                dataPoints: [
                    {x: new Date(2014, 0), y: 210},
                    {x: new Date(2015, 0), y: 190},
                    {x: new Date(2016, 0), y: 400},
                    {x: new Date(2017, 0), y:250},
                    {x: new Date(2018, 0), y: 310},
                    {x: new Date(2019, 0), y: 280},
                    {x: new Date(2020, 0), y: 400},
                    {x: new Date(2021, 0), y: 150},
                    {x: new Date(2022, 0), y: 210}
                ]
            },
                   {
                markerType:"none",
                xValueFormatString: "YYYY",
                type: "spline",
                color:"#FF326E",
                dataPoints: [
                    {x: new Date(2014, 0), y: 400},
                    {x: new Date(2015, 0), y: 250},
                    {x: new Date(2016, 0), y: 190},
                    {x: new Date(2017, 0), y:300},
                    {x: new Date(2018, 0), y: 340},
                    {x: new Date(2019, 0), y: 150},
                    {x: new Date(2020, 0), y: 150},
                    {x: new Date(2021, 0), y: 300},
                    {x: new Date(2022, 0), y: 280}
                ]
            }
                  ]
            });
            chart7.render();
            var chart3 = new CanvasJS.Chart("chartContainer3", {
                animationEnabled: true,  
                title:{

                },

                 axisY: {             
                    gridColor:"#9DB1BC",
                    gridThickness: 1,
                    lineColor:"transparent",
                    tickLength:10,
                    tickThickness: 0,
                    margin:20,

                  },
                  axisX: {             
                    lineColor:"transparent",
                    tickLength:10,
                    tickThickness: 0,
                  },
                data: [{
                    markerType:"none",
                    xValueFormatString: "YYYY",
                    type: "spline",
                    color:"#465AFF",
                    showInLegend: false,
                    legendText: "2010",
                    name: "Income",
                    dataPoints: [
                        {x: new Date(2014, 0), y: 210},
                        {x: new Date(2015, 0), y: 190},
                        {x: new Date(2016, 0), y: 400},
                        {x: new Date(2017, 0), y:250},
                        {x: new Date(2018, 0), y: 310},
                        {x: new Date(2019, 0), y: 280},
                        {x: new Date(2020, 0), y: 400},
                        {x: new Date(2021, 0), y: 150},
                        {x: new Date(2022, 0), y: 210}
                    ]
                },
                       {
                    markerType:"none",
                    xValueFormatString: "YYYY",
                    type: "spline",
                    color:"#FF326E",
                    dataPoints: [
                        {x: new Date(2014, 0), y: 400},
                        {x: new Date(2015, 0), y: 250},
                        {x: new Date(2016, 0), y: 190},
                        {x: new Date(2017, 0), y:300},
                        {x: new Date(2018, 0), y: 340},
                        {x: new Date(2019, 0), y: 150},
                        {x: new Date(2020, 0), y: 150},
                        {x: new Date(2021, 0), y: 300},
                        {x: new Date(2022, 0), y: 280}
                    ]
                }
                      ]
            });
            chart3.render();
            var chart = new CanvasJS.Chart("chartContainer",
            {
                animationEnabled: true,
           
                axisY:{
                    gridDashType: "dot",
                    gridColor:"#E3E7E7",
                    gridThickness: 1,
                    margin: 20,
                    lineColor:"#E3E7E7",
                    tickLength:10,
                    tickThickness:0,
                    margin:20,

                },
                axisX:{
                    lineColor:"transparent",
                    tickLength:10,
                    tickThickness:0,
                },
               data: [
              
                {
                    type: "column",
                    color: "#6BD4FD",        // change color here
                    dataPoints: [
                    { x: 1, y: 71 },
                    { x: 2, y: 55},
                    { x: 3, y: 50 },
                    { x: 4, y: 65 },
                    { x: 5, y: 95 },
                    { x: 6, y: 68 },
                    { x: 7, y: 28 },
                    { x: 8, y: 34 },
                    { x: 9, y: 14}

                    ]
                },
                {
                    type: "line",
                    color:"#00577A",
                    dataPointWidth: 20,
                    dataPoints: [
                        { x: 0, y: 40,color:"#FF2C55"  },
                        { x: 1, y: 71 ,color:"#FF2C55" },
                        { x: 2, y: 55,color:"#FF2C55" },
                        { x: 3, y: 50 ,color:"#FF2C55" },
                        { x: 4, y: 65 ,color:"#FF2C55" },
                        { x: 5.2, y: 95,color:"#FF2C55"  },
                        { x: 6, y: 68,color:"#FF2C55"  },
                        { x: 7, y: 28 ,color:"#FF2C55" },
                        { x: 8, y: 34,color:"#FF2C55"  },
                        { x: 9, y: 14,color:"#FF2C55" }
                    ]
                },
              ]
            });

            chart.render();
            var chart4 = new CanvasJS.Chart("chartContainer4",
            {
              
              axisY: {             
                gridColor:"#E9E9E9",
                gridThickness: 1.5,
                lineColor:"#D9D9D9",
                tickLength:10,
                tickThickness: 0,
                margin:0,
                labelFormatter: function(e){
                        return  ""
                    }
              },
              axisX: {             
                gridColor:"#E9E9E9",
                gridThickness: 1.5,
                lineColor:"transparent",
                interlacedColor: "#F2F4F8",
                tickLength:10,
                tickThickness: 0,
                labelFormatter: function(e){
                        return  ""
                    }
            
              },
              data: [
              {
                markerType: "none", 
                color:"#FF336A",
                indexLabel: "{y}",
                indexLabelPlacement: "outside",  
                indexLabelOrientation: "horizontal",
                type: "line",
                showInLegend: false,
                dataPoints: [
                { x: 10, y: 20 },
                { x: 20, y: 30},
                { x: 30, y: 20 },
                { x: 40, y: 40 },
                { x: 50, y: 30 },
                { x: 60, y:60 },
                { x: 70, y: 40 },
                { x: 80, y:50 },
                { x: 90, y: 40}
                ]
              },
                {
                markerType: "none", 
                color:"#FFD027",
                indexLabel: "{y}",
                indexLabelPlacement: "outside",  
                indexLabelOrientation: "horizontal",
                type: "line",
                showInLegend: false,
                dataPoints: [
                { x: 10, y: 10 },
                { x: 20, y: 20},
                { x: 30, y: 30 },
                { x: 40, y: 20 },
                { x: 50, y: 50 },
                { x: 60, y:10 },
                { x: 70, y: 30 },
                { x: 80, y:20 },
                { x: 90, y:25}
                ]
              }
              ]
            });

            chart4.render();
            var chart5 = new CanvasJS.Chart("chartContainer5", {
            animationEnabled: true,
            title:{
                text: "",
                fontFamily: "arial black",
                fontColor: "#695A42"
            },
            axisY:{
                margin:20,
                gridColor: "#D7DEDE",
                lineColor:"transparent",
                tickLength:10,
                tickThickness: 0,
            },
             axisX:{
                lineColor:"transparent",
                tickLength:10,
                tickThickness: 0,
            },
            toolTip: {
                shared: true,
            },
            data: [{
                type: "stackedColumn",
                showInLegend: false,
                color: "#4FDAC0",
                name: "Q1",
                dataPoints: [
                    { y: 100.75, x: 5 },
                    { y: 90.57, x:10 },
                    { y: 10.64, x: 15},
                    { y: 50.97, x:30 },
                    { y: 120.42, x:35},
                    { y: 100.26, x: 40 },
                    { y: 70.26, x: 55},
                    { y: 30.26, x: 60},
                    { y: 80.26, x: 65},
                    { y: 40.26, x: 80},
                    { y: 60.26, x: 85},
                    { y: 98.26, x: 90},

                ]
                },
                {        
                    type: "stackedColumn",
                    showInLegend: false,
                    name: "Q2",
                    color: "#3FB0FD",
                    dataPoints: [
                        { y: 60.82, x: 5},
                        { y: 30.02, x: 10 },
                        { y: 50.80, x: 15},
                        { y: 30.11, x: 30 },
                        { y: 60.96, x: 35},
                        { y: 17.73, x: 40 },
                        { y: 21.5, x:55 },
                        { y: 20.26, x: 60},
                        { y: 9.26, x: 65},
                        { y: 3.26, x: 80},
                        { y: 16.26, x: 85},
                        { y: 20.26, x: 90},
                    ]
                },
                ]
            });
            chart5.render();
            var chart6 = new CanvasJS.Chart("chartContainer6", {
                animationEnabled: true,
                title:{
                    text: "",
                    fontFamily: "arial black",
                    fontColor: "#695A42"
                },
                axisY:{
                    margin:20,
                    gridColor: "#D7DEDE",
                    lineColor:"transparent",
                    tickLength:10,
                    tickThickness: 0,
                },
                 axisX:{
                    lineColor:"transparent",
                    tickLength:10,
                    tickThickness: 0,
                },
                toolTip: {
                    shared: true,
                },
                data: [{
                    type: "stackedColumn",
                    showInLegend: false,
                    color: "#FF8717",
                    name: "Q1",
                    dataPoints: [
                        { y: 100.75, x: 5 },
                        { y: 90.57, x:10 },
                        { y: 10.64, x: 15},
                        { y: 50.97, x:30 },
                        { y: 120.42, x:35},
                        { y: 100.26, x: 40 },
                        { y: 70.26, x: 55},
                        { y: 30.26, x: 60},
                        { y: 80.26, x: 65},
                        { y: 40.26, x: 80},
                        { y: 60.26, x: 85},
                        { y: 98.26, x: 90},

                    ]
                    },
                    {        
                        type: "stackedColumn",
                        showInLegend: false,
                        name: "Q2",
                        color: "#FFD027",
                        dataPoints: [
                            { y: 60.82, x: 5},
                            { y: 30.02, x: 10 },
                            { y: 50.80, x: 15},
                            { y: 30.11, x: 30 },
                            { y: 60.96, x: 35},
                            { y: 17.73, x: 40 },
                            { y: 21.5, x:55 },
                            { y: 20.26, x: 60},
                            { y: 9.26, x: 65},
                            { y: 3.26, x: 80},
                            { y: 16.26, x: 85},
                            { y: 20.26, x: 90},
                        ]
                    },
                    ]
            });
            chart6.render();
        }
        
        
 
    </script>
    <script src="{{ asset('white') }}/js/canvasjs.min.js"></script>
   
@endpush
