
@extends('admin.layouts.main')
@section('content')



<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên máy bay</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Hãng</label>
                <select name="brand_id" class="form-control">
                    @foreach($brands as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Ảnh</label>
                <input type="file" name="file_upload" class="form-control">
                @error('file_upload')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>
    
    
    <div class="col-12 d-flex justify-content-end">
        <button class="btn btn-primary" type="submit">Lưu</button>
        <a href="{{route('plane.index')}}" class="btn btn-danger">Huỷ</a>
    </div>
    
</form>
@endsection
