@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Transaction</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Transaction</li>
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
                    <h4 class="card-title">Riwayat Transaksi</h4>
                    <!-- <a href="product/create" class="btn btn-info btn-sm"> Tambah Transaksi </a> -->
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tracking</th>
                            <th>Nama</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                        @forelse($transaction as $t)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td> <a href="transaction/{{ $t->id }}"> {{ $t->tracking }} </a></td>
                            <td>{{ $t->user->name }}</td>
                            <td>{{ $t->rupiah($t->transaction_total) }}</td>
                            <td>{{ $t->transaction_status }}</td>
                            <td>{{ $t->created_at->format('d F, Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <button data-bs-toggle="modal" data-bs-target="#edit{{ $t->id }}" class="btn btn-sm mx-1 btn-info"> <i class="fa-solid fa-pencil" style="font-size:13px;"></i> </button>
                                    <!-- Modal Hapus  -->
                                    <div class="modal fade" id="edit{{ $t->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <form action="transaction/{{ $t->id }}" method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Transaksi {{ $t->tracking }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <th> No Tracking </th>
                                                                    <td> {{ $t->tracking }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th> Email </th>
                                                                    <td> {{ $t->user->email }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th> Phone </th>
                                                                    <td> {{ $t->user->phone }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th> Alamat </th>
                                                                    <td> {{ $t->user->alamat }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th> Status Transaksi </th>
                                                                    <td> {{ $t->transaction_status }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <th> Pembelian Produk </th>
                                                                    <td>
                                                                        <table class="table-bordered table w-100">
                                                                            <tr>
                                                                                <th> Nama </th>
                                                                                <th> Tipe </th>
                                                                                <th> Harga </th>
                                                                            </tr>
                                                                            @php($totalHarga = 0)
                                                                            @foreach($t->detail as $d)
                                                                            <tr>
                                                                                <td> {{ $d->product->name }} x {{ $d->quantity }} </td>
                                                                                <td> {{ $d->product->type->name }} </td>
                                                                                <td> {{ $d->product->rupiah($d->product->price)}} x {{ $d->quantity }} </td>
                                                                                @php($totalHarga = $totalHarga + ($d->quantity * $d->product->price))
                                                                            </tr>
                                                                            @endforeach
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Total Harga</th>
                                                                    <td> {{ $t->rupiah($totalHarga) }} </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <a href="{{ route('transaction.status', $t->id) }}?status=PENDING" class="btn btn-warning"> Set Pending </a>
                                                    <a href="{{ route('transaction.status', $t->id) }}?status=SUCCESS" class="btn btn-success"> Set Success </a>
                                                    <a href="{{ route('transaction.status', $t->id) }}?status=FAILED" class="btn btn-danger"> Set Failed </a>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- End Modal Hapus -->
                                    <button data-bs-toggle="modal" data-bs-target="#hapus{{ $t->id }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" style="font-size:13px;"></i></button>
                                    <!-- Modal Hapus  -->
                                    <div class="modal fade" id="hapus{{ $t->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="transaction/{{ $t->id }}" method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Transaksi {{ $t->tracking }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        @csrf
                                                        @method('delete')
                                                        <div>
                                                            <p class="h4"> Apakah anda yakin ingin menghapus Transaksi {{ $t->tracking }} </p>
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
                            <td colspan="8" align="center"> Tidak ada data transaksi </td>
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