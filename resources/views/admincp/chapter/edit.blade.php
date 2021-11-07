@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container-fluid mt-2" style="margin-left: 120px">
    <div class="row justify-content-center">
        <div class="col-md-10"  style="margin-top: 20px;">
            <style>
                .breadcrumb{
                    background: white;
                }
            </style>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm" style="border: 1px solid rgba(0,0,0,.125);">
                    <li class="breadcrumb-item"><a href="{{route('truyen.index')}}">Danh sách truyện</a></li>
                    <li class="breadcrumb-item"><a href="{{url('xem-chapter/'.$chapter->truyen->slug_truyen.'/'.$chapter->slug_chapter)}}">{{$chapter->truyen->tentruyen}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('truyen.show',[$chapter->truyen->id])}}">Danh sách chương</a></li>
                    <li class="breadcrumb-item" aria-current="page">{{$chapter->tieude}}</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header shadow-sm" style="background: white; font-size: 18px"><a href="{{route('truyen.show',[$chapter->truyen->id])}}">{{$chapter->truyen->tentruyen}} </a>- Cập nhật chương truyện</div>

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

                    <form method="POST" action="{{route('chapter.update',[$chapter->id])}}">
                        @method('PUT')
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên chương<span class="ml-1" style="color: red">*</span></label>
                        <input type="text" class="form-control"  value="{{$chapter->tieude}}" name="tieude" onkeyup="ChangeToSlug();" id="slug">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Url chương<span class="ml-1" style="color: red">*</span></label>
                        <input readonly="readonly" type="text" class="form-control"  value="{{$chapter->slug_chapter}}" name="slug_chapter" id="convert_slug">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tóm tắt</label>
                        <input type="text" class="form-control" value="{{$chapter->tomtat}}" name="tomtat">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung<span class="ml-1" style="color: red">*</span></label>
                        <textarea name="noidung"  id="noidung_chapter" class="form-control" rows="5" style="resize: none;">{{$chapter->noidung}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Thuộc truyện</label>
                        <select name="truyen_id" class="custom-select">
                            @foreach($truyen as $key => $value)                          
                                <option {{$chapter->truyen_id==$value->id ? 'selected' : ''}} value="{{$value->id}}">{{$value->tentruyen}}</option>
                            @endforeach
                        </select>
                    </div>

                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kích hoạt</label>
                        <select name="kichhoat" class="custom-select">
                            @if($chapter->kichhoat==0)
                                <option selected value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                            @else
                                <option value="0">Kích hoạt</option>
                                <option selected value="1">Không kích hoạt</option>
                            @endif
                        </select>
                    </div>

                    <button type="submit" name="themchapter" class="btn btn-primary">Cập nhật</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
