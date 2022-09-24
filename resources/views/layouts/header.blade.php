<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box text-center">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        @if($setting->icon !== null)
                            <img src="{{ $setting->icons }}" alt="logo-sm-dark" height="22">
                        @else
                            <img src="{{ asset('images/logo-sm.png') }} " alt="logo-sm-dark" height="22">
                        @endif
                    
                    </span>
                    <span class="logo-lg">
                    @if($setting->logo !== null)
                        <img src="{{ $setting->logos }} " alt="logo-dark" height="24">                
                    @else
                        <img src="{{ asset('images/logo.png') }} " alt="logo-dark" height="24">
                    @endif
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo-sm.png') }} " alt="logo-sm-light" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/logo-light.png') }} " alt="logo-light" height="24">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line fa-solid fa-bars" style="font-size:15px;"></i>
            </button>

            <!-- App Search-->
            <!-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form> -->
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">
        
                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-bell animate__animated animate__headShake" style="font-size:15px; margin-top:-2px;"></i>
                    @if($countTransaction->count() > 0)
                        <span class="badge bg-danger">{{ $countTransaction->count() }}</span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                @if($countTransaction->count() > 0)
                                    <a href="/transaction" class="small"> View All</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        @forelse($countTransaction as $t)
                        <a href="/transaction/{{ $t->id }}" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img src="{{ asset('images/users/avatar-3.jpg') }}" class="rounded-circle avatar-xs" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $t->user->name }}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1"></p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{ $t->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div>
                                    <i class="fa @if($t->read_at == null) fa-envelope @else fa-envelope-open @endif"></i>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="p-4 text-center">
                            Tidak ada transaksi
                        </div>
                        @endforelse
                        
                   </div>
                    @if($countTransaction->count() > 0)
                        <div class="p-2 border-top">
                            <div class="d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ route('mark') }}">
                                    Mark as read
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('images/users/avatar-2.jpg') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ auth()->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item d-block" href="#"><i class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <form action="/logout" method="post">
                        @csrf
                        @method('post')
                        <button type="submit" class="dropdown-item text-danger"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>