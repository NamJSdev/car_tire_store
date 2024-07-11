@extends('layouts.app')
@section('title', 'Quản Lý Nhập Chi')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Danh Sách Nhập Chi Tiền Mặt</h4>
                    </div>
                    <a href="#" class="btn btn-primary add-list add" data-toggle="modal" data-target="#addModal"><i
                            class="las la-plus"></i>Tạo Phiếu</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>STT</th>
                                <th>Phân Loại</th>
                                <th>Tiền Mặt</th>
                                <th>Mô Tả</th>
                                <th>Ngày Lập</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @php
                                // Tính số thứ tự bắt đầu của bản ghi đầu tiên trên trang hiện tại
                                $startIndex = ($datas->currentPage() - 1) * $datas->perPage() + 1;
                            @endphp
                            @foreach ($datas as $index => $data)
                                <tr data-id="{{ $data->id }}">
                                    <td>{{ $startIndex + $index }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ number_format($data->cash, 0, ',', '.') . ' đ' }}</td>
                                    <td>{{ $data->desc }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->ngayTao)->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge bg-success mr-2 edit" href="#" title="Edit"
                                                data-toggle="modal" data-target="#editModal" data-id="{{ $data->id }}"
                                                data-name="{{ $data->status }}" data-cash="{{ $data->cash }}"
                                                data-desc="{{ $data->desc }}"><i class="ri-pencil-line mr-0"></i></a>
                                            <a class="badge bg-warning mr-2 delete" href="#" title="Delete"
                                                data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $data->id }}"><i class="ri-delete-bin-line mr-0"></i></a>
                                        </div>
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
    <!-- Add Modal HTML -->
    <div id="addModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addForm" action="{{ route('payment_slips.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Tạo Phiếu Nhập Chi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Phân Loại</label>
                            <select name="name" class="selectpicker form-control" data-style="py-0">
                                <option value="0">Nhập Tiền Mặt</option>
                                <option value="1">Phiếu Chi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiền Mặt (VNĐ)</label>
                            <input type="number" class="form-control" name="cash" placeholder="Nhập tiền mặt" required>
                        </div>
                        <div class="form-group">
                            <label>Mô Tả</label>
                            <input type="text" class="form-control" name="desc" placeholder="Nhập mô tả">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-info" value="Tạo Phiếu">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" action="{{ route('payment_slips.update') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Chỉnh Sửa Phiếu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Phân Loại</label>
                            <select name="name" class="selectpicker form-control" data-style="py-0">
                                <option value="0">Nhập Tiền Mặt</option>
                                <option value="1">Phiếu Chi</option>
                            </select>
                        </div>
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label>Tiền Mặt (VNĐ)</label>
                            <input type="number" class="form-control" name="cash" required>
                        </div>
                        <div class="form-group">
                            <label>Mô Tả</label>
                            <input type="text" class="form-control" name="desc">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-info" value="Lưu">
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" action="{{ route('payment_slips.delete') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa Phiếu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa phiếu này?</p>
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
            // Populate edit modal fields with existing data
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var cash = button.data('cash');
                var desc = button.data('desc');
                var modal = $(this);
                modal.find('input[name="id"]').val(id);
                modal.find('input[name="name"]').val(name);
                modal.find('input[name="cash"]').val(cash);
                modal.find('input[name="desc"]').val(desc);

                // Cập nhật giá trị cho thẻ select
                modal.find('select[name="name"]').val(name).change();
            });

            // Populate delete modal with id
            $('.delete').click(function() {
                var id = $(this).data('id');
                console.log(id)
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
