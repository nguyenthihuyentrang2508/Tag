@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container-fluid mt-2" style="margin-left: 120px">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header">
                   <div class="float-left"> Cập nhật thể loại truyện </div>
                   <div class="float-right"><a href="{{route('theloai.index')}}" ><i class="fas fa-arrow-left"></i></a></div>
                   <div style="clear: both;"></div>
            </div>

                @if ($errors->any())
                    <div class="alert  alert-dismissable alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                   
                        <div class="alert  alert-dismissable alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('theloai.update',[$theloai -> id])}}">
                        @method('PUT')
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên thể loại</label>
                        <input type="text" class="form-control" name="tentheloai" value="{{$theloai -> tentheloai}}" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên thể loại...">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Url thể loại</label>
                        <input readonly="readonly" type="text" class="form-control"  value="{{$theloai -> slug_theloai}}" name="slug_theloai" id="convert_slug" placeholder="Tên thể loại...">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Mô tả thể loại</label>
                        <input type="text" class="form-control" name="mota" value="{{$theloai -> mota}}" id="exampleInputEmail1" placeholder="Mô tả thể loại...">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kích hoạt</label>
                        <select name="kichhoat" class="custom-select">
                            @if($theloai->kichhoat==0)
                                <option selected value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                            @else
                                <option value="0">Kích hoạt</option>
                                <option selected value="1">Không kích hoạt</option>
                            @endif
                        </select>
                    </div>

                    <button type="submit" name="themtheloai" class="btn btn-primary">Cập nhật</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
