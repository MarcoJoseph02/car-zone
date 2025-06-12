<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 bg-white @if(LaravelLocalization::getCurrentLocale()=='en') fixed-start ms-4 @else fixed-end me-4 rotate-caret @endif "
       id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" {{ route('admin.dashboard') }}" target="_blank">
            <img src="/assets/img/CarZone_Logo.jpg" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">{{ trans('Admin Dashboard') }} </span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link {{getActiveElementByRoute(route:'admin.dashboard')}}"
                   href="{{ route('admin.dashboard') }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-home text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1"> {{ trans('app.Home') }} </span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{getActiveElementByRoute(route:'admin.users.index')}}"
                   href="{{ route('admin.users.index') }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1"> Users </span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{getActiveElementByRoute(route:'admin.category.index')}}"
                   href="{{ route('admin.category.index') }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Categories</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{getActiveElementByRoute(route:'admin.brand.index')}}"
                   href="{{ route('admin.brand.index') }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Brands</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{getActiveElementByRoute(route:'admin.branch.index')}}"
                   href="{{ route('admin.branch.index') }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Branches</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{getActiveElementByRoute(route:'admin.supplier.index')}}"
                   href="{{ route('admin.supplier.index') }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Suppliers</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link {{getActiveElementByRoute(route:'admin.car.index')}}"
                   href="{{ route('admin.car.index') }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Cars</span>
                </a>
            </li>
        
        </ul>
    </div>
    <div class="sidenav-footer mx-3 my-3">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-60 mx-auto" src="/assets/img/CarZone_Logo.jpg" alt="sidebar_illustration">
        </div>
    </div>
</aside>
