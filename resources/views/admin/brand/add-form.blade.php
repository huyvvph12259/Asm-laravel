
@extends('admin.layouts.main')
@section('content')
<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên hãng</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{old('address')}}">
                @error('address')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Ảnh</label>
                <input type="file" name="file_upload" class="form-control">
                @error('file_upload')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="col-12 d-flex justify-content-end">
            <button class="btn btn-primary" type="submit">Lưu</button>
        </div>
    </div>
</form>
@endsection







