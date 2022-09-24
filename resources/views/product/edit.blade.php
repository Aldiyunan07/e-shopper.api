@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Produk {{ $product->name }} </h4>
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
                <form action="/product/{{ $product->id }}" method="post">
                    @csrf
                    @method('PUT')
                    @include('components.form_product')
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-info"> Simpan Perubahan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection