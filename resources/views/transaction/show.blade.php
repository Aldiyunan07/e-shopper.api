@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Detail Transaksi </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="/transaction"> Transaksi </a> </li>
                    <li class="breadcrumb-item active">Detail Transaksi</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-7">
        @foreach($detail as $p)
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="p-3">
                        @foreach($p->product->gallery->take(1) as $g)
                            <img src="{{ $g->gambar }}" height="150px" alt="">
                        @endforeach
                    </div>
                    <div class="mx-3">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tr>
                                    <td> Name </td>
                                    <td> {{ $p->product->name }} </td>
                                </tr>
                                <tr>
                                    <td> Harga </td>
                                    <td> {{ $p->product->rupiah($p->product->price) }} </td>
                                </tr>
                                <tr>
                                    <td> Tipe </td>
                                    <td> {{ $p->product->type->name }} </td>
                                </tr>
                                <tr>
                                    <td> Brand </td>
                                    <td> {{ $p->product->brand->name }} </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <div class="h5 p-1">
                    Total Harga
                </div>
                <hr/>
                @php($totalHarga = 0)
                @foreach($detail as $d)
                <div class="d-flex p-1 justify-content-between">
                    <p class="h6" > {{ $d->product->name }} {{ $d->quantity }} x </p>
                    <p class="h6"> {{ $d->product->rupiah($d->quantity * $d->product->price) }} </p>
                    @php($totalHarga = $totalHarga + ($d->quantity * $d->product->price))
                </div>
                @endforeach
                <hr/>
                <div class="d-flex p-1 justify-content-between">
                    <p class="h6"> Total Harga </p>
                    <p class="h6"> {{ $transaction->rupiah($totalHarga) }} </p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="h5 p-1">
                    Informasi Bank
                </div>
                <hr>
                <div class="d-flex p-1 justify-content-between">
                    <div>
                        <p class="h-6"> Bank </p>
                        <p class="h-6"> No Rekening </p>
                        <p class="h-6"> Total Transfer </p>
                    </div>    
                    <div>
                        <p class="h-6"> {{ $transaction->bank }} </p>
                        <p class="h-6"> {{ $transaction->rekening }} </p>
                        <p class="h-6"> {{ $transaction->rupiah($transaction->transaction_total) }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection