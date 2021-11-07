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
                <div class="card-header">Liệt kê bình luận bị báo cáo</div>
               

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert  alert-dismissable alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            {{ session('status') }}
                        </div>
                    @endif
                    @role('admin') 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>                              
                                <th scope="col">Tên người bình luận</th>  
                                <th scope="col">Ở truyện</th>                                 
                                <th scope="col">Nội dung bình luận</th>   
                                <th scope="col">Lý do</th>   
                                <th scope="col">Quản lý</th>   
                            </tr>
                        </thead>
                       
                        <tbody>
                         
                        @foreach($comment as $key => $com)
                            <tr>
                                <th scope="row">{{$key}}</th>                              
                                <th scope="row">{{$com->comment->user->name}}</th>  
                                <th scope="row">{{$com->comment->truyen->tentruyen}}</th>     
                                <th scope="row">{{$com->comment->body}}</th> 
                                <th scope="row">Không có</th>    
                                <td>
                                    <form action="{{route('reportcomment.destroy',[ $com -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa bình luận này không?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
