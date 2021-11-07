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
                <div class="card-header">Liệt kê danh mục truyện</div>

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
                        $count_danhmuc = count($danhmuctruyen);
                    @endphp
                     
                    <div style="width: 100%"> 
                    @if($count_danhmuc)        
                        <h5 class="float-left"> Tổng số thể loại <span style="color: blue"> ({{$count_danhmuc}}) <span></h5>
                    @endif    
                        <a href="{{route('danhmuc.create')}}" class="btn btn-dark float-right mr-2 mb-2">Thêm danh mục</a>
                    </div>
                 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Slug danh mục</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Kích hoạt</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                        @foreach($danhmuctruyen as $key => $danhmuc)
                            <tr>
                                <th scope="row">{{$key}}</th>
                                <td>{{$danhmuc->tendanhmuc}}</td>
                                <td>{{$danhmuc->slug_danhmuc}}</td>
                                <td style="width: 25%"><p class="resomer">{{$danhmuc->mota}}</p></td>
                                <td>
                                    @if($danhmuc->kichhoat==0)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text text-danger">Không kích hoạt</span>
                                    @endif    
                                </td>
                                <td>
                                    <a href="{{route('danhmuc.show',[$danhmuc -> id])}}" class="btn btn-success float-left mr-2"><i class="fas fa-bars"></i></a>
                                    <a href="{{route('danhmuc.edit',[$danhmuc -> id])}}" class="btn btn-primary float-left mr-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('danhmuc.destroy',[ $danhmuc -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
