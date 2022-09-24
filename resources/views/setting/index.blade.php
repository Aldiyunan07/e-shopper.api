@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Setting</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Setting</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="setting-tab" data-bs-toggle="tab" data-bs-target="#setting" type="button" role="tab" aria-controls="setting" aria-selected="true">Pengaturan Aplikasi </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="type-tab" data-bs-toggle="tab" data-bs-target="#type" type="button" role="tab" aria-controls="type" aria-selected="false">Tipe Product @if($type->count() == null) <span class="badge bg-danger" > 1 </span> @endif</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="brand-tab" data-bs-toggle="tab" data-bs-target="#brand" type="button" role="tab" aria-controls="brand" aria-selected="false"> Brand Product @if($brand->count() == null) <span class="badge bg-danger" > 1 </span> @endif</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="type" role="tabpanel" aria-labelledby="type-tab">
                        <div class="p-3">
                            <div class="d-flex justify-content-between mb-3">
                                <div></div>
                                <div>
                                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success btn-sm"> Tambah Tipe </button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="type" method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tipe Produk</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        @csrf
                                                        @method('post')
                                                        <div class="form-group mb-3 mb-2">
                                                            <label for=""> Nama Tipe </label>
                                                            <input type="text" name="name" required autocomplete="off" class="form-control" id="">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for=""> Description </label>
                                                            <textarea name="description" required class="form-control"></textarea>
                                                        </div>
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" name="isOn" type="checkbox" value="1" id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                Jadikan Default?
                                                            </label>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th> No </th>
                                        <th> Nama </th>
                                        <th> Jenis </th>
                                        <th> Description </th>
                                        <th> Created At </th>
                                        <th> Action </th>
                                    </tr>
                                    @forelse($type as $key => $t)
                                        <tr>
                                            <td> {{ $type->firstItem() + $key }} </td>
                                            <td> {{ $t->name }} </td>
                                            <td align="center"> 
                                                <button type="button" 
                                                        class="btn btn-sm @if($t->isOn) btn-success @else btn-danger @endif" 
                                                        data-bs-toggle="popover" 
                                                        title="@if($t->isOn) Default @else Not Default @endif" 
                                                        data-bs-content="@if($t->isOn) Tipe yang akan di tampilkan di sidebar beranda @else Tipe yang tidak akan di tampilkan di sidebar beranda @endif">{{ $t->isOn == 1 ? 'Default' : 'Not Default' }}</button>
                                            </td>
                                            <td>
                                                @if(strlen($t->description) > 17)
                                                    {{ substr($t->description, 0, 17) }} ....
                                                @else
                                                    {{ $t->description }}
                                                @endif
                                            </td>
                                            <td> {{ $t->created_at->format('d F, Y') }} </td>
                                            <td align="center">
                                                <button data-bs-toggle="modal" data-bs-target="#edit{{ $t->id }}" class="btn btn-info btn-sm"> <i class="fa fa-pencil"></i> </button>
                                                <button data-bs-toggle="modal" data-bs-target="#hapus{{ $t->id }}" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                            </td>
                                            <!-- Modal Edit  -->
                                            <div class="modal fade" id="edit{{ $t->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="type/{{ $t->id }}" method="post">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Tipe {{ $t->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                                @csrf
                                                                @method('put')
                                                                <div class="form-group mb-2">
                                                                    <label for=""> Nama Tipe </label>
                                                                    <input type="text" name="name" required autocomplete="off" value="{{ $t->name }}" class="form-control" id="">
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for=""> Description </label>
                                                                    <textarea name="description" required class="form-control">{{ $t->description }}</textarea>
                                                                </div>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" name="isOn"  type="checkbox" value="1" @if($t->isOn) checked @endif id="flexCheckDefault">
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        Jadikan Default?
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- End Modal edit -->
                                            <!-- Modal Hapus  -->
                                            <div class="modal fade" id="hapus{{ $t->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="type/{{ $t->id }}" method="post">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Tipe {{ $t->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                                @csrf
                                                                @method('delete')
                                                            <p class="h4"> Apakah anda yakin ingin menghapus tipe {{ $t->name }} </p>
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
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" align="center"> Tipe tidak boleh kosong ! </td>
                                        </tr>
                                    @endforelse
                                    <!-- <div>
                                        {{ $type->links() }}
                                    </div> -->
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="brand" role="tabpanel" aria-labelledby="brand-tab">
                    <div class="p-3">
                            <div class="d-flex justify-content-between mb-3">
                                <div></div>
                                <div>
                                    <button data-bs-toggle="modal" data-bs-target="#brandModal" class="btn btn-success btn-sm"> Tambah Brand </button>
                                    <div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="brand" enctype="multipart/form-data" method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Brand Produk</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        @csrf
                                                        @method('post')
                                                        <div class="form-group mb-2">
                                                            <label for=""> Foto Brand </label>
                                                            <input type="file" name="photo" required autocomplete="off" class="form-control" id="">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for=""> Nama Brand </label>
                                                            <input type="text" name="name" required autocomplete="off" class="form-control" id="">
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for=""> Description </label>
                                                            <textarea name="description" required class="form-control"></textarea>
                                                        </div>
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" name="isOn" type="checkbox" value="1" id="flexCheckDefault">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                Jadikan Default?
                                                            </label>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th> No </th>
                                        <th> Logo </th>
                                        <th> Nama </th>
                                        <th> Jenis </th>
                                        <th> Created At </th>
                                        <th> Action </th>
                                    </tr>
                                    @forelse($brand as $key => $b)
                                        <tr>
                                            <td> {{ $brand->firstItem() + $key }} </td>
                                            <td align="center"> <img src="{{ $b->gambar }}" height="20px" alt=""> </td>
                                            <td> {{ $b->name }} </td>
                                            <td align="center"> 
                                                <button type="button" 
                                                        class="btn btn-sm @if($b->isOn) btn-success @else btn-danger @endif" 
                                                        data-bs-toggle="popover" 
                                                        title="@if($b->isOn) Default @else Not Default @endif" 
                                                        data-bs-content="@if($b->isOn) Brand yang akan di tampilkan di sidebar beranda @else Brand yang tidak akan di tampilkan di sidebar beranda @endif">{{ $b->isOn == 1 ? 'Default' : 'Not Default' }}</button>
                                            </td>
                                            <td> {{ $b->created_at->format('d F, Y') }} </td>
                                            <td align="center">
                                                <button data-bs-toggle="modal" data-bs-target="#editBrand{{ $b->id }}" class="btn btn-info btn-sm"> <i class="fa fa-pencil"></i> </button>
                                                <button data-bs-toggle="modal" data-bs-target="#hapusBrand{{ $b->id }}" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                            </td>
                                            <!-- Modal Edit  -->
                                            <div class="modal fade" id="editBrand{{ $b->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="brand/{{ $b->id }}" enctype="multipart/form-data" method="post">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Brand {{ $b->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                                <center>
                                                                    <div class="p-3">
                                                                        <img src="{{ $b->gambar }}" height="50px" alt="">
                                                                    </div>
                                                                </center>
                                                                @csrf
                                                                @method('put')
                                                                <div class="form-group mb-2">
                                                                    <label for=""> Foto Brand </label>
                                                                    <input type="file" name="photo" autocomplete="off" class="form-control" id="">
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for=""> Nama Tipe </label>
                                                                    <input type="text" name="name" required autocomplete="off" value="{{ $b->name }}" class="form-control" id="">
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for=""> Description </label>
                                                                    <textarea name="description" required class="form-control">{{ $b->description }}</textarea>
                                                                </div>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" name="isOn"  type="checkbox" value="1" @if($b->isOn) checked @endif id="flexCheckDefault">
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        Jadikan Default?
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- End Modal edit -->
                                            <!-- Modal Hapus  -->
                                            <div class="modal fade" id="hapusBrand{{ $b->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="type/{{ $b->id }}" method="post">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Tipe {{ $b->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                                @csrf
                                                                @method('delete')
                                                            <p class="h4"> Apakah anda yakin ingin menghapus tipe {{ $b->name }} </p>
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
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" align="center"> Brand tidak boleh kosong ! </td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="setting" role="tabpanel" aria-labelledby="setting-tab">
                        <div class="py-4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-4">
                                            <h6 class="mb-2"> Nama Aplikasi </h6>
                                            <hr>
                                            <h4> {{ $setting->name }} </h4>
                                        </div>

                                        <div class="mb-4">
                                            <h6 class="mb-2"> Logo Aplikasi </h6>
                                            <hr>
                                            <img src="{{ $setting->logos }}" alt="">
                                        </div>
                                        <div>
                                            <h6 class="mb-2"> Icon Aplikasi </h6>
                                            <hr>
                                            <img src="{{ $setting->icons }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <form action="setting/{{ $setting->id }}" enctype="multipart/form-data" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group mb-3 ">
                                                <label for=""> Nama aplikasi </label>
                                                <input type="text" value="{{ $setting->name }}" name="name" class="form-control" id="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for=""> Logo aplikasi </label>
                                                <input type="file" name="logo" class="form-control" id="">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for=""> Icon aplikasi </label>
                                                <input type="file" name="icon" class="form-control" id="">
                                            </div>
                                            <div class="form-group d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary"> Simpan Perubahan </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection