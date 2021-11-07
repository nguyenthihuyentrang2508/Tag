@extends('../layout')
@section('slide')
    @include('pages.slide')
@endsection
@section('content')

<p class="mt-4 m-0" style="font-size: 145%; font-weight: bold">Cập nhật mới nhất</p>
	<div class="row p-0">
		<div class="col-8 m-0">
		
			<div>
				<div class="btn shadow-sm p-0 m-0" style="width: 100%; border-radius: 8px;" id="nav_chapter">
					<div class="button_newchapter btn p-2 border-0 float-left text-center w-50 font-weight-bold" style="background: #ff631c; color: white; border-radius: 8px ">Chương mới cập nhật</div>
					<div class="button_newstory  btn_color btn p-2 border-0 float-right text-center w-50 font-weight-bold" style="border-radius: 8px">Truyện mới đăng</div>
				</div>

        <div class="btn shadow-sm p-0 m-0" style="width: 100%; border-radius: 8px; display: none" id="nav_story">
					<div class="button_newchapter btn_color btn p-2 border-0 float-left text-center w-50 font-weight-bold" style="border-radius: 8px ">Chương mới cập nhật</div>
					<div class="button_newstory btn p-2 border-0 float-right text-center w-50 font-weight-bold" style="background: #ff631c; color: white; border-radius: 8px">Truyện mới đăng</div>
				</div>
			</div>

			<style>
        a:hover{
          text-decoration: none;
        }
        .resomer{
          width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 25px;
    -webkit-line-clamp: 2;
  
    display: -webkit-box;
    -webkit-box-orient: vertical;
        }
        .resomer1{
    width: 90%;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 25px;
    -webkit-line-clamp: 1;
    display: -webkit-box;
    -webkit-box-orient: vertical;
        }
      </style>

<script>
   $(document).ready(function(){
      $(".button_newstory").click(function(){
        $("#new_story").fadeIn(0.5);
        $("#nav_story").fadeIn(0.5);      
          
        $("#nav_chapter").fadeOut(0.5);
        $("#new_chapter").fadeOut(0.5);
      });
    }); 
   $(document).ready(function(){
      $(".button_newchapter").click(function(){   
        $("#new_chapter").fadeIn(0.5);   
        $("#nav_chapter").fadeIn(0.5);   
       
        $("#nav_story").fadeOut(0.5);
        $("#new_story").fadeOut(0.5);
      });
    });    
</script>
  <div style="clear: both;"></div>
      <div class="row p-0 mt-3" id="new_story" style="display: none; ">

@foreach($truyen as $key => $value)
		<div class="col-6 m-0">
          <div class="mb-2">
             
                    <div class="row m-0 text-left " >
                    
                      <div class="post_story_box  mb-2" style=" width: 100%;">
                        <div class=" shadow-sm" style="width: 100%;border-radius: 8px;">
                        <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark tentruyen">
                      <div class="image_book_box float-left" style="width: 35%;">
                        <img  src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" width="100%" height="180px" style="border-radius: 8px">
                      </div>
                        </a>
                      <div class="image_book_box pl-2 float-right" style="width: 65%;">
                      
                      <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                        <p class="title_story resomer mb-0 font-weight-bold" style="font-size: 110%;">{{$value->tentruyen}}</p>
                        <p class="m-0">{{$value->danhmuctruyen->tendanhmuc}}</p>
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
                        <i class="resomer m-0" style="font-size: 95%; height:55px">Nội dung: {{$value->tomtat}}</i>
                        <p style="font-size: 85%; color:gray" class="comment_story m-0" > <i class="fa fa-eye mr-1"></i>{{ views($value)->count() }} lượt xem</p>
                        
                      </div>
                      <div style="clear: both;"></div>
                      </div>
                    </div>
                </div>
                
            </div>
        </div>
@endforeach
        
       
<div class="ml-3" style="margin: 0 auto; width: 100%">  

  {{$truyen->onEachSide(1)->links('pagination::bootstrap-4')}}

</div>


      </div>   
			

      <div class="row p-0 mt-3" id="new_chapter">
			
  @foreach($chuong_moinhat as $key => $value)
		<div class="col-6 m-0">
          <div class="mb-2">
             
                    <div class="row m-0 text-left " >
                    
                      <div class="post_story_box  mb-2" style=" width: 100%;">
                        <div class=" shadow-sm" style="width: 100%;border-radius: 8px;">
                        <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                      <div class="image_book_box float-left" style="width: 35%;">
                        <img  src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" width="100%" height="180px" style="border-radius: 8px">
                      </div>
                        </a>
                      <div class="image_book_box pl-2 float-right" style="width: 65%;">
                      
                      <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                        <p class="title_story resomer mb-0 font-weight-bold" style="font-size: 110%;">{{$value->tentruyen}} {{$value->thongbao}}
                      
     
                       <p class="m-0">{{$value->danhmuctruyen->tendanhmuc}}</p>
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
                        <i class="resomer m-0" style="font-size: 95%; height:55px">Nội dung: {{$value->tomtat}}</i>
                        <p style="font-size: 85%; color:gray" class="comment_story m-0" > <i class="fa fa-eye mr-1"></i>  {{ views($value)->count() }} lượt xem</p>
                        
                      </div>
                      <div style="clear: both;"></div>
                      </div>
                    </div>
                </div>
                
            </div>
        </div>
