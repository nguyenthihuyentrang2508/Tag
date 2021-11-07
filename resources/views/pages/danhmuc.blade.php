@extends('../layout')
@section('content')
<style>
  .breadcrumb{
    background: none;
  }
</style>
<script>   
    $(document).ready(function(){
      $(".button_tatca").click(function(){
        $("#tatca").fadeIn(0.5);
        $("#truyen_chuahoan").fadeOut(0.5);
        $("#truyen_dahoan").fadeOut(0.5);

        $("#nav_tatca").fadeIn(0.5);
        $("#nav_hoan").fadeOut(0.5);
        $("#nav_chuahoan").fadeOut(0.5);
        
      });
    });

    $(document).ready(function(){
      $(".button_dahoan").click(function(){
        $("#truyen_dahoan").fadeIn(0.5);
        $("#tatca").fadeOut(0.5);
        $("#truyen_chuahoan").fadeOut(0.5);

        $("#nav_hoan").fadeIn(0.5);
        $("#nav_tatca").fadeOut(0.5);       
        $("#nav_chuahoan").fadeOut(0.5);
      });
    });  

    $(document).ready(function(){
      $(".button_chuahoan").click(function(){
        $("#truyen_chuahoan").fadeIn(0.5);
        $("#tatca").fadeOut(0.5);
        $("#truyen_dahoan").fadeOut(0.5);
        
        $("#nav_chuahoan").fadeIn(0.5);
        $("#nav_tatca").fadeOut(0.5);
        $("#nav_hoan").fadeOut(0.5);
       
      });
    }); 
</script>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb shadow-sm">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
    <li class="breadcrumb-item" aria-current="page">{{$danhmuc_id->tendanhmuc}}</li>
  </ol>
</nav>

	<div class="row p-0">
		<div class="col-8 m-0">
            <p class="mt-4 m-0 text-center" style="font-size: 145%;">Danh mục<b class="ml-1">{{$danhmuc_id->tendanhmuc}}</b></p>
            <p class="p-3" style="border: 1px solid #D3D3D3">{{$danhmuc_id->mota}}</p>
<style type="text/css">
.btn1 {
  border: none;
  outline: none;
  padding: 10px 16px;
  background-color: #D3D3D3;
  cursor: pointer;
  color: white;
}
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

.active, .btn1:hover {
  background-color: #ff631c;
  color: white;
}
</style>

  <div>
    <p class="font-weight-bold m-0 text-center" style="font-size: 16px">Trạng thái:</p>
    <!-- <div class="table-responsive"> -->
      <div class="text-center" id="nav_tatca">
        <button class="button_tatca btn1 active pl-2 pr-2 pt-0 pb-0 mr-1" id=""style="font-size: 14px">Tất cả</button>
        <button class="button_dahoan btn1 pl-2 pr-2 pt-0 pb-0 mr-1" id="" style="font-size: 14px">Hoàn thành</button>
        <button class="button_chuahoan btn1 pl-2 pr-2 pt-0 pb-0 mr-1" id="" style="font-size: 14px">Đang tiến hành</button>
      </div>
      <div class="text-center" id="nav_hoan" style="display: none">
        <button class="button_tatca btn1 pl-2 pr-2 pt-0 pb-0 mr-1" id=""style="font-size: 14px">Tất cả</button>
        <button class="button_dahoan active btn1 pl-2 pr-2 pt-0 pb-0 mr-1" id="" style="font-size: 14px; ">Hoàn thành</button>
        <button class="button_chuahoan btn1 pl-2 pr-2 pt-0 pb-0 mr-1" id="" style="font-size: 14px">Đang tiến hành</button>
      </div>
      <div class="text-center" id="nav_chuahoan" style="display: none">
        <button class="button_tatca btn1  pl-2 pr-2 pt-0 pb-0 mr-1" id=""style="font-size: 14px">Tất cả</button>
        <button class="button_dahoan btn1 pl-2 pr-2 pt-0 pb-0 mr-1" id="" style="font-size: 14px">Hoàn thành</button>
        <button class="button_chuahoan active btn1 pl-2 pr-2 pt-0 pb-0 mr-1" id="" style="font-size: 14px">Đang tiến hành</button>
      </div>
    <!-- </div> -->
  </div>

  <div class="mt-2">
    <p class="font-weight-bold m-0 text-center" style="font-size: 16px">Sắp xếp theo:</p>

    <div>
      <div id="myDIV" class="m-0 text-center">
        <button class="btn1 active pl-2 pr-2 pt-0 pb-0 mr-1" style="font-size: 14px">Mới cập nhật</button>
        <button class="btn1 pl-2 pr-2 pt-0 pb-0 mr-1" style="font-size: 14px">Truyện mới đăng</button>
      </div>
    </div>

  </div>

