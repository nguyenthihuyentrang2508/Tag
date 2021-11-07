@extends('layouts.app')

@section('content')
@include('layouts.nav')
<style>
    .resomer{
          width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 25px;
    -webkit-line-clamp: 2;
    height: 55px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
        }
</style>
<div class="container-fluid mt-2" style="margin-left: 120px">
    <div class="row justify-content-center">
        <div class="col-md-10" style="margin-top: 20px">
            <div class="card">
                <div class="card-header shadow-sm" style="background: white; font-size: 18px">Danh sách truyện</div>
               
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert  alert-dismissable alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            {{ session('status') }}
                        </div>
                    @endif
                 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>                              
                                <th scope="col">Tên truyện</th>                             
                                <th scope="col">Ảnh bìa</th>
                                <!-- <th scope="col">Tác giả</th> -->
                                <th scope="col">Người đăng</th>
                                <!-- <th scope="col">Tóm tắt</th> -->
                                <th scope="col">Danh mục</th>
                                <!-- <th scope="col">Thể loại</th>
                                <th scope="col">Tình trạng</th> -->
                                <th scope="col">Ngày tạo</th>
                                <!-- <th scope="col">Ngày cập nhật</th> -->
                                <th scope="col">Kích hoạt</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                        @role('uploader|admin')    
                        @foreach($list_truyen as $key => $truyen)
                        <tr>
                                <th scope="row">{{$key+1}}</th>                              
                                <td><a href="{{url('xem-truyen/'.$truyen->slug_truyen)}}">{{$truyen->tentruyen}}</a></td>
                                <td><img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" height="120" width="80" alt=""></td>                             
                                <!-- <td>{{$truyen->tacgia}}</td> -->
                                <td>{{$truyen->thuocnhieuuser->name}}</td>
                                <!-- <td style="width: 20%"><p  class="resomer">{{$truyen->tomtat}}</p></td> -->
                                <td>{{$truyen->danhmuctruyen->tendanhmuc}}</td>
                                <!-- <td>
                                @foreach($truyen->thuocnhieutheloaitruyen as $thuocloai)
                                    <span class="badge badge-secondary">{{$thuocloai->tentheloai}}</span>
                                @endforeach
                                </td> -->
                                <!-- <td>
                                    @if($truyen->tinhtrang==0)
                                        <span class="text text-danger">Đang tiến hành</span>
                                    @else
                                        <span class="text text-success">Đã hoàn thành</span>
                                    @endif    
                                </td> -->

                                <td>{{$truyen->created_at}} - {{ $truyen->created_at->diffForHumans()}}</td>
                                <td>
                                    @if($truyen->kichhoat==0)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text text-danger">Không kích hoạt</span>
                                    @endif    
                                </td>
                                <td>
                                    <a href="{{route('truyen.show',[$truyen -> id])}}" class="btn btn-success"><i class="fas fa-bars"></i></a>
                                    <a href="{{route('truyen.edit',[$truyen -> id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('truyen.destroy',[ $truyen -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa truyện này không?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @endrole
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
