@extends('layouts.app')
@section('title', 'Danh Mục Hang Hóa')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div
          class="d-flex flex-wrap align-items-center justify-content-between mb-4"
        >
          <div>
            <h4 class="mb-3">Danh Mục Hàng Hóa</h4>
          </div>
          <a
            href="{{route('categories.create')}}"
            class="btn btn-primary add-list"
            ><i class="las la-plus"></i>Thêm Danh Mục</a
          >
        </div>
      </div>
      <div class="col-lg-12">
        <div class="table-responsive rounded mb-3">
          <table class="data-table table mb-0 tbl-server-info">
            <thead class="bg-white text-uppercase">
              <tr class="ligth ligth-data">
                <th>STT</th>
                <th>Ảnh</th>
                <th>Tên Danh Mục</th>
                <th>Mô Tả</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="ligth-body">
              @php
                  // Tính số thứ tự bắt đầu của bản ghi đầu tiên trên trang hiện tại
                  $startIndex = ($datas->currentPage() - 1) * $datas->perPage() + 1;
              @endphp
              @foreach($datas as $index => $data)
              <tr data-id="{{ $data->id }}">
                <td>{{ $startIndex + $index }}</td>
                <td>
                  @if($data->image)
                            <img
                            src="{{ asset('storage/' . $data->image) }}"
                            class="img-fluid rounded avatar-50 mr-3"
                            alt="image"
                            />
                        @else
                            <img
                              src="../assets/images/logo.png"
                              class="img-fluid rounded avatar-50 mr-3"
                              alt="image"
                            />
                        @endif
                </td>
                <td>{{$data->name}}</td>
                <td class="truncated-text">{{$data->desc}}</td>
                <td>
                  <div class="d-flex align-items-center list-action">
                    <a
                        class="badge bg-success mr-2 edit"
                        href="#" title="Edit" data-toggle="modal" data-target="#editModal" data-id="{{ $data->id }}"
                        data-name="{{$data->name}}" data-desc="{{$data->desc}}"
                        ><i class="ri-pencil-line mr-0"></i
                      ></a>
                    <a
                        class="badge bg-warning mr-2 delete"
                        href="#" title="Delete" data-toggle="modal" data-target="#deleteModal" data-id="{{ $data->id }}"
                        ><i class="ri-delete-bin-line mr-0"></i
                      ></a>
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
<!-- Edit Modal HTML -->
<div id="editModal" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">
          <form id="editForm" action="{{ route('categories.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-header">						
                  <h4 class="modal-title">Chỉnh Sửa Danh Mục Hàng Hóa</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">					
                  <div class="form-group">
                      <label>Ảnh</label>
                      <input type="hidden" name="id">
                      <input
                      style="height: 63px"
                      type="file"
                      class="form-control image-file"
                      name="image"
                      accept="image/*"
                    />
                  </div>				
                  <div class="form-group">
                      <label>Tên Danh Mục</label>
                      <input type="text" class="form-control" name="name" required>
                  </div>				
                  <div class="form-group">
                      <label>Mô Tả</label>
                      <textarea type="text" class="form-control" name="desc"></textarea>
                  </div>				
                  				
              </div>
              <div class="modal-footer">
                  <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                  <input type="submit" class="btn btn-info" value="Lưu">
              </div>
          </form>
      </div>
  </div>
</div>

<!-- Delete Modal HTML -->
<div id="deleteModal" class="modal fade">
  <div class="modal-dialog">
      <div class="modal-content">
          <form id="deleteForm" action="{{ route('categories.delete') }}" method="POST">
              @csrf
              <div class="modal-header">
                  <h4 class="modal-title">Xóa Danh Mục</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                  <p>Bạn có chắc chắn muốn xóa danh mục này?</p>
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
  $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
      // Populate edit modal fields with existing data
      $('#editModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id');
          var name = button.data('name');
          var desc = button.data('desc');
          var modal = $(this);
          modal.find('input[name="id"]').val(id);
          modal.find('input[name="name"]').val(name);
          modal.find('textarea[name="desc"]').val(desc);
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
                <li class="page-item {{ ($datas->currentPage() == $i) ? 'active' : '' }}">
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