@endforeach

    <div  class="ml-3" style="margin: 0 auto; width: 100%">   
        {{$chuong_moinhat->onEachSide(1)->links('pagination::bootstrap-4')}}
    </div>  
  </div> 


    
 		

		
			<!-- <div class="text-center mt-5" style="margin: 0 auto; width: 100%"><a href="#" style="color: #ff631c; font-size: 120% ">Xem tất cả</a></div> -->
      <!-- {{--   <a class="btn btn-success"  href="">Xem tất cả</a> --}} -->
     
    </div>
        <div class="col-4 m-0" >
		
      @if(Auth::user())  
      <div class="truyen-yeu-thich"> 
        <div class="btn p-2 border-0 text-center font-weight-bold w-100" style="border-radius: 8px; background: #ff631c; color: white;">Truyện yêu thích</div>
        <div class="mt-3"   data-spy="scroll" data-target="#myScrollspy" data-offset="10"  id="scroll_height" style="overflow-y: scroll; height: 200px">
          <div id="yeuthich"></div>    
        </div>
      </div>
      @else
      <div class="truyen-yeu-thich"> 
        <div class="btn p-2 border-0 text-center font-weight-bold w-100" style="border-radius: 8px; background: #ff631c; color: white;">Truyện yêu thích</div>
        <p class="text-center">Hãy <a href="{{ route('login') }}" class="m-0" style="color:  #ff631c;">đăng nhập</a> để sử dụng tính năng này</p>
      </div>
      @endif  


      <style type="text/css">
          .delete:hover{
              color: #ff631c;
          }
      </style>

       <div class="mt-4">
          <div class="btn p-2 border-0 text-center font-weight-bold w-100" style="border-radius: 8px; 
          background: #ff631c; color: white;">Lịch sử đọc truyện</div>

          <div class="history_read mt-3">
                        <div class="mb-2">
              <div class="row m-0 text-left " >
               
                <div class="post_story_box  mb-2" style=" width: 100%; height: 150px">
                   <div class=" shadow-sm" style="width: 100%;border-radius: 8px;">
                 <div class="image_book_box float-left" style="width: 30%;">
                   <img src="img/image_story/5.jpg" width="100%" height="150px" style="border-radius: 8px">
                 </div>
                 <div class="image_book_box pl-2 float-right" style="width: 70%;">

                   <p class="title_story mb-0 font-weight-bold" style="font-size: 110%;">Truyện Test</p>
                   <p class="m-0" style="font-size: 100%">Đọc tiếp Chương 10</p>
                   <div class="tag_box">
                  <a href=""><div class="btn mt-1 font-weight-bold" style="font-size: 12px; background: #ff631c; color: white;padding: 0px 5px 0px 5px;">Harem</div></a>
                  <a href=""><div class="btn mt-1 font-weight-bold" style="font-size: 12px; background: #ff631c; color: white;padding: 0px 5px 0px 5px;">Harem</div></a>
                  <a href=""><div class="btn mt-1 font-weight-bold" style="font-size: 12px; background: #ff631c; color: white;padding: 0px 5px 0px 5px;">Harem</div></a>
                  <a href=""><div class="btn mt-1 font-weight-bold" style="font-size: 12px; background: #ff631c; color: white;padding: 0px 5px 0px 5px;">Harem</div></a>
                  <a href=""><div class="btn mt-1 font-weight-bold" style="font-size: 12px; background: #ff631c; color: white;padding: 0px 5px 0px 5px;">Harem</div></a>
                   
                   </div>
                   <button style="font-size: 85%; background: white; border-radius: 4px" class="delete m-0 mt-2 border-0 float-right font-weight-bold">Xoá khỏi lịch sử <i class="fas fa-times ml-1"></i></button>
                   
                 </div>
                 <div style="clear: both;"></div>
                 </div>
              </div>
          </div>
      </div>
          </div>

        


       <div class="text-center" style="margin: 0 auto; width: 80%"><a href="#" style="color: #ff631c; font-size: 120% ">Xem tất cả</a></div>
      </div>

<style>
.cropped {
    width: 80px; /* width of container */
    height: 70px; /* height of container */
    overflow: hidden;
    border-radius: 4px;
}

</style>
<script>   
    $(document).ready(function(){
      $(".button_topngay").click(function(){
        $("#topngay").fadeIn(0.5);
        $("#toptuan").fadeOut(0.5);
        $("#topthang").fadeOut(0.5);

        $("#nav_topngay").fadeIn(0.5);
        $("#nav_toptuan").fadeOut(0.5);
        $("#nav_topthang").fadeOut(0.5);
        
      });
    });

    $(document).ready(function(){
      $(".button_toptuan").click(function(){
        $("#toptuan").fadeIn(0.5);
        $("#topngay").fadeOut(0.5);
        $("#topthang").fadeOut(0.5);

        $("#nav_toptuan").fadeIn(0.5);
        $("#nav_topngay").fadeOut(0.5);       
        $("#nav_topthang").fadeOut(0.5);
      });
    });  

    $(document).ready(function(){
      $(".button_topthang").click(function(){
        $("#topthang").fadeIn(0.5);
        $("#topngay").fadeOut(0.5);
        $("#toptuan").fadeOut(0.5);
        
        $("#nav_topthang").fadeIn(0.5);
        $("#nav_topngay").fadeOut(0.5);
        $("#nav_toptuan").fadeOut(0.5);
       
      });
    }); 
</script>

          <div class="mt-4" style="height: 370px;">

         
            <div id="nav_topngay" style="width: 99%;  margin: 0 auto">
              <button class="button_topngay btn text-center text-white p-2 font-weight-bold"  style="width: 33%; float: left; border-bottom-left-radius: 20px; border-top-left-radius: 20px;background: #ff631c">Top ngày</button>
              <button class="button_toptuan btn text-center p-2 font-weight-bold"  style="width: 33%; float: left; background: #EEEEEE; border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3">Top tuần</button>
              <button class="button_topthang btn text-center p-2 font-weight-bold"  style="width: 33%; float: left; border-bottom-right-radius: 20px; border-top-right-radius: 20px; background: #EEEEEE">Top tháng</button>
            </div>

         
            <div id="nav_toptuan" style="width: 99%;  margin: 0 auto; display: none">
              <button class="button_topngay btn text-center p-2 font-weight-bold"  style="width: 33%; float: left; border-bottom-left-radius: 20px; border-top-left-radius: 20px; background: #EEEEEE" >Top ngày</button>
              <button class="button_toptuan btn text-white text-center p-2 font-weight-bold"  style="width: 33%; float: left; background: #ff631c; border-left: 1px solid #D3D3D3;">Top tuần</button>
              <button class="button_topthang btn text-center p-2 font-weight-bold"  style="width: 33%; float: left; border-bottom-right-radius: 20px; border-top-right-radius: 20px; background: #EEEEEE">Top tháng</button>
            </div>
           
            <div id="nav_topthang" style="width: 99%;  margin: 0 auto; display: none">
              <button class="button_topngay btn text-center p-2 font-weight-bold"  style="width: 33%; float: left; border-bottom-left-radius: 20px; border-top-left-radius: 20px;background: #EEEEEE">Top ngày</button>
              <button class="button_toptuan btn text-center p-2 font-weight-bold"  style="width: 33%; float: left; background: #EEEEEE; border-left: 1px solid #D3D3D3; border-right: 1px solid #D3D3D3">Top tuần</button>
              <button class="button_topthang btn text-center text-white p-2 font-weight-bold"  style="width: 33%; float: left; border-bottom-right-radius: 20px; border-top-right-radius: 20px; background: #ff631c">Top tháng</button>
            </div>

          <div style="clear: both"></div>
          <div class="top mt-4">

          <div class="row m-0 text-left" style=" width: 100%;">  
            <div class="col-10" id="topngay">
              
            @foreach($truyentopngay as $key => $value)
             
                    <div class="m-0 text-left " >
                    
                      <div class="post_story_box mb-3" style=" width: 100%;">
                        <div class=" " style="width: 100%;border-radius: 8px;">
                        <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                      <div class="image_book_box cropped float-left" style="width: 35%;">
                        <img  src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" width="100%" height="130px">
                      </div>
                        </a>
                      <div class="image_book_box pl-2 float-right" style="width: 65%;">
                      
                      <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                        <p class="title_story mb-0 resomer1 font-weight-bold" style="font-size: 110%;">{{$value->tentruyen}}</p>
                        <!-- @php
                        $count_chapter = count($value->chapter);
                        @endphp
                        @if($count_chapter)
                        <p class="m-0" style="font-size: 100%">Chương {{$count_chapter}}</p>
                        @else
                        <p class="m-0 text-danger" style="font-size: 14px;">Chưa có chương mới...</p>
                        @endif -->

                      
                        
                        <p style="font-size: 85%; color:gray" class="comment_story mt-2" > <i class="fa fa-eye mr-1"></i> 2360 lượt xem</p>
                        
                      </div>
                      </a> 
                      <div style="clear: both;"></div>
                      </div>
                    </div>
                </div>
                <hr>
            
