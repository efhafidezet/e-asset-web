@extends('adminlte::page')

@section('title', 'Penugasan')

@section('content_header')
<h1>Rekapitulasi</h1>
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
                            {{-- <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg">
                                Tambah Baru
                            </button> --}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Nama Peminjam</th>
                                    <th>Nama Aset</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Lokasi Saat Ini</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->assignment_name}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->asset_name}}</td>
                                    <td>{{$item->location_name}}</td>
                                    <td align="center">{{$item->borrow_date}}</td>
                                    <td align="center">
                                        @if ($item->return_date == "1970-01-01 00:00:00")
                                            -
                                        @else
                                            {{$item->return_date}}
                                        @endif
                                    </td>
                                    <td align="center">
                                        <a href="{{url('')}}/track/{{$item->borrow_id}}">
                                            <span class="badge bg-info">Lacak</span>
                                        </a>
                                    </td>
                                    <td align="center">
                                        @if ($item->assignment_status == 1)
                                        <span class="badge bg-success">Selesai</span>
                                        @else
                                        <span class="badge bg-warning">Berjalan</span>
                                        @endif
                                        {{-- <span class="badge bg-success">Selesai</span> --}}
                                    </td>
                                </tr>
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
