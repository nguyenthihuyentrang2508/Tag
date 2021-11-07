@extends('../layout')
@section('content')
<style>
  .breadcrumb{
    background: none;

  }
</style>

<div>
<style>
  .breadcrumb{
    background: none;
  }
</style>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb shadow-sm">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{url('danh-muc/'.$truyen_breadcrumb->danhmuctruyen->slug_danhmuc)}}">{{$truyen_breadcrumb->danhmuctruyen->tendanhmuc}}</a></li>
	<li class="breadcrumb-item"><a href="{{url('xem-truyen/'.$truyen_breadcrumb->slug_truyen)}}">{{$truyen_breadcrumb->tentruyen}}</a></li>
    <li class="breadcrumb-item" aria-current="page">{{$chaptertranh->tieude}}</li>
  </ol>
</nav>
	<div class="">
		<p style="font-size: 145%; text-shadow: 2px 2px #D3D3D3;" class="font-weight-bold text-center m-0">{{$chaptertranh->truyen->tentruyen}}</p>
		<p class="text-center">{{$chaptertranh->tieude}} 

		@if($chaptertranh->updated_at == null )
            <i class="m-0">(Cập nhật lúc: {{ $chaptertranh->created_at->toDateTimeString()}})</i>
          @else
            <i class="m-0">(Cập nhật lúc: {{ $chaptertranh->updated_at->toDateTimeString()}})</i>   
        @endif
		
		</p>
		@if($chaptertranh->tomtat)
		<p class="text-center m-0">{{$chaptertranh->tomtat}} </p>
		@endif
	</div>
	<hr>
	<div class="menu_view w-100">
		<div style="margin: 0 auto; width: 480px">
			<a href="{{url('/')}}"><div class="btn pt-1 pb-1 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-home"></i></div></a>
			<div class="btn pt-1 pb-1  ml-2 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fa fa-plus" aria-hidden="true"></i> Theo dõi</div>
			

			<button type="button" class="btn pt-1 pb-1  ml-2 font-weight-bold"  style="border: 1px solid #ff631c;  border-radius: 8px; font-size: 120%; color: #ff631c" data-toggle="modal" data-target="#exampleModal">
			Báo lỗi
			</button>
			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 150px">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" style="color: black">Báo lỗi truyện</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{ route('reporterrortranh.store') }}">
						@csrf
					<input type="hidden" name ="chaptertranh_id" value="{{$chaptertranh->id}}">
						<div class="form-group">
							<label for="exampleInputEmail1" style="color: black">Chọn loại lỗi</label>
								<select name="chonloi" class="custom-select" aria-label="Default select example">							
									<option value="0">Chapter không thấy chữ hoặc ảnh</option>
									<option value="1">Chapter bị trùng</option>
									<option value="2">Chapter chưa dịch</option>
									<option value="3">Up sai truyện</option>
									<option value="4">Lỗi khác</option>
								</select>
						</div>	

						<div class="form-group">
							<input name="noidung" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mô tả chi tiết lỗi sẽ được fix nhanh hơn!">
						</div>

					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-primary">Gửi đi</button>
				</div>
				</form>	
				</div>
			</div>
			</div>




			<div class="btn pt-1 pb-1  ml-2 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="far fa-flag mr-1"></i>Báo cáo</div>
			<a href="{{url('xem-truyen/'.$truyen_breadcrumb->slug_truyen)}}"><div class="btn pt-1 pb-1 ml-2 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-bars"></i></div></a>
		 </div>
	</div>
<style type="text/css">
	.story_1:hover{
		background: #D2D2D2;
	}
	.isDisable{
		pointer-events:none;
		opacity: 0.5;
	}
</style>
<div class="mt-3" style="margin: 0 auto; width: 500px">

	<a href="{{url('xem-chapter-tranh/'.$chaptertranh->truyen->slug_truyen.'/'.$min_chapter)}}"><div class="btn pt-1 pb-1 mt-3 font-weight-bold float-left" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-double-left"></i></div></a>

	<a href="{{url('xem-chapter-tranh/'.$chaptertranh->truyen->slug_truyen.'/'.$previous_chapter)}}"  class="{{$chaptertranh->id==$min_id->id ? 'isDisable' : '' }}"><div class="btn pt-1 pb-1 ml-2 mt-3 font-weight-bold float-left" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-left"></i></div></a>

	<div class="dropdown shadow-sm float-left ml-2 mr-2">
	  <button class="btn story_1" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 300px">

	    <div class="text-left">                  
                    <div class="post_story_box" style=" width: 100%;">
                       <div class="shadow-sm" style="width: 100%;">
                     <div class="image_book_box float-left" style="width: 15%;">
                       <img src="{{asset('public/uploads/truyen/'.$chaptertranh->truyen->hinhanh)}}" width="100%" height="60px">
                     </div>
                     <div class="image_book_box pl-2 float-left" style="width: 70%;">
                       <p class="title_story  resomer1 mb-0 font-weight-bold" style="font-size: 100%;">{{$chaptertranh->truyen->tentruyen}}</p>
                       <p class="m-0 resomer1" style="font-size: 90%">Tác giả: {{$chaptertranh->truyen->tacgia}}</p>
                     </div>
                     <div class="float-right mt-3" style="width: 5%">
                     	<i class="fas fa-chevron-down"></i>
                     </div>
                  </div>
              </div>
          </div>
	  </button>

<style type="text/css">
	.chapter_selected:hover{
		border-left: 3px solid #ff631c;
	}
	.chapter_selected{
		width: 100%;
		border-bottom: 1px solid #D3D3D3;
		border-top: 1px solid #D3D3D3;
		background-color: whitesmoke;
		padding-left: 1rem;
		padding: 8px;
		font-weight: bold;
		cursor: pointer;
	}

</style>
	  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="width: 300px;  box-shadow: 0px 0px 0px 3px #F5F5F5;">
	  	<p class="text-center">Bảng mục lục</p>

	  	<div class="m-0 p-0"  data-spy="scroll" data-target="#myScrollspy" data-offset="10"  id="scroll_height" style="overflow-y: scroll; height: 200px">
		  @foreach($all_chapter as $key => $chap)	
		  <div class="chapter_selected"  onclick="location.href='{{url('xem-chapter-tranh/'.$chap->truyen->slug_truyen.'/'.$chap->slug_chaptertranh)}}'">{{$chap->tieude}}</div>
			  
		@endforeach		
	  	</div>

	  </div>
	</div>

	<a href="{{url('xem-chapter-tranh/'.$chaptertranh->truyen->slug_truyen.'/'.$next_chapter)}}" class="{{$chaptertranh->id==$max_id->id ? 'isDisable' : '' }}"><div class="btn pt-1 pb-1 mt-3 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-right"></i></div></a>
	<a href="{{url('xem-chapter-tranh/'.$chaptertranh->truyen->slug_truyen.'/'.$max_chapter)}}"><div class="btn pt-1 pb-1 ml-2 mt-3 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-double-right"></i></div></a>
</div>

</div>


	<div class="container-fluid mt-5" style=" width: 100%; height: 100%;">
		<table width=100% height=100%> 
		    <tr>
                                @php 
                                   $images = json_decode($chaptertranh->image); 
                                @endphp
                               			  
                            <td style="text-align: center; vertical-align: middle;">
                                @foreach($images as $key => $images)
                                        <img src="{{URL::to($images)}}" width="100%" height="100%" alt="">
                                @endforeach
                            </td>
				 
			</tr>
				
		    </tr>

			<!-- <tr>	Hình ảnh			  
				  <td style="text-align: center; vertical-align: middle;">

				  </td>
			</tr> -->

		</table>
	
	</div>

<div class="container">
	<style type="text/css">
	.story_1:hover{
		background: #D2D2D2;
	}
</style>
<div class="mt-3" style="margin: 0 auto; width: 500px">

<a href="{{url('xem-chapter-tranh/'.$chaptertranh->truyen->slug_truyen.'/'.$min_chapter)}}"><div class="btn pt-1 pb-1 mt-3 font-weight-bold float-left" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-double-left"></i></div></a>

