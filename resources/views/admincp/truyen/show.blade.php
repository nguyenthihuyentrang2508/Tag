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
        <div class="col-md-10" style="margin-top: 20px;">
        <style>
                .breadcrumb{
                    background: white;
                }
            </style>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm" style="border: 1px solid rgba(0,0,0,.125);">
                    <li class="breadcrumb-item"><a href="{{route('truyen.index')}}">Danh sách truyện</a></li>
                    <li class="breadcrumb-item"><a href="{{url('xem-truyen/'.$truyen->slug_truyen)}}">{{$truyen->tentruyen}}</a></li>
                    <li class="breadcrumb-item" aria-current="page">Danh sách chương</li>
                </ol>
            </nav>

            <div class="card">
            <div class="card-header shadow-sm" style="background: white; font-size: 18px"><a href="{{route('truyen.show',[$truyen->id])}}">{{$truyen->tentruyen}} </a>- Quản lý chương</div>
               

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
                        $count_chapter = count($chapter);
                    @endphp
                    @if($count_chapter)        
                 <div style="width: 100%">   
                    <h5 class="float-left"> Tổng số chương <span style="color: blue"> ({{$count_chapter}}) <span></h5>
                    <a href="{{url('/chapter/create',[$truyen->id])}}" class="btn btn-success float-right mr-2 mb-2">Thêm chương</a>
                 </div>
                 <div style="clear: both;"></div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>                              
                                <th scope="col">Tên chương</th>                             
                               
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                        @foreach($chapter as $key => $truyen)
                            <tr>
                                <th scope="row">{{$key+1}}</th>                              
                                <td><a href="{{url('xem-chapter/'.$truyen->truyen->slug_truyen.'/'.$truyen->slug_chapter)}}">{{$truyen->tieude}}</a></td>
            
                                <td>                             
                                    <a href="{{route('chapter.edit',[$truyen -> id])}}" class="btn btn-primary float-left mr-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('chapter.destroy',[ $truyen -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa chương này không?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach    
                        </tbody>
                    </table>
                    
                </div>
                @else
                    @php 
                        $count_chaptertranh = count($chaptertranh);
                    @endphp
                 <div style="width: 100%">   
                    <h5 class="float-left"> Tổng số chương <span style="color: blue"> ({{$count_chaptertranh}}) <span></h5>
                    <a href="{{url('chaptertranh/create',[$truyen->id])}}" class="btn btn-success float-right mr-2 mb-2">Thêm chương</a>
                 </div>
                 <div style="clear: both;"></div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>                              
                                <th scope="col">Tên chương</th>                             
                                
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                       
                        @if($truyen->danhmuctruyen->danhmuc_id = 1)

                        <tbody>
                        @foreach($chaptertranh as $key => $truyen)
                            <tr>
                                <th scope="row">{{$key+1}}</th>                              
                                <td><a href="{{url('xem-chapter-tranh/'.$truyen->truyen->slug_truyen.'/'.$truyen->slug_chaptertranh)}}">{{$truyen->tieude}}</a></td>
            
                                <td>                             
                                    <a href="{{route('chaptertranh.edit',[$truyen -> id])}}" class="btn btn-primary float-left mr-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('chaptertranh.destroy',[ $truyen -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa chương này không?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach    
                        </tbody>
                        @else
                        <tbody>
                        @foreach($chaptertranh as $key => $truyen)
                            <tr>
                                <th scope="row">{{$key}}</th>                              
                                <td><a href="{{url('xem-chapter-tranh/'.$truyen->truyen->slug_truyen.'/'.$truyen->slug_chaptertranh)}}">{{$truyen->tieude}}</a></td>
            
                                <td>                             
                                    <a href="{{route('chaptertranh.edit',[$truyen -> id])}}" class="btn btn-primary float-left mr-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('chaptertranh.destroy',[ $truyen -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa chương này không?')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach    
                        </tbody>
                        @endif
                    </table>
                    
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
