@extends('admin.layouts.main')
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
                <label for="">Hãng:</label>
                <select name="cate_id" class="form-control">
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
        <th>Tên</th>
        <th>Địa chỉ</th>
        <th>Số lượng máy bay</th>
        <th>Ảnh</th>
        
        <th>
            <a href="{{route('brand.add')}}" type="button" class="btn btn-primary">Tạo mới</a>
        </th>
    </thead>
    <tbody>
        @foreach($brands as $p)
        <tr>
            <td>{{(($brands->currentPage()-1)*config('common.default_page_size')) + $loop->iteration}}</td>
            <td>{{$p->name}}</td>
            <td>{{$p->address}}</td>
            <td>{{count($p->planes)}}</td>
            <td>
                <img src="{{asset('storage/' . $p->image)}}" width="70">
            </td>
            <td>
                <a href="{{route('brand.edit', ['id' => $p->id])}}" type="button" class="btn btn-success">Sửa</a>
                <a href="{{route('brand.remove', ['id' => $p->id])}}" type="button" class="btn btn-danger" onclick="alert('Bạn có muốn xoá không ?')">Xóa</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-6 offset-3 d-flex justify-content-center">
        {{$brands->links()}}
    </div>
</div>
@endsection
