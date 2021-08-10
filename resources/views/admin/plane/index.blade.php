@extends('admin.layouts.main')
@section('title', 'PT15303 - Quản trị máy bay')
@section('content')


<form action="" method="get">
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="">Tên</label>
                <input type="text" name="keyword" class="form-control">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Hãng</label>
                <select name="brand_id" class="form-control">
                    <option value="">Tất cả</option>
                    @foreach($brands as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>    
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="">Sắp xếp theo</label>
                <select name="order_by" class="form-control">
                    <option value="">Mặc định</option>
                    @foreach(config('common.product_order_by') as $k => $val)
                    <option value="{{$k}}">{{$val}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <button class="btn btn-sm btn-primary" type="submit">Tìm kiếm</button>
        </div>    
    </div>
</form>
<table class="table table-hover">
    <thead>
        <th>STT</th>
        <th>Tên SP</th>
        <th>Danh mục</th>
        <th>Ảnh</th>
        <th>
            <a href="{{route('plane.add')}}" type="button" class="btn btn-primary">Tạo mới</a>
        </th>
    </thead>
    <tbody>
        @foreach($plane_data as $p)
        <tr>
            <td>{{(($plane_data->currentPage()-1)*config('common.default_page_size')) + $loop->iteration}}</td>
            <td>{{$p->name}}</td>
            <td>{{$p->brand->name}}</td>
            <td>
                <img src="{{asset('storage/' . $p->image)}}" width="70">
            </td>
            <td>
                <a href="{{route('plane.edit', ['id' => $p->id])}}" type="button" class="btn btn-success">Sửa</a>
                <a href="{{route('plane.remove', ['id' => $p->id])}}" type="button" class="btn btn-danger" onclick="alert('Bạn có muốn xoá không ?')">Xóa</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-6 offset-3 d-flex justify-content-center">
        {{$plane_data->links()}}
    </div>
</div>

@endsection