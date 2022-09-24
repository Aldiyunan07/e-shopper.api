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
                <form action="/product" method="post">
                    @csrf
                    @method('post')
                    @include('components.form_product')
                    <button type="submit" class="btn btn-info"> Tambah </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection