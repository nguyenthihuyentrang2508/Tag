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
                <div class="card-header">Danh sách truyện của Thể loại {{$theloai->tentheloai}}</div>
               

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
                        $count_truyen = count($list_truyen);
                    @endphp
                    
                 <div style="width: 100%">   
                    <h5 class="float-left"> Tổng số truyện <span style="color: blue"> ({{$count_truyen}}) <span></h5>
                    <a href="{{route('truyen.create')}}" class="btn btn-success float-right mr-2 mb-2">Thêm truyện</a>
                 </div>
                 <div style="clear: both;"></div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>                              
                                <th scope="col">Tên truyện</th>                             
                               
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                        @foreach($list_truyen as $key => $truyen)
                            <tr>
                                <th scope="row">{{$key}}</th>                              
                                <td><a href="{{url('xem-chapter/'.$truyen->slug_chapter)}}">{{$truyen->tentruyen}}</a></td>
            
                                <td> 
                                   
                                    <a href="{{route('truyen.edit',[$truyen -> id])}}" class="btn btn-primary float-left mr-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('truyen.destroy',[ $truyen -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa truyện này không?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
