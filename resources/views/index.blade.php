@extends('layouts.layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <link rel="stylesheet" href="{{ asset('/') }}plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@section('buttonHeader')
    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-create">
        <i class="fas fa-plus"></i> Tambah Pengajuan
    </button>

    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pengajuan</h4>
                </div>
                <form action="{{ route('store') }}" id="quickForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Pengaju</label>
                                    <input type="text" name="submission_name" class="form-control" placeholder="Nama Pengaju" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kendaraan yang ini di pinjam :</label>
                                    <select class="form-control select2bs4" name="vehicle_id" style="width: 100%;">
                                        @foreach ($cars as $car)
                                            <option value={{ $car->id }}>
                                                {{ $car->name }} - {{ $car->number_vechile }} - Sisa Bahan Bakar
                                                {{ $car->fuel }} %
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alasan</label>
                                    <textarea class="form-control" name="reason" rows="5" placeholder="Alasan ..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea class="form-control" name="note" rows="5" placeholder="Catatan ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Jangka waktu</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="rangeDate" class="form-control float-right" id="reservation">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengaju</th>
                                <th>Alasan</th>
                                <th>Nama Kendaraan</th>
                                <th>Status</th>
                                <th>Disetujui Oleh</th>
                                <th>Catatan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Dibuat pada tanggal</th>
                                <th>Diupdate pada tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $loop->index+1}}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->reason }}</td>
                                    <td>
                                        {{ $data->name_vechile }} - {{ $data->number_vechile }} - <b>Sisa Bahan Bakar {{ $data->fuel_vechile }} % </b>
                                    </td>
                                    <td>
                                        @if ($data->status == 'waiting')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif ($data->status == 'approval')
                                            <span class="badge badge-primary">Diterima</span>
                                        @else
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->approve_by }}</td>
                                    <td>{{ $data->note }}</td>
                                    <td>{{ date_format(date_create($data->start_date), 'd M Y') }}</td>
                                    <td>{{ date_format(date_create($data->end_date), 'd M Y') }}</td>
                                    <td>{{ date_format(date_create($data->created_at), 'd M Y H:i:s') }}</td>
                                    <td>{{ date_format(date_create($data->updated_at), 'd M Y H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>


    <script src="{{ asset('/') }}plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ asset('/') }}plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="{{ asset('/') }}plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>

    <script src="{{ asset('/') }}plugins/moment/moment.min.js"></script>
    <script src="{{ asset('/') }}plugins/daterangepicker/daterangepicker.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $('#reservation').daterangepicker();
            $('#customCheckbox1').click(function() {
                $('#last-mount-date-input').prop("disabled", this.checked).val("156289");
            });

            $('#quickForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    role: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Tidak Boleh Kosong",
                    },
                    email: {
                        required: "Tidak Boleh Kosong",
                    },
                    role: {
                        required: "Tidak Boleh Kosong",
                    },
                    password: {
                        required: "Tidak Boleh Kosong",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
