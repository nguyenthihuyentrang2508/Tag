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
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liệt kê chapter truyện</div>

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
                                <th scope="col">Tên chapter</th>
                                <th scope="col">Url chapter</th>
                                <th scope="col">Ảnh bìa truyện</th>
                                <th scope="col">Tóm tắt</th>
                                <th scope="col">Thuộc truyện</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày cập nhật</th>
                                <th scope="col">Kích hoạt</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                        @foreach($chapter as $key => $chap)
                            <tr>
                                <th scope="row">{{$key}}</th>                              
                                <td><a href="{{url('xem-chapter/'.$chap->slug_chapter)}}">{{$chap->tieude}}</a></td>
                                <td>{{$chap->slug_chapter}}</td>
                                <td><img src="{{asset('public/uploads/truyen/'.$chap->truyen->hinhanh)}}" height="120" width="80" alt=""></td>
                                <td style="width: 25%"><p class="resomer">{{$chap->tomtat}}</p></td>
                                <td>{{$chap->truyen->tentruyen}}</td>
                                <td>{{$chap->created_at}} - {{ $chap->created_at->diffForHumans()}}</td>

                                @if($chap->updated_at != '')
                                    <td>{{$chap->updated_at}} - {{ $chap->updated_at->diffForHumans()}}</td>   
                                @else
                                    <td>Chưa có thời gian cập nhật</td>
                                @endif 
                                
                                <td>
                                    @if($chap->kichhoat==0)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text text-danger">Không kích hoạt</span>
                                    @endif    
                                </td>
                                <td>
                                    <a href="{{route('chapter.edit',[$chap -> id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('chapter.destroy',[ $chap -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa chapter truyện này không?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