<style type="text/css">
  #ex1{
  border: 1px solid #ff631c;
  outline: none;
  padding: 10px 16px;
  background-color: white;
  cursor: pointer;
  color: #ff631c;
  }
  .active, #ex1:hover {
  background-color: #ff631c;
  color: white;
}
a:hover{
          text-decoration: none;
        }
        .resomer p{
          width: 500px;
          overflow: hidden;
          white-space: nowrap; 
          text-overflow: ellipsis;
        }
        
</style>

  
  <div style="clear: both;"></div>
@php
$count = count($truyen);
@endphp

@if($count==0)
<div class="card-body mt-3 bg-warning text-white text-center m-0">
    <p class="m-0 font-weight-bold">Truyện đang cập nhật... </p>
    <i class="fas fa-exclamation-triangle mt-2" style="font-size: 145%;"></i>
</div>

@else
      <div class="row p-0 mt-3" id="tatca">
        <div class="col-12">
            <h5 class="font-weight-bold">Tất Cả Truyện</h5>
        </div>
@foreach($truyen as $key => $value)
		<div class="col-6 m-0">
          <div class="mb-2">
             
                    <div class="row m-0 text-left " >
                    
                      <div class="post_story_box  mb-2" style=" width: 100%;">
                        <div class=" shadow-sm" style="width: 100%;border-radius: 8px;">
                      <div class="image_book_box float-left" style="width: 35%;">
                        <img  src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" width="100%" height="180px" style="border-radius: 8px">
                      </div>
                      <div class="image_book_box pl-2 float-right" style="width: 65%;">

                      <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                        <p class="title_story mb-0 font-weight-bold" style="font-size: 110%;margin-top: 5px;">{{$value->tentruyen}}</p>
                        <!-- @php
                        $count_chapter = count($value->chapter);
                        
                        @endphp
                        @if($count_chapter)
                        <p class="m-0" style="font-size: 100%">Chương {{$count_chapter}}</p>
                        @else
                        <p class="m-0 text-danger">Hiện tại chưa có chương mới...</p>
                        @endif -->
                      </a>  
                        <div class="tag_box">
                      
                        @foreach($value->thuocnhieutheloaitruyen as $thuocloai)
                        <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><div class="btn mt-1 mb-1 font-weight-bold" style="font-size: 12px; background: #ff631c; color: white;padding: 0px 5px 0px 5px;">{{$thuocloai->tentheloai}}</div></a>
                        @endforeach
                      
                      </div>
                        <p class="resomer m-0">Nội dung: {{$value->tomtat}}...</p>
                        <p style="font-size: 85%; color:gray" class="comment_story m-0" > <i class="fa fa-eye mr-1"></i> {{ views($value)->count() }} lượt xem</p>
                        
                      </div>
                      <div style="clear: both;"></div>
                      </div>
                    </div>
                </div>
                
            </div>
        </div>
@endforeach
        

      </div>  


    
 <div class=" row p-0 mt-3" id="truyen_dahoan" style="display: none">
        <div class="col-12">
            <h5 class="font-weight-bold">Truyện Đã Hoàn Thành</h5>
        </div>
@foreach($truyen_dahoan as $key => $value)
       
		<div class="col-6 m-0">
          <div class="mb-2">
             
                    <div class="row m-0 text-left " >
                    
                      <div class="post_story_box  mb-2" style=" width: 100%;">
                        <div class=" shadow-sm" style="width: 100%;border-radius: 8px;">
                      <div class="image_book_box float-left" style="width: 35%;">
                        <img  src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" width="100%" height="180px" style="border-radius: 8px">
                      </div>
                      <div class="image_book_box pl-2 float-right" style="width: 65%;">

                      <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                        <p class="title_story mb-0 font-weight-bold" style="font-size: 110%;margin-top: 5px;">{{$value->tentruyen}}</p>
                        <!-- @php
                        $count_chapter = count($value->chapter);
                        @endphp
                        @if($count_chapter)
                        <p class="m-0" style="font-size: 100%">Chương {{$count_chapter}}</p>
                        @else
                        <p class="m-0 text-danger">Hiện tại chưa có chương mới...</p>
                        @endif -->
                      </a>  
                        <div class="tag_box">
                      
                        @foreach($value->thuocnhieutheloaitruyen as $thuocloai)
                        <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><div class="btn mt-1 mb-1 font-weight-bold" style="font-size: 12px; background: #ff631c; color: white;padding: 0px 5px 0px 5px;">{{$thuocloai->tentheloai}}</div></a>
                        @endforeach
                      
                      </div>
                        <p class="resomer m-0">Nội dung: {{$value->tomtat}}...</p>
                        <p style="font-size: 85%; color:gray" class="comment_story m-0" > <i class="fa fa-eye mr-1"></i> {{ views($value)->count() }} lượt xem</p>
                        
                      </div>
                      <div style="clear: both;"></div>
                      </div>
                    </div>
                </div>
                
            </div>
        </div>
