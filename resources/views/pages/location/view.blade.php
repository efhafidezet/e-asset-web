@extends('adminlte::page')

@section('title', 'Penugasan')

@section('content_header')
<h1>Lokasi</h1>
@stop

@section('content')
<style>
    .modal { z-index: 1001 !important;} 
    .modal-backdrop {z-index: 1000 !important;}
    .pac-container {z-index: 1055 !important;}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyuhSR2JKeiomWn1hEgvrFdLlEoya_imY&libraries=places&language=id"></script>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <form class="form-horizontal" method="POST" action="{{url('')}}/mahasiswa/hp">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="nim" value="{{ $item->nim }}">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-3 col-form-label">No Handphone</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputName" placeholder="" name="no_handphone" value=""/>
                                        @error('mUnique')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-danger" style="float: right;">Simpan</button>
                            </div>
                        </form> --}}

                        <div class="card-tools">
                            <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg">
                                Tambah Baru
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {{-- <div id="inputcontainer">
                            <input type="text" name="input0" id="input0" onkeyup="addInput();" />
                        </div> --}}

                        <script>
                            var currentindex = 0;
                            function addInput(){
                                var lastinput = document.getElementById('input'+currentindex);
                                if(lastinput.value != ''){
                                    var container = document.getElementById('inputcontainer');
                                    var newinput = document.createElement('input');
                                    currentindex++;
                                    newinput.type = "text";
                                    newinput.name = 'input'+currentindex;
                                    newinput.id = 'input'+currentindex;
                                    newinput.autocomplete = 'on';
                                    autocomplete1 = new google.maps.places.Autocomplete((document.getElementById('input'+currentindex)), {
                                        componentRestrictions: {
                                            country: "ID"
                                        }
                                    });
                                    google.maps.event.addListener(autocomplete1, 'place_changed', function() {
                                        var near_place = autocomplete.getPlace();
                                    });
                                    newinput.onkeyup = addInput;
                                    container.appendChild(newinput);
                                }
                            }
                        </script>

                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No</th>
                                    <th>Nama Lokasi</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>URL</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$item->location_name}}</td>
                                        <td>{{$item->latitude}}</td>
                                        <td>{{$item->longitude}}</td>
                                        <td align="center">
                                            <a href="http://maps.google.com/?q={{$item->latitude}},{{$item->longitude}}" target="_blank" rel="noopener noreferrer">
                                                Google Maps
                                            </a>
                                        </td>
                                        <td align="center">
                                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-update-data-{{$item->location_id}}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete-data-{{$item->location_id}}">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    <script type="text/javascript">
                                        /* Google Maps Search handler */
                                        var searchInput{{$item->location_id}} = 'search_input{{$item->location_id}}';
                                        $(document).ready(function() {
                                            var autocomplete;
                                            autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput{{$item->location_id}})), {
                                                types: ['geocode'],
                                                componentRestrictions: {
                                                    country: "ID"
                                                }
                                            });
                                        
                                            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                                                var near_place = autocomplete.getPlace();
                                                document.getElementById('loc_lat{{$item->location_id}}').value = near_place.geometry.location.lat();
                                                document.getElementById('loc_long{{$item->location_id}}').value = near_place.geometry.location.lng();
                                            });
                                        });
                                    </script>
                                    <div class="modal fade" id="modal-update-data-{{$item->location_id}}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Ubah Lokasi</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="form-horizontal" method="POST" action="{{url('')}}/location/update">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="inputName" class="col-sm-4 col-form-label">Nama Lokasi</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="search_input{{ $item->location_id }}" placeholder="" name="location_name" value="{{$item->location_name}}" required/>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="location_id" value="{{ $item->location_id }}">
                                                        <input type="hidden" class="form-control" id="loc_lat{{ $item->location_id }}" placeholder="" name="latitude" value="{{ $item->latitude }}" required/>
                                                        <input type="hidden" class="form-control" id="loc_long{{ $item->location_id }}" placeholder="" name="longitude" value="{{ $item->longitude }}" required/>
                                                        <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <div class="modal fade" id="modal-delete-data-{{$item->location_id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Lokasi</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="form-horizontal" method="POST" action="{{url('')}}/location/delete">
                                                    @csrf
                                                    <div class="card-body">
                                                        Anda yakin ingin menghapus data <br>
                                                        {{$item->location_name}}?
                                                        <hr>
                                                        <input type="hidden" name="location_id" value="{{ $item->location_id }}">
                                                        <button type="submit" class="btn btn-danger" style="float: right;">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<script type="text/javascript">
    /* Google Maps Search handler */
    var searchInput = 'search_input';
    $(document).ready(function() {
        var autocomplete;
        autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
            // types: ['geocode'],
            componentRestrictions: {
                country: "ID"
            }
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var near_place = autocomplete.getPlace();
            document.getElementById('loc_lat').value = near_place.geometry.location.lat();
            document.getElementById('loc_long').value = near_place.geometry.location.lng();
        });
    });
</script>

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Lokasi Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{url('')}}/location">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nama Lokasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="search_input" placeholder="" name="location_name" value="" required/>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Latitude</label>
                        <div class="col-sm-8">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Longitude</label>
                        <div class="col-sm-8">
                        </div>
                    </div> --}}
                    <input type="hidden" class="form-control" id="loc_lat" placeholder="" name="latitude" value="" required/>
                    <input type="hidden" class="form-control" id="loc_long" placeholder="" name="longitude" value="" required/>
                    <input type="hidden" class="form-control" id="is_active" placeholder="" name="is_active" value="1" required/>
                    <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
                    {{-- <div class="md-form ml-0 mr-0">
                        <div class="form-group">
                            <label>Lokasi:</label>
                            <input type="text" class="form-control" id="search_input" placeholder="Αναζήτηση διεύθυνσης..." />
                            <input type="hidden" id="loc_lat" />
                            <input type="hidden" id="loc_long" />
                        </div>
                        <!-- Display latitude and longitude -->
                        <div class="latlong-view">
                            <p style="text-align: center;">
                                <b>Latitude:</b>
                                <span id="latitude_view"></span>
                                <b>| Longitude:</b>
                                <span id="longitude_view"></span>
                            </p>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-cyan waves-effect waves-light" onclick="goTo()" style=" font-size: 1.2rem;">
                            <i class="fa fa-search ml-1"></i>
                        </button>
                    </div> --}}
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!'); 
</script>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        //Initialize Select2 Elements
        $('.select2').select2()
    
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()
    
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
            format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
            ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
            },
            function (start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )
    
        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })
        
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()
    
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
    
        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });
    
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
  
    })
</script>
@stop
