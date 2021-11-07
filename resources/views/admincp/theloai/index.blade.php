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
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Liệt kê thể loại truyện</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert  alert-dismissable alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('status') }}
                        </div>
                    @endif

                    @php 
                        $count_theloai = count($theloai);
                    @endphp
                     
                    <div style="width: 100%"> 
                    @if($count_theloai)        
                        <h5 class="float-left"> Tổng số thể loại <span style="color: blue"> ({{$count_theloai}}) <span></h5>
                    @endif    
                        <a href="{{route('theloai.create')}}" class="btn btn-dark float-right mr-2 mb-2">Thêm thể loại</a>
                    </div>
                 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên thể loại</th>
                                <th scope="col">Slug thể loại</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Kích hoạt</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                        @foreach($theloai as $key => $theloai)
                            <tr>
                                <th scope="row">{{$key}}</th>
                                <td>{{$theloai->tentheloai}}</td>
                                <td>{{$theloai->slug_theloai}}</td>
                                <td style="width: 25%"><p class="resomer">{{$theloai->mota}}</p></td>
                                <td>
                                    @if($theloai->kichhoat==0)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text text-danger">Không kích hoạt</span>
                                    @endif    
                                </td>
                                <td>
                                    <a href="{{route('theloai.show',[$theloai -> id])}}" class="btn btn-success float-left mr-2"><i class="fas fa-bars"></i></a>                            
                                    <a href="{{route('theloai.edit',[$theloai -> id])}}" class="btn btn-primary float-left mr-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('theloai.destroy',[ $theloai -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa thể loại này không?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach    
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
