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
                <form action="/product/{{ $product->slug }}/insert" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-2">
                                <label for="" id="gambar"> Gambar Produk </label>
                                <input type="file" name="gambar" id="" class="form-control @error('gambar') is-invalid @enderror">
                                @error('gambar')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="isDefault" id="inlineCheckbox1" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Jadikan Default </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-2">
                                <label for="" id="description"> Description Produk </label>
                                <textarea id="ckeditor" name="description" id="" class="form-control"></textarea>
                                @error('description')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info"> Tambah </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection