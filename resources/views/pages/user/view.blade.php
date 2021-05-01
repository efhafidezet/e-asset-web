@extends('adminlte::page')

@section('title', 'Pengguna')

@section('content_header')
<h1>Pengguna</h1>
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
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            @if ($item->role == 1)
                                                Administrator
                                            @elseif ($item->role == 2)
                                                Manajer Operasional
                                            @else
                                                Peminjam
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if ($item->is_active == 1)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Non Aktif</span>
                                            @endif
                                            </td>
                                        <td align="center">
                                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-update-data-{{$item->id}}">
                                                Edit
                                            </button>
                                            {{-- <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete-data-{{$item->id}}">
                                                Hapus
                                            </button> --}}
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-update-data-{{$item->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Ubah Pengguna</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="form-horizontal" method="POST" action="{{url('')}}/user/update">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="inputName" class="col-sm-4 col-form-label">Nama Pengguna</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="inputName" placeholder="" name="name" value="{{$item->name}}" required/>
                                                                {{-- @error('mName')
                                                                    <span class="text-danger" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror --}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputName" class="col-sm-4 col-form-label">Email</label>
                                                            <div class="col-sm-8">
                                                                <input type="email" class="form-control" id="inputName" placeholder="" name="email" value="{{$item->email}}" required/>
                                                                {{-- @error('mName')
                                                                    <span class="text-danger" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror --}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputName" class="col-sm-4 col-form-label">Kata Sandi</label>
                                                            <div class="col-sm-8">
                                                                <input type="password" class="form-control" id="" placeholder="" name="password" value=""/>
                                                                {{-- @error('mName')
                                                                    <span class="text-danger" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror --}}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputName" class="col-sm-4 col-form-label">Role</label>
                                                            <div class="col-sm-8">
                                                                <select name="role" id="" class="form-control">
                                                                    @if ($item->role == 1)
                                                                        <option value="1" selected>Administrator</option>
                                                                        <option value="2">Manajer Operasional</option>
                                                                        <option value="3">Peminjam</option>     
                                                                    @elseif ($item->role == 2)
                                                                        <option value="1">Administrator</option>
                                                                        <option value="2" selected>Manajer Operasional</option>
                                                                        <option value="3">Peminjam</option>
                                                                    @else
                                                                        <option value="1">Administrator</option>
                                                                        <option value="2">Manajer Operasional</option>
                                                                        <option value="3" selected>Peminjam</option>
                                                                    @endif
                                                                    {{-- {{$item->role}} --}}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputName" class="col-sm-4 col-form-label">Status</label>
                                                            <div class="col-sm-8">
                                                                <select name="is_active" id="" class="form-control">
                                                                    @if ($item->is_active == 0)
                                                                        <option value="1">Aktif</option>
                                                                        <option value="0" selected>Non Aktif</option>
                                                                    @else
                                                                        <option value="1" selected>Aktif</option>
                                                                        <option value="0">Non Aktif</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" class="form-control" id="inputName" placeholder="" name="user_id" value="{{$item->id}}" required/>
                                                        <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <div class="modal fade" id="modal-delete-data-{{$item->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Pengguna</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form class="form-horizontal" method="POST" action="">
                                                    @csrf
                                                    <div class="card-body">
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
                <h4 class="modal-title">Tambah Pengguna Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{url('')}}/user">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Nama Pengguna</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputName" placeholder="" name="name" value="" required/>
                            {{-- @error('mName')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="inputName" placeholder="" name="email" value="" required/>
                            {{-- @error('mName')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Kata Sandi</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="" placeholder="" name="password" value="" required/>
                            {{-- @error('mName')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Role</label>
                        <div class="col-sm-8">
                            <select name="role" id="" class="form-control">
                                <option value="1">Administrator</option>
                                <option value="2">Manajer Operasional</option>
                                <option value="3">Peminjam</option>
                            </select>
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