@endforeach
        
      
       


      </div>  

      <div class=" row p-0 mt-3" id="truyen_chuahoan" style="display: none">
      <div class="col-12">
            <h5 class="font-weight-bold">Truyện Đang Tiến Hành</h5>
        </div>
@foreach($truyen_chuahoan as $key => $value)
       
		<div class="col-6 m-0">
          <div class="mb-2">
             
                    <div class="row m-0 text-left " >
                    
                      <div class="post_story_box  mb-2" style=" width: 100%;">
                        <div class=" shadow-sm" style="width: 100%;border-radius: 8px;">
                      <div class="image_book_box float-left" style="width: 35%;">
                        <img  src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" width="100%" height="180px" style="border-radius: 8px">
                      </div>
                      <div class="image_book_box pl-2 float-right" style="width: 65%;">

                      <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                        <p class="title_story mb-0 font-weight-bold" style="font-size: 110%;margin-top: 5px;">{{$value->tentruyen}}</p>
                        <!-- @php
                        $count_chapter = count($value->chapter);
                        @endphp
                        @if($count_chapter)
                        <p class="m-0" style="font-size: 100%">Chương {{$count_chapter}}</p>
                        @else
                        <p class="m-0 text-danger">Hiện tại chưa có chương mới...</p>
                        @endif -->
                      </a>  
                        <div class="tag_box">
                      
                        @foreach($value->thuocnhieutheloaitruyen as $thuocloai)
                        <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><div class="btn mt-1 mb-1 font-weight-bold" style="font-size: 12px; background: #ff631c; color: white;padding: 0px 5px 0px 5px;">{{$thuocloai->tentheloai}}</div></a>
                        @endforeach
                      
                      </div>
                        <p class="resomer m-0">Nội dung: {{$value->tomtat}}...</p>
                        <p style="font-size: 85%; color:gray" class="comment_story m-0" > <i class="fa fa-eye mr-1"></i> {{ views($value)->count() }} lượt xem</p>
                        
                      </div>
                      <div style="clear: both;"></div>
                      </div>
                    </div>
                </div>
                
            </div>
        </div>
@endforeach
        
      
       


      </div>  
      
      <div class="mt-1">
    <p class="font-weight-bold m-0 text-center" style="font-size: 16px">Danh sách trang</p>
     <div class="text-center" id="myDIV">
        <button class="btn active pl-2 pr-2 pt-0 pb-0 mr-1" id="ex1" style="font-size: 14px">1</button>
        <button class="btn pl-2 pr-2 pt-0 pb-0 mr-1" id="ex1"  style="font-size: 14px">2</button>
        <button class="btn pl-2 pr-2 pt-0 pb-0 mr-1" id="ex1"  style="font-size: 14px">3</button>
        <button class="btn pl-2 pr-2 pt-0 pb-0 mr-1" id="ex1"  style="font-size: 14px">4</button>
        <button class="btn pl-2 pr-2 pt-0 pb-0 mr-1" id="ex1"  style="font-size: 14px">5</button>
        <button class="btn pl-2 pr-2 pt-0 pb-0 mr-1" id="ex1"  style="font-size: 14px">6</button>
        <button class="btn pl-2 pr-2 pt-0 pb-0 mr-1" id="ex1"  style="font-size: 14px">...</button>
        <button class="btn pl-2 pr-2 pt-0 pb-0 mr-1" id="ex1"  style="font-size: 14px">991</button>
      </div>
  </div>
@endif			

     
      


  <style>
    .list-group-item-action:hover{
      font-weight: bold;
    }
  </style>  
 		

		
			
		</div>

        <div class="col-4 m-0">
            <div class="box">
                <div class="box_content">
                   <!-- List group -->
                    <div class="list-group m-0" id="myList" role="tablist">
                    
                        <a style=" background: #ff631c; color: white;" class="list-group-item list-group-item-action"><h5 class="m-0">Tất cả Danh mục</h5></a>
                        @foreach($danhmuc as $key => $danh)
                        <a class="list-group-item list-group-item-action" href="{{url('danh-muc/'.$danh->slug_danhmuc)}}">{{$danh->tendanhmuc}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
          
      

      

          
           </div>
      
      </div>



      <style type="text/css">
          .delete:hover{
              color: #ff631c;
          }
      </style>

     

        





           

        



    </div>


</div>
@endsection        