<a href="{{url('xem-chapter-tranh/'.$chaptertranh->truyen->slug_truyen.'/'.$previous_chapter)}}"  class="{{$chaptertranh->id==$min_id->id ? 'isDisable' : '' }}"><div class="btn pt-1 pb-1 ml-2 mt-3 font-weight-bold float-left" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-left"></i></div></a>

	<div class="dropdown shadow-sm float-left ml-2 mr-2">
	  <button class="btn story_1" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 300px">

	    <div class="text-left">                  
                    <div class="post_story_box" style=" width: 100%;">
                       <div class="shadow-sm" style="width: 100%;">
                     <div class="image_book_box float-left" style="width: 15%;">
                       <img src="{{asset('public/uploads/truyen/'.$chaptertranh->truyen->hinhanh)}}" width="100%" height="60px">
                     </div>
                     <div class="image_book_box pl-2 float-left" style="width: 70%;">
                       <p class="title_story mb-0 font-weight-bold resomer1" style="font-size: 100%;">{{$chaptertranh->truyen->tentruyen}}</p>
                       <p class="m-0  resomer1" style="font-size: 90%">Tác giả: {{$chaptertranh->truyen->tacgia}}</p>
                     </div>
                     <div class="float-right mt-3" style="width: 5%">
                     	<i class="fas fa-chevron-up"></i>
                     </div>
                  </div>
              </div>
          </div>
	  </button>


	   <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="width: 300px;  box-shadow: 0px 0px 0px 3px #F5F5F5;">
	  	<p class="text-center">Bảng mục lục</p>

	
	  	<div class="m-0 p-0"  data-spy="scroll" data-target="#myScrollspy" data-offset="10"  id="scroll_height" style="overflow-y: scroll; height: 200px">
		
	
		@foreach($all_chapter as $key => $chap)	
			<div  class="chapter_selected" onclick="location.href='{{url('xem-chapter-tranh/'.$chap->truyen->slug_truyen.'/'.$chap->slug_chaptertranh)}}'">
				{{$chap->tieude}}
			</div>			  
		@endforeach		  
	  	 </div>

	  </div>
	</div>

	<a href="{{url('xem-chapter-tranh/'.$chaptertranh->truyen->slug_truyen.'/'.$next_chapter)}}"  class="{{$chaptertranh->id==$max_id->id ? 'isDisable' : '' }}"><div class="btn pt-1 pb-1 mt-3 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-right"></i></div></a>
	<a href="{{url('xem-chapter-tranh/'.$chaptertranh->truyen->slug_truyen.'/'.$max_chapter)}}"><div class="btn pt-1 pb-1 ml-2 mt-3 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-double-right"></i></div></a>
</div>
<div style="clear: both"></div>
<hr>


<form method="POST" action="{{ route('comment.store'   ) }}">
  @csrf
<div class="container mb-3 mt-3">
	 <p class="font-weight-bold m-0 mb-1 mt-3" style="font-size: 125%">Bình luận</p>
	 @if(Auth::user())
	 <div class="media mt-3 shadow-textarea">
    
	 @if(Auth::user()->image)
      <img class="d-flex rounded-circle avatar z-depth-1-half mr-3"  width="45px" height="65px" src="{{asset('public/uploads/avatar/'.Auth::user()->image)}}"
        alt="Avatar">
    @else
      <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" width="45px" height="65px" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-10.jpg"
                alt="Avatar">    
    @endif
      <div class="media-body">
        <h5 class="m-0 mb-1 font-weight-bold blue-text">{{Auth::user()->name}}</h5>
        <div class="form-group basic-textarea rounded-corners orange-border">
          <textarea class="form-control z-depth-1 shadow-sm" id="exampleFormControlTextarea345" rows="3" placeholder="Write your comment..." name="body"></textarea>
           <input type="hidden" name ="truyen_id" value="{{$chaptertranh->truyen->id}}">
          <input type="submit" value="Đăng" class="form-control z-depth-1 shadow-sm w-25 mt-2" style="background: white;">
        </div>
      </div>
	  @else
      <div class="p-3" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> 
        <p class="text-center m-0" style="font-size: 14px;">Hãy <a href="{{ route('login') }}" class="m-0" style="color:  #ff631c;">đăng nhập</a> để có thể bình luận được ở đây!</p>
      </div>   
      @endif
</div>

@include('pages.commentsDisplay', ['comments' => $chaptertranh->truyen->comments, 'truyen_id' => $chaptertranh->truyen->id])


  </div>
</div>

</div>
</form>

</div>

<style type="text/css">
.media .avatar {
    width: 64px;
}
.shadow-textarea textarea.form-control::placeholder {
    font-weight: 300;
}
.shadow-textarea textarea.form-control {
    padding-left: 0.8rem;
}
.orange-border .form-control:focus {
    border: 1px solid #ff631c;
    box-shadow: 0 0 0 0.2rem rgba(255, 99, 28, 1);
}
</style>
@endsection
