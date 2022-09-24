@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">User</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">User</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="card-title">Daftar User</h4>
                    <a href="/user/create" class="btn btn-success btn-sm"> Tambah User </a>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal daftar</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                        @forelse($user as $u)
                        <tr>
                            <td> {{ $no++ }} </td>
                            <td align="center"> <img src="{{ $u->gambar }}" height="70px" alt=""> </td>
                            <td> <a href="/user/{{ $u->id }}"> {{ $u->name }} </a></td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->role }}</td>
                            <td>{{ $u->created_at->format('d F, Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="/user/{{ $u->id }}/edit" class="btn btn-sm mx-1 btn-primary"> <i class="fa-solid fa-pencil" style="font-size:13px;"></i> </a>
                                    <button data-bs-toggle="modal" data-bs-target="#hapus{{ $u->id }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" style="font-size:13px;"></i></button>
                                    <!-- Modal Hapus  -->
                                    <div class="modal fade" id="hapus{{ $u->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="user/{{ $u->id }}" method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus User {{ $u->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        @csrf
                                                        @method('delete')
                                                    <p class="h4"> Apakah anda yakin ingin menghapus user {{ $u->name }} </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End Modal Hapus -->
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" text-align="center"> Tidak ada data user </td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection