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

@section('content')
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
                        <th>Catatan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Dibuat pada tanggal</th>
                        <th>Diupdate pada tanggal</th>
                        <th>Action</th>
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
                            <td>{{ $data->note }}</td>
                            <td>{{ date_format(date_create($data->start_date), 'd M Y') }}</td>
                            <td>{{ date_format(date_create($data->end_date), 'd M Y') }}</td>
                            <td>{{ date_format(date_create($data->created_at), 'd M Y H:i:s') }}</td>
                            <td>{{ date_format(date_create($data->updated_at), 'd M Y H:i:s') }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-{{ $data->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <div class="modal fade" id="modal-{{ $data->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Pengajuan - {{{ $data->name }}}</h4>
                                            </div>

                                            @if (Auth::user()->role == 'admin')
                                                <form action="{{ route('submission-list.update', $data->id) }}" id="quickForm" method="POST">
                                            @else
                                                <form action="{{ route('submission-list-approval.update', $data->id) }}" id="quickForm" method="POST">
                                            @endif

                                                @csrf
                                                @method('PUT')

                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Catatan</label>
                                                                <textarea class="form-control" name="note" rows="5" placeholder="Catatan ...">{{ $data->note }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Status :</label>
                                                                <select class="form-control select2bs4" name="status" style="width: 100%;">
                                                                    <option value="waiting" {{ $data->status === 'waiting' ? 'selected' : '' }}>
                                                                        Menunggu
                                                                    </option>
                                                                    <option value="approval" {{ $data->status === 'approval' ? 'selected' : '' }}>
                                                                        Di setujui
                                                                    </option>
                                                                    <option value="rejected" {{ $data->status === 'rejected' ? 'selected' : '' }}>
                                                                        Di tolak
                                                                    </option>
                                                                </select>
                                                            </div>
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

                                @if (Auth::user()->role == 'admin')
                                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id={{ $data->id }}>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @else
                                @endif
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
                            url: "{{ url('/admin/submission-list/delete/') }}" + id,
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
