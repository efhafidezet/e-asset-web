@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content') {{--
<p>Welcome to this beautiful admin panel.</p>
--}}

<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1">
                <i class="fas fa-cog"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Penugasan Selesai</span>
                <span class="info-box-number"> {{count($dataAssignmentDone)}}<small></small> </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1">
                <i class="fas fa-cog"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Sedang Berjalan</span>
                <span class="info-box-number">{{count($dataAssignmentRunning)}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1">
                <i class="fas fa-cog"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Jumlah Penugasan</span>
                <span class="info-box-number">{{count($dataAssignment)}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1">
                <i class="fas fa-cog"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Jumlah Aset</span>
                <span class="info-box-number">{{count($dataAsset)}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

{{-- <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div id="map"></div>
            <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyuhSR2JKeiomWn1hEgvrFdLlEoya_imY&callback=initMap&libraries=&v=weekly" async></script>
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Penugasan Tersedia</h3>
                    <a href="javascript:void(0);">Lebih Rinci</a>
                </div>
            </div>
            <div class="card-body">
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                {{-- <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div> --}}
            </div>
        </div>
        {{-- <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
        </div> --}}
        <!-- /.nav-tabs-custom -->
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Penugasan Tersedia</h3>
                    <a href="javascript:void(0);">Lebih Rinci</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Nama</th>
                            <th style="">Tanggal</th>
                            {{-- <th style="width: 175px;">Tanggal</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Survei Sanitasi PNJ</td>
                            <td>
                                <div class="text-muted">3 Maret 2021</div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kelayakan Sungai 'X'</td>
                            <td>
                                <div class="text-muted">1 Maret 2021</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Penugasan <span class="text-muted">Berjalan</span></h3>
                    <a href="javascript:void(0);">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Nama</th>
                            <th style="width: ;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Survei Sanitasi PNJ</td>
                            <td align=""><span class="badge bg-warning" style="color: white;">Lacak</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Survei Sanitasi Kota Bogor</td>
                            <td align=""><span class="badge bg-success">Lacak</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Kelayakan Sungai 'X'</td>
                            <td align=""><span class="badge bg-gray">Lacak</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.card -->
    </div>
</div>


<!-- /.row -->
@stop

@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css" /> --}}
<style type="text/css">
    /* Set the size of the div element that contains the map */
    #map {
        height: 300px;
        width: 100%;
        border-radius: 5px;
    }

</style>
<script>
    // Initialize and add the map
    function initMap() {
        // The location of depok
        const depok = {
            lat: -6.3648792,
            lng: 106.8283323
        };
        // The map, centered at depok
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: depok,
        });
        // const marker = new google.maps.Marker({
        //     position: depok,
        //     map: map,
        // });
    }

</script>
@stop

@section('js')
<script>
    console.log("Hi!");
</script>
<!-- Morris.js charts -->
<script src="https://adminlte.io/themes/AdminLTE/bower_components/raphael/raphael.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/morris.js/morris.min.js"></script>
<script>
    /* Morris.js Charts */
  // Sales chart
  var area = new Morris.Area({
    element   : 'revenue-chart',
    resize    : true,
    data      : [
    //   { y: '2011 Q1', item1: 3, item2: 1 , item3: 2 },
    //   { y: '2011 Q2', item1: 2, item2: 4 , item3: 2 },
      { y: '2011 Q3', item1: 4912, item2: 1969 },
      { y: '2011 Q4', item1: 3767, item2: 3597 },
      { y: '2012 Q1', item1: 6810, item2: 1914 },
      { y: '2012 Q2', item1: 5670, item2: 4293 },
    //   { y: '2012 Q3', item1: 4820, item2: 3795 },
    //   { y: '2012 Q4', item1: 15073, item2: 5967 },
    //   { y: '2013 Q1', item1: 10687, item2: 4460 },
    //   { y: '2013 Q2', item1: 8432, item2: 5713 }
    ],
    xkey      : 'y',
    ykeys     : ['item1', 'item2', 'item3'],
    labels    : ['Item 1', 'Item 2', 'item3'],
    lineColors: ['#a0d0e0', '#3c8dbc', '#3c8dbc'],
    hideHover : 'auto'
  });
  var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [
      { y: '2011 Q1', item1: 2666 },
      { y: '2011 Q2', item1: 2778 },
      { y: '2011 Q3', item1: 4912 },
      { y: '2011 Q4', item1: 3767 },
      { y: '2012 Q1', item1: 6810 },
      { y: '2012 Q2', item1: 5670 },
      { y: '2012 Q3', item1: 4820 },
      { y: '2012 Q4', item1: 15073 },
      { y: '2013 Q1', item1: 10687 },
      { y: '2013 Q2', item1: 8432 }
    ],
    xkey             : 'y',
    ykeys            : ['item1'],
    labels           : ['Item 1'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });
</script>
@stop
