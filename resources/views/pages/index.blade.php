@extends('layouts.app')

@section('title', 'Tổng Quan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-3">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-info-light">
                                        <i class="las la-shopping-cart font-size-40"></i>
                                    </div>
                                    <div>
                                        <p class="mb-2">Đơn Hàng</p>
                                        <h4>{{ $orders->count() }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-info iq-progress progress-1" data-percent="85">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-yellow">
                                        <i class="las la-car-alt font-size-40"></i>
                                    </div>
                                    <div>
                                        <p class="mb-2">Sản Phẩm</p>
                                        <h4>{{ $sumProduct }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-info iq-progress progress-1" data-percent="85">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-danger-light">
                                        <i class="las la-signal font-size-40"></i>
                                    </div>
                                    <div>
                                        <p class="mb-2">Doanh Thu</p>
                                        <h4>{{ number_format($totalRevenue, 0, ',', '.') }} đ</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-danger iq-progress progress-1" data-percent="70">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <i class="la la-money font-size-40"></i>
                                    </div>
                                    <div>
                                        <p class="mb-2">Tiền Mặt Tại Cửa Hàng</p>
                                        <h4>{{ number_format($cash, 0, ',', '.') }} đ</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->roleID == 1) <!-- Admin -->
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-danger-light">
                                        <i class="la la-money font-size-40"></i>
                                    </div>
                                    <div>
                                        <p class="mb-2">Tiền Lãi</p>
                                        <h4>{{ number_format($tienLai, 0, ',', '.') }} đ</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <i class="las la-sync font-size-40"></i>
                                    </div>
                                    <div>
                                        <p class="mb-2">Dư Nợ</p>
                                        <h4>{{ number_format($tienNo, 0, ',', '.') }} đ</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-yellow">
                                        <i class="las la-capsules font-size-40"></i>
                                    </div>
                                    <div>
                                        <p class="mb-2">Sản Phẩm Hết Hàng</p>
                                        <h4>{{$hetHang}}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-info-light">
                                        <i class="las la-address-book font-size-40"></i>
                                    </div>
                                    <div>
                                        <p class="mb-2">Khách Hàng</p>
                                        <h4>{{ $khachHang}}<i class="la la-plus font-size-18 mb-1"></i></h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-8 mt-3">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Top Bán Chạy</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                            {{-- <div class="dropdown">
                                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton006"
                                    data-toggle="dropdown">
                                    This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                    aria-labelledby="dropdownMenuButton006">
                                    <a class="dropdown-item" href="#">Year</a>
                                    <a class="dropdown-item" href="#">Month</a>
                                    <a class="dropdown-item" href="#">Week</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled row top-product mb-0 mt-3">
                            @foreach ($topProducts as $data)
                                <li class="col-lg-3">
                                    <div class="card card-block card-stretch card-height mb-0">
                                        <div class="card-body" style="height: 345px">
                                            <div class="rounded">
                                                @if ($data->image)
                                                    <img src="{{ asset('storage/' . $data->image) }}"
                                                        class="style-img img-fluid m-auto p-3" alt="image" style="height: 200px"/>
                                                @else
                                                    <img src="../assets/images/product/01.png"
                                                        class="style-img img-fluid m-auto p-3" alt="image" />
                                                @endif
                                            </div>
                                            <div class="text-center mt-3">
                                                <h5 class="mb-1">{{ $data->tenHang }}</h5>
                                                <p class="mb-0">{{ $data->luongBan }} Sản Phẩm</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-3">
                <div class="card card-transparent card-block card-stretch mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between p-0">
                        <div class="header-title">
                            <h4 class="card-title mb-0">Sản Phẩm Mới</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                            <div>
                                <a href="{{route('products.index')}}" class="btn btn-primary view-btn font-size-14">Tất Cả</a>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($newProducts as $data)
                    <div class="card card-block card-stretch card-height-helf">
                        <div class="card-body card-item-right">
                            <div class="d-flex align-items-top">
                                <div class="rounded">
                                    @if ($data->image)
                                        <img src="{{ asset('storage/' . $data->image) }}" class="style-img img-fluid m-auto"
                                        alt="image" style="height: 100px"/>
                                    @else
                                        <img src="../assets/images/product/04.png" class="style-img img-fluid m-auto"
                                            alt="image" />
                                    @endif
                                </div>
                                <div class="style-text text-left">
                                    <h5 class="mb-2">{{$data->tenHang}}</h5>
                                <p class="mb-0">Giá Bán :  {{ number_format($data->giaBan, 0, ',', '.') . ' đ' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
