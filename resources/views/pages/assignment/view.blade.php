@extends('adminlte::page')

@section('title', 'Penugasan')

@section('content_header')
<h1>Penugasan</h1>
@stop

@section('content')
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
                                    <input type="text" class="form-control" id="inputName" placeholder=""
                                        name="no_handphone" value="" />
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
                            <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal"
                                data-target="#modal-lg">
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
                                    <th>Nama Penugasan</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>Keterangan</th>
                                    <th>Radius Toleransi</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->assignment_name}}</td>
                                    <td>{{date('d F Y', strtotime($item->assignment_date))}}</td>
                                    <td>{{$item->location_name}}</td>
                                    <td>{{$item->assignment_details}}</td>
                                    <td>{{$item->radius}}</td>
                                    <td align="center">
                                        @if ($item->assignment_status == 1)
                                        <span class="badge bg-success">Selesai</span>
                                        @else
                                        <span class="badge bg-warning">Berjalan</span>
                                        @endif
                                    </td>
                                    <td align="center">
                                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal"
                                            data-target="#modal-update-data-1">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                                            data-target="#modal-delete-data-1">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-update-data-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Penugasan</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="form-horizontal" method="POST"
                                                action="{{url('')}}/assignment/update">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-4 col-form-label">Nama
                                                            Penugasan</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="inputName"
                                                                placeholder="" name="assignment_name"
                                                                value="{{$item->assignment_name}}" required />
                                                            {{-- @error('mName')
                                                                <span class="text-danger" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror --}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-4 col-form-label">Tanggal
                                                            Penugasan</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control" id="inputName"
                                                                placeholder="" name="assignment_date"
                                                                value="{{date('Y-m-d', strtotime($item->assignment_date))}}" required />
                                                            {{-- @error('mName')
                                                                <span class="text-danger" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror --}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-4 col-form-label">Lokasi
                                                            Penugasan</label>
                                                        <div class="col-sm-8">
                                                            <select name="location_id" id="" class="form-control">
                                                                @foreach ($data1 as $index1 => $item1)
                                                                <option value="{{$item1->location_id}}" @if ($item->location_id == $item1->location_id) selected @endif>{{$item1->location_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            {{-- @error('mName')
                                                                <span class="text-danger" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror --}}
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-4 col-form-label">Radius
                                                            Toleransi</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id=""
                                                                placeholder="Dalam Kilometer" name="radius"
                                                                value="{{$item->radius}}" required />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName"
                                                            class="col-sm-4 col-form-label">Keterangan</label>
                                                        <div class="col-sm-8">
                                                            <textarea class="form-control" name="assignment_details"
                                                                rows="5">{{$item->assignment_details}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName"
                                                            class="col-sm-4 col-form-label">Status</label>
                                                        <div class="col-sm-8">
                                                            <select name="assignment_status" id="" class="form-control">
                                                                @if ($item->assignment_status == 0)
                                                                <option value="1">Selesai</option>
                                                                <option value="0" selected>Belum Tersedia</option>
                                                                @else
                                                                <option value="1" selected>Selesai</option>
                                                                <option value="0">Belum Tersedia</option>
                                                                @endif
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="assignment_id"
                                                        value="{{ $item->assignment_id }}">
                                                    <button type="submit" class="btn btn-primary"
                                                        style="float: right;">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <div class="modal fade" id="modal-delete-data-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Penugasan</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="form-horizontal" method="POST"
                                                action="{{url('')}}/assignment/delete">
                                                @csrf
                                                <div class="card-body">
                                                    <input type="hidden" name="assignment_id"
                                                        value="{{ $item->assignment_id }}">
                                                    <button type="submit" class="btn btn-danger"
                                                        style="float: right;">Hapus</button>
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
                <h4 class="modal-title">Tambah Penugasan Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{url('')}}/assignment">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Nama Penugasan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputName" placeholder="" name="assignment_name"
                                value="" required />
                            {{-- @error('mName')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Tanggal Penugasan</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="inputName" placeholder="" name="assignment_date"
                                value="" required />
                            {{-- @error('mName')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Lokasi Penugasan</label>
                        <div class="col-sm-8">
                            <select name="location_id" id="" class="form-control">
                                @foreach ($data1 as $index => $item)
                                <option value="{{$item->location_id}}">{{$item->location_name}}</option>
                                @endforeach
                            </select>
                            {{-- @error('mName')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Radius Toleransi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="" placeholder="Dalam Meter" name="radius"
                                value="" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="assignment_details" rows="5"></textarea>
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
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
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
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'))
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

        $('.my-colorpicker2').on('colorpickerChange', function (event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });

        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

    })

</script>
<script>
    console.log('Hi!');

</script>
@stop
