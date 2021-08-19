@extends('adminlte::page')

@section('title', 'Aset Perusahaan')

@section('content_header')
<h1>Aset Perusahaan</h1>
@stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg">
                                Tambah Baru
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No</th>
                                    <th>Nama Aset</th>
                                    <th>Jenis</th>
                                    <th>Tahun</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->asset_name." - ".$item->asset_unique}}</td>
                                    <td>@if ($item->asset_type == "1")
                                        Kendaraan
                                    @else
                                        Ponsel
                                    @endif</td>
                                    <td>{{$item->asset_year}}</td>
                                    <td align="center">
                                        @if ($item->asset_status == 1)
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Tersedia</span>
                                        @endif
                                    </td>
                                    <td align="center">
                                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-update-data-{{$index+1}}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete-data-{{$index+1}}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-update-data-{{$index+1}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Aset</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="form-horizontal" method="POST" action="{{url('')}}/asset/update">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label">Nama Aset</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="" placeholder="" name="asset_name" value="{{$item->asset_name}}" required/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label">Jenis Aset</label>
                                                        <div class="col-sm-8">
                                                            <select name="asset_type" id="" class="form-control">
                                                                <option value="1">Kendaraan</option>
                                                                <option value="2">Ponsel</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label">Tahun Aset</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="" placeholder="" name="asset_year" value="{{$item->asset_year}}" required/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label">Keunikan</label>
                                                        <div class="col-sm-8">
                                                            <textarea class="form-control" name="asset_unique" rows="5">{{$item->asset_unique}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label">Status</label>
                                                        <div class="col-sm-8">
                                                            <select name="asset_status" id="" class="form-control">
                                                                @if ($item->asset_status == 1)
                                                                    <option value="1" selected>Tersedia</option>
                                                                    <option value="0">Tidak Tersedia</option>
                                                                @else
                                                                    <option value="1">Tersedia</option>
                                                                    <option value="0" selected>Tidak Tersedia</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="form-control" id="" placeholder="" name="asset_id" value="{{$item->asset_id}}" required/>
                                                    <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <div class="modal fade" id="modal-delete-data-{{$index+1}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Aset</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="form-horizontal" method="POST" action="">
                                                @csrf
                                                <div class="card-body">
                                                    Anda yakin ingin menghapus data <br>
                                                    {{$item->asset_name}} - {{$item->asset_unique}}?
                                                    <hr>
                                                    <input type="hidden" name="assignment_id"
                                                        value="{{ $item->asset_id }}">
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
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Aset Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{url('')}}/asset">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Nama Aset</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="" placeholder="" name="asset_name" value="" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Jenis Aset</label>
                        <div class="col-sm-8">
                            <select name="asset_type" id="" class="form-control">
                                <option value="1">Kendaraan</option>
                                <option value="2">Ponsel</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Tahun Aset</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="" placeholder="" name="asset_year" value="" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Keunikan</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="asset_unique" rows="5"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
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
<script>
    console.log('Hi!'); 
</script>
@stop
