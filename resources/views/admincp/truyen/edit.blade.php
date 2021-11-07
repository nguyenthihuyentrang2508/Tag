@extends('layouts.app')

@section('content')
@include('layouts.nav')
<style>
    [type="file"] {
/* Style the color of the message that says 'No file chosen' */
  color: #878787;
}
[type="file"]::-webkit-file-upload-button {
  background:  #ff631c;
  border: 2px solid #ff631c;
  border-radius: 4px;
  color: #fff;
  cursor: pointer;
  font-size: 12px;
  outline: none;
  padding: 5px 20px;
  text-transform: uppercase;
  transition: all 1s ease;
}

[type="file"]::-webkit-file-upload-button:hover {
  background: #fff;
  border: 2px solid #535353;
  color: #000;
}
</style>
<div class="container-fluid mt-2" style="margin-left: 120px">
    <div class="row justify-content-center">
        <div class="col-md-10" style="margin-top: 20px">

        <style>
                .breadcrumb{
                    background: white;
                }
            </style>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm" style="border: 1px solid rgba(0,0,0,.125);">
                    <li class="breadcrumb-item"><a href="{{route('truyen.index')}}">Danh sách truyện</a></li>
                    <li class="breadcrumb-item"><a href="{{url('xem-truyen/'.$truyen->slug_truyen)}}">{{$truyen->tentruyen}}</a></li>
                    <li class="breadcrumb-item" aria-current="page">Update truyện</li>
                </ol>
            </nav>

            <div class="card">
            <div class="card-header shadow-sm" style="background: white; font-size: 18px">Cập nhật truyện</div>

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

                    <form method="POST" action="{{route('truyen.update',[$truyen->id])}}" enctype="multipart/form-data">
                    @method('PUT')   
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên truyện</label>
                        <input type="text" class="form-control"  value="{{$truyen->tentruyen}}" name="tentruyen" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên truyện...">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Url truyện</label>
                        <input readonly="readonly" type="text" class="form-control"  value="{{$truyen->slug_truyen}}" name="slug_truyen" id="convert_slug" placeholder="Tên truyện...">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Thông báo</label>
                        <input type="text" class="form-control"  value="{{$truyen->thongbao}}" name="thongbao" placeholder="Thông báo...">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tác giả</label>
                        <input type="text" class="form-control"  value="{{$truyen->tacgia}}" name="tacgia" placeholder="Tên tác giả...">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tóm tắt truyện</label>
                        <textarea name="tomtat" class="form-control" rows="5" style="resize: none;">{{$truyen->tomtat}}</textarea>
                    </div>

                    <div class="form-group" style="display: none">
                        <label for="exampleInputEmail1">Danh mục truyện</label>
                        <select name="danhmuc" class="custom-select">
                            @foreach($danhmuc as $key => $muc)                          
                                <option {{$muc->id==$truyen->danhmuc_id ? 'selected' : '' }} value="{{$muc->id}}">{{$muc->tendanhmuc}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <label for="exampleInputEmail1">Thể loại truyện</label>
                        <select name="theloai" class="custom-select">
                            @foreach($theloai as $key => $cate)                          
                                <option {{$cate->id==$truyen->theloai_id ? 'selected' : '' }} value="{{$cate->id}}">{{$cate->tentheloai}}</option>
                            @endforeach
                        </select>
                    </div> -->

                    

                   
                    <div class="form-group">
                        <label class="mr-3" for="exampleInputEmail1">Thể loại:</label>
                        @foreach($theloai as $key => $the)
                        <div class="form-check form-check-inline">                     
                            <input class="form-check-input"
                            @if( $thuoctheloai->contains($the->id) ) checked @endif
                            name="theloai[]" type="checkbox" id="theloai_{{$the->id}}" value="{{$the->id}}">
                            <label class="form-check-label" for="theloai_{{$the->id}}">{{$the->tentheloai}}</label>
                        </div>
                        @endforeach    
                    </div>
                   

                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Ảnh bìa truyện</label>
                        <input type="file" class="form-control-file" name="hinhanh">
                        <img class="mt-2" src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" height="150" width="100" alt="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tình trạng</label>
                        <select name="tinhtrang" class="custom-select">
                            @if($truyen->tinhtrang==0)
                                <option selected value="0">Đang tiến hành</option>
                                <option value="1">Đã hoàn thành</option>
                            @else
                                <option value="0">Đang tiến hhành</option>
                                <option selected value="1">Đã hoàn thành</option>
                            @endif
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kích hoạt</label>
                        <select name="kichhoat" class="custom-select">
                            @if($truyen->kichhoat==0)
                                <option selected value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                            @else
                                <option value="0">Kích hoạt</option>
                                <option selected value="1">Không kích hoạt</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Truyện nổi bật/hot</label>
                        <select name="truyennoibat" class="custom-select">
                            @if($truyen->truyen_noibat==0)
                                <option selected value="0">Truyện mới</option>
                                <option value="1">Truyện Top ngày</option>
                                <option value="2">Truyện Top tuần</option>
                                <option value="3">Truyện Top tháng</option>
                            @elseif($truyen->truyen_noibat==1)
                                <option value="0">Truyện mới</option>
                                <option selected value="1">Truyện Top ngày</option>
                                <option value="2">Truyện Top tuần</option>
                                <option value="3">Truyện Top tháng</option>
                            @elseif($truyen->truyen_noibat==2)
                                <option value="0">Truyện mới</option>
                                <option value="1">Truyện Top ngày</option>
                                <option selected value="2">Truyện Top tuần</option>
                                <option value="3">Truyện Top tháng</option>
                            @else
                                <option value="0">Truyện mới</option>
                                <option value="1">Truyện Top ngày</option>
                                <option value="2">Truyện Top tuần</option>
                                <option selected value="3">Truyện Top tháng</option>
                            @endif
                        </select>
                    </div>
                    

                    <button type="submit" name="themtruyen" class="btn btn-primary">Cập nhật</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
