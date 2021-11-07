@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container-fluid mt-2" style="margin-left: 120px">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                <div class="float-left"> Thêm thể loại truyện </div>
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

                    <form method="POST" action="{{route('theloai.store')}}">
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên thể loại</label>
                        <input type="text" class="form-control"  value="{{old('tentheloai')}}" name="tentheloai" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên thể loại...">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Url Thể loại</label>
                        <input  readonly="readonly" type="text" class="form-control"  value="{{old('slug_theloai')}}" name="slug_theloai" id="convert_slug" placeholder="Slug thể loại...">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Mô tả thể loại</label>
                        <input type="text" class="form-control" value="{{old('mota')}}" name="mota" id="exampleInputEmail1" placeholder="Mô tả thể loại...">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kích hoạt</label>
                        <select name="kichhoat" class="custom-select">
                            <option value="0">Kích hoạt</option>
                            <option value="1">Không kích hoạt</option>
                        </select>
                    </div>

                    <button type="submit" name="themtheloai" class="btn btn-primary">Thêm</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
