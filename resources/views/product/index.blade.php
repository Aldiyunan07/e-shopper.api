@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Produk</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Produk</li>
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
                    <h4 class="card-title">Daftar Produk</h4>
                    <a href="product/create" class="btn btn-info btn-sm"> Tambah Produk </a>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                        @forelse($product as $p)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td> <a href="{{ route('product.show', $p->id) }}"> {{ $p->name }} </a> </td>
                            <td>{{ $p->type->name }}</td>
                            <td>{{ $p->rupiah($p->price) }}</td>
                            <td>{{ $p->quantity }}</td>
                            <td>{{ $p->created_at->format('d F, Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('product.edit', $p->id) }}" class="btn btn-sm mx-1 btn-info"> <i class="fa-solid fa-pencil" style="font-size:13px;"></i> </a>
                                    <button data-bs-toggle="modal" data-bs-target="#hapus{{ $p->id }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" style="font-size:13px;"></i></button>
                                    <!-- Modal Hapus  -->
                                    <div class="modal fade" id="hapus{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="product/{{ $p->id }}" method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Product {{ $p->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        @csrf
                                                        @method('delete')
                                                        <div>
                                                            <p class="h4"> Apakah anda yakin ingin menghapus Product {{ $p->name }} </p>
                                                        </div>
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
                            <td colspan="8" align="center"> Tidak ada data product </td>
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