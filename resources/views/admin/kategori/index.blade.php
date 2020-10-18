@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> REFRESH</button>

                <a type="button" class="btn btn-sm btn-primary modal-show mb-2" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-square"></i> TAMBAH KATEGORI</a>
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered table-sm" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah data -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kategori.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group {{ $errors->has('nama') ? ' has->error ' : '' }}">
                        <label for="nama">Nama :</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kategori" value="{{ old('nama') }}">

                        @if($errors->has('nama'))
                        <span class=" help-block">{{ $errors->first('nama') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('kode') ? ' has->error ' : '' }}">
                        <label for="kode">Kode :</label>
                        <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Kategori" value="{{ old('kode') }}">

                        @if($errors->has('kode'))
                        <span class=" help-block">{{ $errors->first('kode') }}</span>
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary add" id="modal-btn-save">TAMBAH</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Ubah data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Ubah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    //Tombol Refresh
    $(document).ready(function() {

        // btn refresh
        $('.btn-refresh').click(function(e) {
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })

    });

    $(document).ready(function() {
        $('#datatable').DataTable({
            processing: true,
            serverside: true,
            responsive: true,
            ajax: {
                url: "{{ route('kategori.index') }}",
                type: "GET",
                dataType: "JSON"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'Aksi',
                    name: 'Aksi'
                }
            ]
        });
    });


    //Edit Data
    $(document).on('click', '.edit', function(event) {
        // console.log($(this).data('id'));
        event.preventDefault();
        const data_id = $(this).data('id');

        $.ajax({
            url: `kategori/${data_id}/edit`,
            method: 'GET',
            success: function(response) {
                $('#editModal').find('.modal-body').html(response);
                $('#editModal').modal('show');
            },
            error: function(errors) {
                console.log(errors);
            }
        });
    });

    $(document).on('click', '#btn-ubah', function(event) {
        event.preventDefault();
        const form_id = $('input[id=id_data]').val();
        const form_data = $('#form-edit').serialize();

        $.ajax({
            url: `kategori/${form_id}`,
            method: 'PUT',
            data: form_data,
            success: function(response) {
                $('#editModal').modal('hide');
                $('#datatable').DataTable().ajax.reload();

                //Notifikasi Toastr
                toastr.options = {
                    "closeButton": true,
                    "debug": true,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": true,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr["success"]("Data kategori berhasil diubah!", "sukses")

            },
            error: function(errors) {
                console.log(errors);
            }
        });
    });


    //Hapus Data
    $(document).on('click', '.delete', function(event) {
        event.preventDefault();
        const kategori_id = $(this).attr('kategori-id');
        const kategori_nama = $(this).attr('kategori-nama');

        swal({
                title: "Yakin?",
                text: "Data kategori " + kategori_nama + " akan dihapus ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "kategori/" + kategori_id,
                        type: "POST",
                        data: {
                            '_method': 'DELETE',
                            'id': kategori_id,
                        },
                        success: function(response) {
                            $('#datatable').DataTable().ajax.reload();

                            //Notifikasi Toastr
                            toastr.options = {
                                "closeButton": true,
                                "debug": true,
                                "newestOnTop": true,
                                "progressBar": true,
                                "positionClass": "toast-bottom-right",
                                "preventDuplicates": true,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr["success"]("Data kategori berhasil di hapus!", "sukses")

                            //Notifikasi Sweetalert
                            // swal({
                            //     type: 'success',
                            //     icon: 'success',
                            //     title: 'Success!',
                            //     text: 'Data berhasil di hapus!'
                            // });
                        },
                        error: function(xhr) {
                            swal({
                                type: 'error',
                                icon: 'error',
                                title: 'Oops...!',
                                text: 'Data gagal di delete!'
                            });
                        }
                    })
                }
            });
    });
</script>

@endsection