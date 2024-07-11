<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                <i class="ri-menu-line wrapper-menu"></i>
                <a href="{{ route('dashboard') }}" class="header-logo">
                    <img src="../assets/images/logo.png" class="img-fluid rounded-normal" alt="logo" />
                    <h5 class="logo-title ml-3">TireStore</h5>
                </a>
            </div>
            @if (request()->is('san-pham/danh-sach-san-pham'))
                <div class="iq-search-bar device-search">
                    <form id="searchForm" class="searchbox">
                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                        <input type="text" id="searchInput" class="text search-input"
                            placeholder="Tìm kiếm sản phẩm..." name="search"
                            value="{{ request()->query('search') }}" />
                    </form>
                </div>
            @elseif (request()->is('/') || request()->is('danh-sach-khach-hang') || request()->is('don-hang'))
            @else
                <div class="iq-search-bar device-search"></div>
            @endif
            @if (request()->is('danh-sach-khach-hang'))
                <div class="iq-search-bar device-search">
                    <form id="searchForm" action="{{ route('danh-sach-khach-hang') }}" method="GET"
                        class="searchbox d-flex">
                        <div>
                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                            <input type="text" id="searchInput"
                                style="border-top-right-radius: 0%;border-bottom-right-radius: 0%;"
                                class="text search-input" placeholder="Tìm kiếm khách hàng..." name="search"
                                value="" />
                        </div>
                        <button type="submit" class="btn btn-info float-left"
                            style="border-top-left-radius: 0%;border-bottom-left-radius: 0%;">Tìm
                            Kiếm</button>
                </div>
            @elseif (request()->is('/') || request()->is('san-pham/danh-sach-san-pham') || request()->is('don-hang'))
            @else
                <div class="iq-search-bar device-search"></div>
            @endif
            @if (request()->is('/'))
                <!-- Thêm phần chọn thời gian -->
                <div class="d-flex">
                    <form method="GET" action="{{ route('dashboard') }}"
                        class=" d-flex ml-1 h-100 align-items-center">
                        @csrf
                        <div class="form-group h-100 mb-0 mr-3" style="height: 40px">
                            <input name="date" type="date" id="date" class="form-control h-100"
                                style="height: 40px !important">
                        </div>
                        <div class="form-group h-100 mb-0 mr-3" style="height: 40px">
                            <input name="month" type="month" id="month" class="form-control h-100"
                                style="height: 40px !important">
                        </div>
                        <div class="form-group mb-0 mr-3" style="height: 40px">
                            <input name="year" type="number" id="year" class="form-control h-100"
                                placeholder="2024">
                        </div>
                        <button class="btn btn-primary h-100" type="submit"><i class="las la-filter"></i>Lọc Dữ
                            Liệu</button>
                    </form>
                    <form method="POST" action="{{ route('clearFilters') }}" class="ml-3">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="las la-ban"></i>Xóa Bộ Lọc</button>
                    </form>
                </div>
            @endif
            @if (request()->is('don-hang'))
                <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab-1" role="tablist" style="margin-bottom: 0px !important">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab-fill" data-toggle="pill" href="#pills-home-fill"
                            role="tab" aria-controls="pills-home" aria-selected="true">Đơn Hàng Hoàn Thành</a>
                    </li>
                    {{-- <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab-fill" data-toggle="pill" href="#pills-profile-fill" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Đơn Hàng Tạm Tính</a>
                </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab-fill" data-toggle="pill" href="#pills-contact-fill"
                            role="tab" aria-controls="pills-contact" aria-selected="false">Đơn Hàng Đã Hủy</a>
                    </li>
                </ul>
            @endif
            <div class="d-flex align-items-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-label="Toggle navigation">
                    <i class="ri-menu-3-line"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list align-items-center">
                        <li>
                            <a href="{{ route('cashiers.index') }}"
                                class="btn border add-btn shadow-none mx-2 d-none d-md-block"><i
                                    class="la la-bank mr-2"></i>Thanh Toán</a>
                        </li>
                        <li class="nav-item nav-icon search-content">
                            <a href="#" class="search-toggle rounded" id="dropdownSearch"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-search-line"></i>
                            </a>
                            <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                <form action="#" class="searchbox p-2">
                                    <div class="form-group mb-0 position-relative">
                                        <input type="text" class="text search-input font-size-12"
                                            placeholder="type here to search..." />
                                        <a href="#" class="search-link"><i class="las la-search"></i></a>
                                    </div>
                                </form>
                            </div>
                        </li>
                        {{-- <li class="nav-item nav-icon dropdown">
                            <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                                <span class="bg-primary"></span>
                            </a>
                            <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="card shadow-none m-0">
                                    <div class="card-body p-0">
                                        <div class="cust-title p-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Notifications</h5>
                                                <a class="badge badge-primary badge-card" href="#">3</a>
                                            </div>
                                        </div>
                                        <div class="px-3 pt-0 pb-0 sub-card">
                                            <a href="#" class="iq-sub-card">
                                                <div class="media align-items-center cust-card py-3 border-bottom">
                                                    <div class="">
                                                        <img class="avatar-50 rounded-small"
                                                            src="../assets/images/user/01.jpg" alt="01" />
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-0">Emma Watson</h6>
                                                            <small class="text-dark"><b>12 : 47 pm</b></small>
                                                        </div>
                                                        <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="media align-items-center cust-card py-3 border-bottom">
                                                    <div class="">
                                                        <img class="avatar-50 rounded-small"
                                                            src="../assets/images/user/02.jpg" alt="02" />
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-0">Ashlynn Franci</h6>
                                                            <small class="text-dark"><b>11 : 30 pm</b></small>
                                                        </div>
                                                        <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="media align-items-center cust-card py-3">
                                                    <div class="">
                                                        <img class="avatar-50 rounded-small"
                                                            src="../assets/images/user/03.jpg" alt="03" />
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-0">Kianna Carder</h6>
                                                            <small class="text-dark"><b>11 : 21 pm</b></small>
                                                        </div>
                                                        <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <a class="right-ic btn btn-primary btn-block position-relative p-2"
                                            href="#" role="button">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                        <li class="nav-item nav-icon dropdown caption-content">
                            <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="../assets/images/user/1.png" class="img-fluid rounded" alt="user" />
                            </a>
                            <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="card shadow-none m-0">
                                    <div class="card-body p-0 text-center">
                                        <div class="media-body profile-detail text-center">
                                            <img src="../assets/images/page-img/profile-bg.jpg" alt="profile-bg"
                                                class="rounded-top img-fluid mb-4" />
                                            <img src="../assets/images/user/1.png" alt="profile-img"
                                                class="rounded profile-img img-fluid avatar-70" />
                                        </div>
                                        <div class="p-3">
                                            <h5 class="mb-1">{{ Auth::user()->email }}</h5>
                                            <p class="mb-0">{{ getGreeting() }} {{ Auth::user()->info->name }}</p>
                                            <div class="d-flex align-items-center justify-content-center mt-3">
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item border"
                                                        href="#" data-toggle="modal"
                                                        data-target="#logoutModal">
                                                        Đăng Xuất
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
