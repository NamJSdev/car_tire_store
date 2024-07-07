@foreach ($datas as $data)
    <tr data-id="{{ $data->id }}">
        <td>
            <img src="{{ asset('storage/' . $data->image) }}" class="img-fluid rounded avatar-50 mr-3" alt="image" />
        </td>
        <td>{{ $data->maHang }}</td>
        <td>{{ $data->tenHang }}</td>
        <td>{{ $data->category->name }}</td>
        <td>{{ number_format($data->giaBan, 0, ',', '.') . ' VNĐ' }}</td>
        <td>{{ $data->thoiGianBaoHanh }} Tháng</td>
        <td>{{ $data->tonKho }} {{ $data->donViTinh }}</td>
        <td>
            @if ($data->status === 'activated')
                Đang Bán
            @else
                Dừng Bán
            @endif
        </td>
        <td>
            <div class="d-flex align-items-center list-action">
                <a class="badge badge-info mr-2" data-toggle="modal" data-target="#viewModal" data-placement="top"
                    title="View" href="#" 
                    data-id="{{ $data->id }}" 
                    data-name="{{ $data->tenHang }}"
                    data-ma-hang="{{ $data->maHang }}"
                    data-gia-von="{{ number_format($data->giaVon, 0, ',', '.') . ' VNĐ' }}"
                    data-gia-ban="{{ number_format($data->giaBan, 0, ',', '.') . ' VNĐ' }}"
                    data-danh-muc="{{ $data->category->name }}" data-ton-kho="{{ $data->tonKho }}"
                    data-desc="{{ $data->desc }}" data-don-vi="{{ $data->donViTinh }}"
                    data-bao-hanh="{{ $data->thoiGianBaoHanh }}" data-luong-ban="{{ $data->luongBan }}"
                    data-image="{{ asset('storage/' . $data->image) }}">
                    <i class="ri-eye-line mr-0"></i></a>
                <a class="badge bg-success mr-2 edit" href="#" title="Edit" data-toggle="modal"
                    data-target="#editModal" 
                    data-id="{{ $data->id }}" 
                    data-name="{{ $data->tenHang }}"
                    data-ma-hang="{{ $data->maHang }}"
                    data-gia-von="{{ number_format($data->giaVon , 0, ',', '')}}"
                    data-gia-ban="{{ number_format($data->giaBan , 0, ',', '')}}"
                    data-danh-muc="{{ $data->categoryID }}" 
                    data-ton-kho="{{ $data->tonKho }}"
                    data-desc="{{ $data->desc }}" 
                    data-don-vi="{{ $data->donViTinh }}"
                    data-bao-hanh="{{ $data->thoiGianBaoHanh }}"
                    data-status="{{ $data->status }}"
                    ><i class="ri-pencil-line mr-0"></i></a>
                <a class="badge bg-warning mr-2 delete" href="#" title="Delete" data-toggle="modal"
                    data-target="#deleteModal" data-id="{{ $data->id }}"><i
                        class="ri-delete-bin-line mr-0"></i></a>
            </div>
        </td>
    </tr>
@endforeach
