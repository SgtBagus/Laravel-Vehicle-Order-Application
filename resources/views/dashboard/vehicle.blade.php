@extends('dashboard.layouts.layout')
{{-- @include('sweetalert::alert') --}}

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
        <i class="fas fa-plus"></i> Create User
    </button>

    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah - Kendaraan</h4>
                </div>
                <form action="{{ route('vehicle.store') }}" id="quickForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nama Mobil" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nomor Plat Mobil</label>
                                    <input type="text" name="number_vechile" class="form-control" placeholder="Nomor Plat Mobil" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sisa Bensin</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="fuel" min="0" max="100" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Status Kendaraan :</label>
                                <select class="form-control select2bs4" name="status" style="width: 100%;">
                                    <option value="ready">
                                        Ready
                                    </option>
                                    <option value="onRent">
                                        Di Pinjam
                                    </option>
                                    <option value="notReady">
                                        Belum Ready
                                    </option>
                                </select>
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
    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nomor Plat Mobil</th>
                        <th>Sisa Bensin</th>
                        <th>Status</th>
                        <th>Dibuat Oleh</th>
                        <th>Diupdate Oleh</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->number_vechile }}</td>
                            <td>{{ $data->fuel }} %</td>
                            <td>
                                @if ($data->status == 'ready')
                                    <span class="badge badge-primary">Ready</span>
                                @elseif ($data->status == 'onRent')
                                    <span class="badge badge-warning">Di Pinjam</span>
                                @else
                                    <span class="badge badge-danger">Belum Ready</span>
                                @endif
                            </td>
                            <td>{{ $data->created_by }}</td>
                            <td>{{ $data->updated_by }}</td>
                            <td>{{ date_format(date_create($data->created_at), 'd M Y H:i:s') }}</td>
                            <td>{{ date_format(date_create($data->updated_at), 'd M Y H:i:s') }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#modal-{{ $data->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <div class="modal fade" id="modal-{{ $data->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit - {{{ $data->name }}}</h4>
                                            </div>
                                            <form action="{{ route('vehicle.update', $data->id) }}" id="quickForm" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" name="name" class="form-control" placeholder="Nama Mobil" value={{ $data->name }}>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Nomor Plat Mobil</label>
                                                                <input type="text" name="number_vechile" class="form-control" placeholder="Nomor Plat Mobil" value={{ $data->number_vechile }}>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Sisa Bensin</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="number" name="fuel" min="0" max="100" class="form-control" value={{ $data->fuel }}>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Status Kendaraan :</label>
                                                            <select class="form-control select2bs4" name="status" style="width: 100%;">
                                                                <option value="ready" {{ $data->status === 'ready' ? 'selected' : '' }}>
                                                                    Ready
                                                                </option>
                                                                <option value="onRent" {{ $data->status === 'onRent' ? 'selected' : '' }}>
                                                                    Di Pinjam
                                                                </option>
                                                                <option value="notReady" {{ $data->status === 'notReady' ? 'selected' : '' }}>
                                                                    Belum Ready
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-id={{ $data->id }}>
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
    <script src="{{ asset('/') }}plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('/') }}plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>


    <script src="{{ asset('/') }}plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ asset('/') }}plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="{{ asset('/') }}plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('/') }}plugins/sweetalert2/sweetalert2.min.js"></script>

    <script src="{{ asset('/') }}plugins/moment/moment.min.js"></script>
    <script src="{{ asset('/') }}plugins/daterangepicker/daterangepicker.js"></script>

    <script>
        $(document).ready(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

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
                    number_vechile: {
                        required: true,
                    },
                    fuel: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Tidak Boleh Kosong",
                    },
                    number_vechile: {
                        required: "Tidak Boleh Kosong",
                    },
                    fuel: {
                        required: "Tidak Boleh Kosong",
                    },
                    status: {
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

            $('.btn-delete').click(function() {
                Swal.fire({
                    title: 'Anda Yakin Ingin menghapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).attr('data-id');

                        $.ajax({
                            type: 'DELETE',
                            url: "{{ url('/admin/vehicle/delete/') }}" + id,
                            dataType: 'JSON',
                            data: {
                                'id': id,
                                '_token': '{{ csrf_token() }}',
                            },
                            success: function(data) {
                                if (data.success) {
                                    swal.fire({
                                        title: "Terhapus!",
                                        text: "Data Tersebut Berhasil di Hapus!",
                                        icon: "success",
                                    }).then(function() {
                                        location.reload();
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'GAGAL!',
                                    'Terjadi Kesalahan',
                                    'error'
                                )
                            }
                        });
                    }
                })
            });
        });
    </script>
@endpush
