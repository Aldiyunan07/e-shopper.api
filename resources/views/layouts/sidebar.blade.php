<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="/home" class="waves-effect">
                        <i class="fa-solid fa-home" style="font-size: 12px;"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-title">Data</li>
                <li>
                    <a href="/user" class="waves-effect">
                        <i class="fa-solid fa-user" style="font-size: 12px;"></i>
                        <span>User</span>
                    </a>
                </li>
                <li>
                    <a href="/product" class="waves-effect">
                        <i class="fa-solid fa-cart-shopping" style="font-size: 12px;"></i>
                        <span>Product</span>
                    </a>
                </li>
                <li class="menu-title">Transaction</li>
                <li>
                    <a href="/transaction" class="waves-effect">
                        <i class="fa-solid fa-money-bill" style="font-size: 12px;"></i>
                        @if($countTransaction->count() > 0)
                            <span class="badge rounded-pill bg-danger float-end">{{ $countTransaction->count() }}</span>
                        @endif
                        <span>Transaction</span>
                    </a>
                </li>
                <li class="menu-title">Setting</li>
                <li>
                @if($countType == 0)
                    <?php $err = 1; ?>
                @else
                    <?php $err = 0; ?>
                @endif
                @if($countBrand == 0)
                    <?php $err2 = 1; ?>
                @else
                    <?php $err2 = 0; ?>
                @endif
                    <a href="/setting" class="waves-effect">
                        <i class="fas fa-cogs" style="font-size: 12px;"></i>
                        @if($err + $err2 > 0)
                            <span class="badge rounded-pill bg-danger float-end">
                                {{ $err + $err2 }}
                            </span>
                        @endif
                        <span>Setting </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
