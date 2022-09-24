@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Produk {{ $product->name }} </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Produk Detail</li>
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
                    <h4 class="card-title">Daftar Gambar Produk</h4>
                    <a href="/product/{{$product->slug}}/tambah" class="btn btn-info btn-sm"> Tambah Gambar </a>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Photo</th>
                            <th>Default Photo</th>
                            <th>Deskripsi</th>
                            <th>Tanggal daftar</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
                        @forelse($gallery as $key => $g)
                        <tr align="center">
                            <td> {{ $no++ }} </td>
                            <td align="center"><img src="{{ $g->gambar}}" height="100px" alt=""></td>
                            <td> <span class="badge @if($g->isDefault) bg-success @else bg-danger @endif"> {{ $g->isDefault == 1 ? 'Default' : 'Not Default' }} </span></td>
                            <td>{!! $g->description !!}</td>
                            <td>{{ $g->created_at->format('d F, Y') }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="/product/{{ $product->id }}/{{ $g->id }}/delete" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" style="font-size:13px;"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" align="center"> Tidak ada data product </td>
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