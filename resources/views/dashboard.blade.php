@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-body">
                   <div id="chartContainer" style="height: 200px; width: 100%;"></div>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-body">
                   <div id="chartContainer2" style="height: 200px; width: 100%;"></div>
               </div>
            </div>
         </div>

        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-body">
                   <div id="chartContainer3" style="height: 200px; width: 100%;"></div>
               </div>
            </div>
         </div>
          <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-body">
                   <div id="chartContainer4" style="height: 200px; width: 100%;"></div>
               </div>
            </div>
         </div>

         <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-body">
                     <div id="chartContainer5" style="height: 200px; width: 100%;"></div>
               </div>
            </div>
         </div>

         <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-body">
                     <div id="chartContainer6" style="height: 200px; width: 100%;"></div>
               </div>
            </div>
         </div>


  
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Completed Tasks</h5>
                    <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> 12,100K</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <div id="chartContainer2" style="height: 200px; width: 100%;">
                    </div>
                </div>
            </div>
        </div>

</div>



@endsection

@push('js')
    <script src="{{ asset('white') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>

    
      <script type="text/javascript">
  window.onload = function () {

    var chart4 = new CanvasJS.Chart("chartContainer4",
    {
      
      axisY: {             
        gridColor:"#E9E9E9",
        gridThickness: 1,
        lineColor:"transparent",
        tickLength:10,
        tickThickness: 0,
        margin:40,
        labelFormatter: function(e){
                return  ""
            }
      },
      axisX: {             
        gridColor:"#E9E9E9",
        gridThickness: 1,
        lineColor:"transparent",
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
    var chart2 = new CanvasJS.Chart("chartContainer2",
    {
      title:{
       text: "Marker Size Increased"
      },
      data: [
      {
        markerType:"none",
        markerSize: 20,
        type: "line",
        showInLegend: true,
        dataPoints: [

       { x: 10, y: 71 },
        { x: 20, y: 55},
        { x: 30, y: 50 },
        { x: 40, y: 65 },
        { x: 50, y: 95 },
        { x: 60, y: 68 },
        { x: 70, y: 28 },
        { x: 80, y: 34 },
        { x: 90, y: 14}
        ]
      }
      ]
    });
    var chart3 = new CanvasJS.Chart("chartContainer3", {
    animationEnabled: true,  
    title:{
        text: "Music Album Sales by Year"
    },

     axisY: {             
        gridColor:"#9DB1BC",
        gridThickness: 1,
        lineColor:"transparent",
        tickLength:10,
        tickThickness: 0,
        margin:40,

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
          margin: 40,
       
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
    chart2.render();

   var chart5 = new CanvasJS.Chart("chartContainer5", {
    animationEnabled: true,
    title:{
        text: "Google - Consolidated Quarterly Revenue",
        fontFamily: "arial black",
        fontColor: "#695A42"
    },
    axisY:{
        margin:40,
        gridColor: "#D7DEDE",
        lineColor:"transparent",
        tickLength:10,
        tickThickness: 0,
        margin:40,
    },
     axisX:{
        lineColor:"transparent",
        tickLength:10,
        tickThickness: 0,
    },
    toolTip: {
        shared: true,
        content: toolTipContent
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
        text: "Google - Consolidated Quarterly Revenue",
        fontFamily: "arial black",
        fontColor: "#695A42"
    },
    axisY:{
        margin:40,
        gridColor: "#D7DEDE",
        lineColor:"transparent",
        tickLength:10,
        tickThickness: 0,
        margin:40,
    },
     axisX:{
        lineColor:"transparent",
        tickLength:10,
        tickThickness: 0,
    },
    toolTip: {
        shared: true,
        content: toolTipContent
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


function toolTipContent(e) {
    var str = "";
    var total = 0;
    var str2, str3;
    for (var i = 0; i < e.entries.length; i++){
        var  str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\"> "+e.entries[i].dataSeries.name+"</span>: $<strong>"+e.entries[i].dataPoint.y+"</strong>bn<br/>";
        total = e.entries[i].dataPoint.y + total;
        str = str.concat(str1);
    }
    str2 = "<span style = \"color:DodgerBlue;\"><strong>"+(e.entries[0].dataPoint.x).getFullYear()+"</strong></span><br/>";
    total = Math.round(total * 100) / 100;
    str3 = "<span style = \"color:Tomato\">Total:</span><strong> $"+total+"</strong>bn<br/>";
    return (str2.concat(str)).concat(str3);
}


  }
  </script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endpush
