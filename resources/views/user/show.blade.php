@extends('layouts.app')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0"> Detail User</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"> <a href="/user"> user </a> </li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div class="p-4 d-flex justify-content-center">
                    <img src="{{ asset('images/users/avatar-1.jpg') }}" class="rounde-circle rounded" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td> Nama </td>
                            <td> {{  $user->name }} </td>
                        </tr>
                        <tr>
                            <td> Email </td>
                            <td> {{  $user->email }} </td>
                        </tr>
                        <tr>
                            <td> Role </td>
                            <td> {{  $user->role }} </td>
                        </tr>
                        <tr>
                            <td> Created At </td>
                            <td> {{  $user->created_at->format('d F, Y') }} </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection