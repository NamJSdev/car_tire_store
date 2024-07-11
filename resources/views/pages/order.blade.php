@extends('layouts.app')
@section('title', 'Danh Sách Đơn Hàng')

@section('content')
    
    <div class="tab-content" id="pills-tabContent-1">
        <div class="tab-pane fade show active" id="pills-home-fill" role="tabpanel" aria-labelledby="pills-home-tab-fill">
            @if ($datas->where('status', 1)->count() > 0)
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                                <div class="iq-search-bar device-search w-50">
                                    <form id="searchForm" action="{{ route('orders.index') }}" method="GET"
                                        class="searchbox d-flex">
                                        <div>
                                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                            <input type="text" id="searchInput"
                                                style="border-top-right-radius: 0%;border-bottom-right-radius: 0%;"
                                                class="text search-input" placeholder="Tìm kiếm đơn hàng..." name="search"
                                                value="" />
                                        </div>
                                        <button type="submit" class="btn btn-info float-left"
                                            style="border-top-left-radius: 0%;border-bottom-left-radius: 0%;">Tìm
                                            Kiếm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive rounded mb-3">
                                <table class="data-table table mb-0 tbl-server-info">
                                    <thead class="bg-white text-uppercase">
                                        <tr class="ligth ligth-data">
                                            <th>STT</th>
                                            <th>Mã ĐH</th>
                                            <th>Thành Tiền</th>
                                            <th>Người Bán</th>
                                            <th>Khách Hàng</th>
                                            <th>SĐT</th>
                                            <th>Ngày Tạo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ligth-body">
                                        @php
                                            // Tính số thứ tự bắt đầu của bản ghi đầu tiên trên trang hiện tại
                                            $startIndex = ($datas->currentPage() - 1) * $datas->perPage() + 1;
                                        @endphp
                                        @foreach ($datas as $index => $data)
                                            @if ($data->status == 1)
                                                <tr data-id="{{ $data->id }}">
                                                    <td>{{ $startIndex + $index }}</td>
                                                    <td>{{ $data->maDonHang }}</td>
                                                    <td>{{ number_format($data->price, 0, ',', '.') . ' đ' }}</td>
                                                    <td>{{ $data->account->info->name }}</td>
                                                    <td>{{ $data->customer->hoTen }}</td>
                                                    <td>{{ $data->customer->sdt }}</td>
                                                    <td> {{ \Carbon\Carbon::parse($data->ngayTao)->format('d-m-Y H:i') }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            <a class="badge badge-info mr-2" data-toggle="tooltip"
                                                                data-placement="top" title="Chi Tiết Đơn Hàng"
                                                                href="{{ route('orders.invoice', ['orderId' => $data->id]) }}"
                                                                target="_blank">
                                                                <i class="ri-eye-line mr-0"></i>
                                                            </a>
                                                            <a class="badge badge-success mr-2" data-toggle="tooltip"
                                                                href="{{ route('print.invoice', ['orderId' => $data->id]) }}"
                                                                data-placement="top" title=""
                                                                data-original-title="Xuất Hóa Đơn" target="_blank"><i
                                                                    class="la la-print mr-0"></i></a>
                                                            @if(Auth::user()->roleID == 1) <!-- Admin -->
                                                            <a class="badge bg-warning mr-2 cancel" href="#"
                                                                title="Cancel" data-toggle="modal"
                                                                data-target="#cancelModal" data-id="{{ $data->id }}"><i
                                                                    class="fas fa-times"></i></a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
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
            @else
                <div class="container-fluid">
                    @include('components.cart-empty')
                </div>
            @endif
        </div>
        <div class="tab-pane fade" id="pills-profile-fill" role="tabpanel" aria-labelledby="pills-profile-tab-fill">
            @if ($datas->where('status', 2)->count() > 0)
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive rounded mb-3">
                                <table class="data-table table mb-0 tbl-server-info">
                                    <thead class="bg-white text-uppercase">
                                        <tr class="ligth ligth-data">
                                            <th>STT</th>
                                            <th>Mã ĐH</th>
                                            <th>Thành Tiền</th>
                                            <th>Người Bán</th>
                                            <th>Khách Hàng</th>
                                            <th>SĐT</th>
                                            <th>Ngày Hủy</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ligth-body">
                                        @php
                                            $startIndex = ($datas->currentPage() - 1) * $datas->perPage() + 1;
                                        @endphp
                                        @foreach ($datas as $index => $data)
                                            @if ($data->status == 2)
                                                <tr data-id="{{ $data->id }}">
                                                    <td>{{ $startIndex + $index }}</td>
                                                    <td>{{ $data->maDonHang }}</td>
                                                    <td>{{ number_format($data->price, 0, ',', '.') . ' đ' }}</td>
                                                    <td>{{ $data->account->info->name }}</td>
                                                    <td>{{ $data->customer->hoTen }}</td>
                                                    <td>{{ $data->customer->sdt }}</td>
                                                    <td> {{ \Carbon\Carbon::parse($data->ngayTao)->format('d-m-Y H:i') }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            <a class="badge badge-info mr-2" data-toggle="tooltip"
                                                                data-placement="top" title="Chi Tiết Đơn Hàng"
                                                                href="{{ route('orders.invoice', ['orderId' => $data->id]) }}"
                                                                target="_blank">
                                                                <i class="ri-eye-line mr-0"></i>
                                                            </a>
                                                            <a class="badge bg-warning mr-2 delete" href="#"
                                                                title="Delete" data-toggle="modal"
                                                                data-target="#deleteModal"
                                                                data-id="{{ $data->id }}"><i
                                                                    class="ri-delete-bin-line mr-0"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($datas->lastPage() > 1)
                    <nav class="d-flex justify-content-center">
                        <ul class="pagination">
                            @if ($datas->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $datas->previousPageUrl() }}"
                                        rel="prev">&laquo;</a>
                                </li>
                            @endif
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
            @else
                <div class="container-fluid">
                    @include('components.cart-empty')
                </div>
            @endif
        </div>
        <div class="tab-pane fade" id="pills-contact-fill" role="tabpanel" aria-labelledby="pills-contact-tab-fill">
            @if ($datas->where('status', 3)->count() > 0)
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive rounded mb-3">
                                <table class="data-table table mb-0 tbl-server-info">
                                    <thead class="bg-white text-uppercase">
                                        <tr class="ligth ligth-data">
                                            <th>STT</th>
                                            <th>Mã ĐH</th>
                                            <th>Thành Tiền</th>
                                            <th>Người Bán</th>
                                            <th>Khách Hàng</th>
                                            <th>SĐT</th>
                                            <th>Ngày Hủy</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ligth-body">
                                        @php
                                            // Tính số thứ tự bắt đầu của bản ghi đầu tiên trên trang hiện tại
                                            $startIndex = ($datas->currentPage() - 1) * $datas->perPage() + 1;
                                        @endphp
                                        @foreach ($datas as $index => $data)
                                            @if ($data->status == 3)
                                                <tr data-id="{{ $data->id }}">
                                                    <td>{{ $startIndex + $index }}</td>
                                                    <td>{{ $data->maDonHang }}</td>
                                                    <td>{{ number_format($data->price, 0, ',', '.') . ' đ' }}</td>
                                                    <td>{{ $data->account->info->name }}</td>
                                                    <td>{{ $data->customer->hoTen }}</td>
                                                    <td>{{ $data->customer->sdt }}</td>
                                                    <td> {{ \Carbon\Carbon::parse($data->capNhat)->format('d-m-Y H:i') }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            <a class="badge badge-info mr-2" data-toggle="tooltip"
                                                                data-placement="top" title="Chi Tiết Đơn Hàng"
                                                                href="{{ route('orders.invoice', ['orderId' => $data->id]) }}"
                                                                target="_blank">
                                                                <i class="ri-eye-line mr-0"></i>
                                                            </a>
                                                            @if(Auth::user()->roleID == 1) <!-- Admin -->
                                                            <a class="badge bg-warning mr-2 delete" href="#"
                                                                title="Delete" data-toggle="modal"
                                                                data-target="#deleteModal"
                                                                data-id="{{ $data->id }}"><i
                                                                    class="ri-delete-bin-line mr-0"></i></a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
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
                                    <a class="page-link" href="{{ $datas->previousPageUrl() }}"
                                        rel="prev">&laquo;</a>
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
            @else
                <div class="container-fluid">
                    @include('components.cart-empty')
                </div>
            @endif
        </div>
    </div>
    <!-- Cancel Modal HTML -->
    <div id="cancelModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="cancelForm" action="{{ route('orders.cancel') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Hủy Đơn Hàng</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn hủy đơn hàng này?</p>
                        <input type="hidden" name="id" id="cancel-id">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Thoát">
                        <input type="submit" class="btn btn-danger" value="Hủy Đơn">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" action="{{ route('orders.delete') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa Đơn Hàng</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa đơn hàng này?</p>
                        <input type="hidden" name="id" id="delete-id">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-danger" value="Xóa">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            // Populate cancel modal with id
            $('.cancel').click(function() {
                var id = $(this).data('id');
                $('#cancel-id').val(id);
            });
            // Populate delete modal with id
            $('.delete').click(function() {
                var id = $(this).data('id');
                $('#delete-id').val(id);
            });
        });
        // Function to format date to YYYY-MM-DD
        function formatDate(dateString) {
            var date = new Date(dateString);
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
            var day = date.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
    </script>
@endsection
