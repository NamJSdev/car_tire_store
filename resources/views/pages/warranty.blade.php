@extends('layouts.app')
@section('title', 'Thông Tin Bảo Hành')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Thông Tin Bảo Hành</h4>
                    </div>
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">

                        <div class="iq-search-bar device-search w-50">
                            <form id="searchForm" action="{{ route('warranties.index') }}" method="GET" class="searchbox d-flex">
                                <div>
                                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                    <input type="text" id="searchInput"
                                        style="border-top-right-radius: 0%;border-bottom-right-radius: 0%;"
                                        class="text search-input" placeholder="Tìm kiếm thông tin..." name="search"
                                        value="" />
                                </div>
                                <button type="submit" class="btn btn-info float-left"
                                    style="border-top-left-radius: 0%;border-bottom-left-radius: 0%;">Tìm
                                    Kiếm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Mã Đơn Hàng</th>
                                <th>Khách Hàng</th>
                                <th>SĐT</th>
                                <th>Kích Hoạt</th>
                                <th>Hết Hạn</th>
                                <th>Tình Trạng</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @php
                                // Tính số thứ tự bắt đầu của bản ghi đầu tiên trên trang hiện tại
                                $startIndex = ($datas->currentPage() - 1) * $datas->perPage() + 1;
                            @endphp
                            @foreach ($datas as $index => $data)
                                @php
                                    $today = now();
                                    $warrantyStart = \Carbon\Carbon::parse($data->warrantyStart);
                                    $warrantyEnd = \Carbon\Carbon::parse($data->warrantyEnd);
                                    $isInWarranty = $today->between($warrantyStart, $warrantyEnd);
                                @endphp
                                <tr data-id="{{ $data->id }}">
                                    <td>{{ $startIndex + $index }}</td>
                                    <td>
                                        @if ($data->product->image)
                                            <img src="{{ asset('storage/' . $data->product->image) }}"
                                                class="img-fluid rounded avatar-50 mr-3" alt="image" />
                                        @else
                                            <img src="../assets/images/logo.png" class="img-fluid rounded avatar-50 mr-3"
                                                alt="image" />
                                        @endif
                                    </td>
                                    <td>{{ $data->product->tenHang }}</td>
                                    <td>{{ $data->order->maDonHang }}</td>
                                    <td>{{ $data->order->customer->hoTen }}</td>
                                    <td>{{ $data->order->customer->sdt }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->warrantyStart)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->warrantyEnd)->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($isInWarranty)
                                            <span class="badge badge-success">Còn Hạn</span>
                                        @else
                                            <span class="badge badge-danger">Hết hạn</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
    <!-- Hiển thị phân trang -->
    @if ($datas->lastPage() > 1)
        <nav class="d-flex justify-content-center">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($datas->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Numbered Page Links --}}
                @php
                    $currentPage = $datas->currentPage();
                    $lastPage = $datas->lastPage();
                    $maxPages = 5; // Số lượng trang tối đa hiển thị
                    $halfMaxPages = floor($maxPages / 2);
                    $startPage = max($currentPage - $halfMaxPages, 1);
                    $endPage = min($currentPage + $halfMaxPages, $lastPage);
                @endphp

                @if ($startPage > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->url(1) }}">1</a>
                    </li>
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif

                @for ($i = $startPage; $i <= $endPage; $i++)
                    <li class="page-item {{ $datas->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $datas->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($endPage < $lastPage)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->url($lastPage) }}">{{ $lastPage }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($datas->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
@endsection
