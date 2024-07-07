@foreach ($datas as $data)
    <tr data-id="{{ $data->id }}">
        <td>
            <img src="{{ asset('storage/' . $data->image) }}" class="img-fluid rounded avatar-50 mr-3" alt="image" />
        </td>
        <td>{{ $data->maHang }}</td>
        <td>{{ $data->tenHang }}</td>
        <td>{{ $data->category->name }}</td>
        <td>{{ number_format($data->giaBan, 0, ',', '.') . ' VNĐ' }}</td>
        <td>{{ $data->tonKho }}</td>
        <td>
            <div class="d-flex align-items-center list-action">
                <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="View" href="#"><i class="ri-eye-line mr-0"></i></a>
                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="Edit" href="#"><i class="ri-pencil-line mr-0"></i></a>
                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="Delete" href="#"><i class="ri-delete-bin-line mr-0"></i></a>
            </div>
        </td>
    </tr>
@endforeach
