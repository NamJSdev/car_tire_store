<div class="iq-sidebar sidebar-default">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="header-logo">
            <img src="../assets/images/logo.png" class="img-fluid rounded-normal light-logo" alt="logo" />
            <h5 class="logo-title light-logo">TireStore</h5>
        </a>
        <div class="iq-menu-bt-sidebar ml-2">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="svg-icon">
                        <svg class="svg-icon" id="p-dash1" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span class="ml-4">Tổng Quan</span>
                    </a>
                </li>
                <li class="{{ request()->is('thu-ngan') ? 'active' : '' }}">
                    <a href="{{ route('cashiers.index') }}" class="">
                        <svg class="svg-icon" id="p-dash4" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                            <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                        </svg>

                        <span class="ml-4">Thu Ngân</span>
                    </a>
                    <ul id="reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle"></ul>
                </li>
                <li class="{{ request()->is('don-hang') ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}" class="">
                        <svg class="svg-icon" id="p-dash2" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoi1n="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>

                        <span class="ml-4">Đơn Hàng</span>
                    </a>
                    <ul id="reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle"></ul>
                </li>
                <li class=" ">
                    <a href="#warranty" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash19" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z">
                            </path>
                        </svg>
                        <span class="ml-4">Bảo Hành</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="warranty"
                        class="iq-submenu collapse {{ request()->is('thong-tin-bao-hanh') || request()->is('san-pham/danh-sach-san-pham') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->is('thong-tin-bao-hanh') ? 'active' : '' }}">
                            <a href="{{ route('warranties.index') }}">
                                <i class="las la-minus"></i><span>Thông Tin Bảo Hành</span>
                            </a>
                        </li>
                        {{-- <li class="{{ request()->is('san-pham/form-khoi-tao') ? 'active' : '' }}">
                            <a href="{{ route('products.create') }}">
                                <i class="las la-minus"></i><span>Phiếu Bảo Hành</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class=" ">
                    <a href="#product" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash7" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span class="ml-4">Hàng Hóa</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="product"
                        class="iq-submenu collapse {{ request()->is('san-pham/form-khoi-tao') || request()->is('san-pham/danh-sach-san-pham') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->is('san-pham/danh-sach-san-pham') ? 'active' : '' }}">
                            <a href="{{ route('products.index') }}">
                                <i class="las la-minus"></i><span>Danh Sách Sản Phẩm</span>
                            </a>
                        </li>
                        @if(Auth::user()->roleID == 1) <!-- Admin -->
                        <li class="{{ request()->is('san-pham/form-khoi-tao') ? 'active' : '' }}">
                            <a href="{{ route('products.create') }}">
                                <i class="las la-minus"></i><span>Thêm Sản Phẩm</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @if(Auth::user()->roleID == 1) <!-- Admin -->
                <li class=" ">
                    <a href="#category" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash3" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span class="ml-4">Danh Mục</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="category"
                        class="iq-submenu collapse {{ request()->is('danh-muc/form-khoi-tao') || request()->is('danh-muc/danh-sach-danh-muc') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->is('danh-muc/danh-sach-danh-muc') ? 'active' : '' }}">
                            <a href="{{ route('categories.index') }}">
                                <i class="las la-minus"></i><span>Danh Sách Danh Mục</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('danh-muc/form-khoi-tao') ? 'active' : '' }}">
                            <a href="{{ route('categories.create') }}">
                                <i class="las la-minus"></i><span>Thêm Danh Mục</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="{{ request()->is('quan-ly-nhap-chi') ? 'active' : '' }}">
                    <a href="{{ route('payment_slips.index') }}" class="">
                        <svg class="svg-icon" id="p-dash13" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                        </svg>

                        <span class="ml-4">Nhập - Chi</span>
                    </a>
                    <ul id="reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle"></ul>
                </li>
                <li class="{{ request()->is('danh-sach-khach-hang') ? 'active' : '' }}">
                    <a href="{{ route('danh-sach-khach-hang') }}" class="">
                        <svg class="svg-icon" id="p-dash10" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>

                        <span class="ml-4">Khách Hàng</span>
                    </a>
                    <ul id="reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle"></ul>
                </li>
                @if(Auth::user()->roleID == 1) <!-- Admin -->
                <li class="{{ request()->is('tai-khoan-he-thong') ? 'active' : '' }}">
                    <a href="#people" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash8" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="ml-4">Tài Khoản</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="people"
                        class="iq-submenu collapse {{ request()->is('tai-khoan-he-thong') || request()->is('tai-khoan-nhan-vien') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->is('tai-khoan-nhan-vien') ? 'active' : '' }}">
                            <a href="{{ route('taikhoannhanvien') }}">
                                <i class="las la-minus"></i><span>Tài Khoản Nhân Viên</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('tai-khoan-he-thong') ? 'active' : '' }}">
                            <a href="{{ route('taikhoanhethong') }}">
                                <i class="las la-minus"></i><span>Tài Khoản Quản Trị</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