@endforeach
              

            </div>

            <div class="col-10" id="toptuan" style="display: none">
              
              @foreach($truyentoptuan as $key => $value)
               
                      <div class="m-0 text-left " >
                      
                        <div class="post_story_box mb-3" style=" width: 100%;">
                          <div class=" " style="width: 100%;border-radius: 8px;">
                          <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                        <div class="image_book_box cropped float-left" style="width: 35%;">
                          <img  src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" width="100%" height="130px" style="">
                        </div>
                          </a>
                        <div class="image_book_box pl-2 float-right" style="width: 65%;">
                        
                        <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                          <p class="title_story resomer1 mb-0 font-weight-bold" style="font-size: 110%;">{{$value->tentruyen}}</p>
                          <!-- @php
                          $count_chapter = count($value->chapter);
                          @endphp
                          @if($count_chapter)
                          <p class="m-0" style="font-size: 100%">Chương {{$count_chapter}}</p>
                          @else
                          <p class="m-0 text-danger" style="font-size: 14px;">Chưa có chương mới...</p>
                          @endif -->
  
                        
                          
                          <p style="font-size: 85%; color:gray" class="comment_story  mt-2" > <i class="fa fa-eye mr-1"></i> 2360 lượt xem</p>
                          
                        </div>
                        </a>  
                        <div style="clear: both;"></div>
                        </div>
                      </div>
                  </div>
                  <hr>
              
  @endforeach
                
  
              </div>

              <div class="col-10" id="topthang" style="display: none">
              
              @foreach($truyentopthang as $key => $value)
               
                      <div class="m-0 text-left " >
                      
                        <div class="post_story_box mb-3" style=" width: 100%;">
                          <div class=" " style="width: 100%;border-radius: 8px;">
                          <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                        <div class="image_book_box cropped float-left" style="width: 35%;">
                          <img  src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" width="100%" height="130px" style="">
                        </div>
                          </a>
                        <div class="image_book_box pl-2 float-right" style="width: 65%;">
                        
                        <a  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                          <p class="title_story resomer1 mb-0 font-weight-bold" style="font-size: 110%;">{{$value->tentruyen}}</p>
                          <!-- @php
                          $count_chapter = count($value->chapter);
                          @endphp
                          @if($count_chapter)
                          <p class="m-0" style="font-size: 100%">Chương {{$count_chapter}}</p>
                          @else
                          <p class="m-0 text-danger" style="font-size: 14px;">Chưa có chương mới...</p>
                          @endif -->
  
                        
                          
                          <p style="font-size: 85%; color:gray" class="comment_story  mt-2" > <i class="fa fa-eye mr-1"></i> 2360 lượt xem</p>
                          
                        </div>
                        </a>  
                        <div style="clear: both;"></div>
                        </div>
                      </div>
                  </div>
                  
                  <hr>
  @endforeach
                
  
              </div>

            

               <div class="col-2 text-center">

                <div class="float-right" style="width: 100%; background: #FFC125; border-bottom-right-radius: 8px; border-top-right-radius: 8px;height: 76px;">
                      <p class="font-weight-bold text-center text-white" style="font-size: 130%; margin-top: 23px">1</p>
                </div>

                 <div class="float-right" style="width: 100%; background: #CDC9C9; border-bottom-right-radius: 8px; border-top-right-radius: 8px;height: 76px; margin-top: 30px">
                    <p class="font-weight-bold text-center text-white" style="font-size: 130%; margin-top: 23px">2</p>
                 </div>

                 <div class="float-right" style="width: 100%; background: #FF8C00; border-bottom-right-radius: 8px; border-top-right-radius: 8px;height: 76px; margin-top: 30px">
                    <p class="font-weight-bold text-center text-white" style="font-size: 130%; margin-top: 23px">3</p>
                 </div>
                
            </div>

            </div>

            

      </div></div>

    <div class="mt-4">
          <div class="btn p-2 border-0 text-center font-weight-bold w-100" style="border-radius: 8px; background: #ff631c; color: white;">Chia sẻ</div>
          <div class="icon_link mt-3" style="margin: 0 auto; width: 50%">
              <div class="fb-share-button ml-5" data-href="http://127.0.0.1:8000/#" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F127.0.0.1%3A8000%2F%23&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"></a></div>
          </div>
      </div>



    </div>


</div>
@endsection        