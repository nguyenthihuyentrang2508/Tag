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
.breadcrumb{
    background: white;
}    
</style>
<div class="container-fluid mt-2" style="margin-left: 120px">
    <div class="row justify-content-center">
        <div class="col-md-10" style="margin-top: 20px">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm" style="border: 1px solid rgba(0,0,0,.125);">
                    <li class="breadcrumb-item"><a href="{{route('truyen.index')}}">Danh sách truyện</a></li>
                    <li class="breadcrumb-item" aria-current="page">Tìm kiếm truyện</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header shadow-sm" style="background: white; font-size: 18px">
                   <div class="float-left"> Danh sách truyện </div>
                   <div class="float-right"><a href="{{route('truyen.index')}}" ><i class="fas fa-arrow-left"></i></a></div>
                   <div style="clear: both;"></div>
                </div>
               
                <li class="mr-3" style="list-style-type: none">
                    <h5 class="ml-4 mt-2 mb-2">Tìm kiếm truyện</h5>
		        	<form autocomplete="off" class="box p-2 ml-4" style="background: white; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;" action="{{url('tim-kiem-admin')}}" method="POST">   
                @csrf
                        <div class="dropdown">
                            <input type="search" name="tukhoa" id="keywords" placeholder="Tìm truyện..." class="border-0" style="width: 70%;" />			         
                        <button class="btn float-right m-0 p-0" type="submit"><span class="icon pl-2 mr-2" style="width: 15px; border-left: 1px solid #D3D3D3"><i class="fa fa-search"></i></span></button>
                        <div id="search_ajax"></div>
                        <div style="clear: both;"></div>
                        </div>
                    </form>
		        </li> 

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
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>                              
                                <th scope="col">Tên truyện</th>                             
                                <th scope="col">Ảnh bìa</th>
                                <!-- <th scope="col">Tác giả</th>                               -->
                                <th scope="col">Lượt xem</th>
                                <th scope="col">Danh mục</th>
                                <!-- <th scope="col">Thể loại</th>
                                <th scope="col">Tình trạng</th> -->
                                <th scope="col">Truyện nổi bật</th>
                                <!-- <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày cập nhật</th> -->
                                <th scope="col">Kích hoạt</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                         
                        @foreach($list_truyen as $key => $truyen)
                            <tr>
                                <th scope="row">{{$key}}</th>                              
                                <td><a href="{{url('xem-truyen/'.$truyen->slug_truyen)}}">{{$truyen->tentruyen}}</a></td>
                                <td><img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" height="120" width="80" alt=""></td>                             
                                <!-- <td>{{$truyen->tacgia}}</td> -->
                               
                               
                                <td>{{ views($truyen)->count() }} lượt xem</td>
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

                                <td  style="width: 15%">
                                    @if($truyen->truyen_noibat==0)
                                    <form> 
                                     @csrf   
                                        <select name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="custom-select truyennoibat">
                                            <option selected value="0">Truyện mới</option>
                                            <option value="1">Truyện Top ngày</option>
                                            <option value="2">Truyện Top tuần</option>
                                            <option value="3">Truyện Top tháng</option>
                                        </select>   
                                    </form>
                                    @elseif($truyen->truyen_noibat==1)
                                    <form> 
                                     @csrf
                                        <select name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="custom-select truyennoibat">
                                            <option value="0">Truyện mới</option>
                                            <option selected value="1">Truyện Top ngày</option>
                                            <option value="2">Truyện Top tuần</option>
                                            <option value="3">Truyện Top tháng</option>
                                        </select>  
                                    </form>
                                    @elseif($truyen->truyen_noibat==2)
                                    <form> 
                                     @csrf
                                        <select name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="custom-select truyennoibat">
                                            <option value="0">Truyện mới</option>
                                            <option value="1">Truyện Top ngày</option>
                                            <option selected value="2">Truyện Top tuần</option>
                                            <option value="3">Truyện Top tháng</option>
                                        </select>
                                    </form>      
                                    @else
                                    <form> 
                                     @csrf
                                        <select name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="custom-select truyennoibat">
                                            <option value="0">Truyện mới</option>
                                            <option value="1">Truyện Top ngày</option>
                                            <option value="2">Truyện Top tuần</option>
                                            <option selected value="3">Truyện Top tháng</option>
                                        </select> 
                                    </form> 
                                    @endif    
                                </td>

                                <!-- <td>{{$truyen->created_at}} - {{ $truyen->created_at->diffForHumans()}}</td>
                                @if($truyen->updated_at != '')
                                    <td>{{$truyen->updated_at}} - {{ $truyen->updated_at->diffForHumans()}}</td>   
                                @else
                                    <td>Chưa có thời gian cập nhật</td> -->
                                <!-- @endif  -->
                                <td>
                                    @if($truyen->kichhoat==0)
                                        <span class="text text-success">Kích hoạt</span>
                                    @else
                                        <span class="text text-danger">Không kích hoạt</span>
                                    @endif    
                                </td>
                                <td>
                                    <a href="{{route('truyen.show',[$truyen -> id])}}" class="btn btn-success float-left mr-2"><i class="fas fa-bars"></i></a>
                                    <a href="{{route('truyen.edit',[$truyen -> id])}}" class="btn btn-primary float-left mr-2"><i class="fas fa-edit"></i></a>
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
<script type="text/javascript">
 $('#keywords').keyup(function(){
          var keywords = $(this).val();

            if(keywords != '')
              {
               var _token = $('input[name="_token"]').val();

               $.ajax({
                url:"{{url('/timkiem-ajax-admin')}}",
                method:"POST",
                data:{keywords:keywords, _token:_token},
                success:function(data){
                 $('#search_ajax').fadeIn();  
                  $('#search_ajax').html(data);
                }
               });

              }else{

                $('#search_ajax').fadeOut();  
              }
          });

          $(document).on('click', '.li_timkiem_ajax', function(){  
              $('#keywords').val($(this).text());  
              $('#search_ajax').fadeOut();  
          }); 
</script>
@endsection
