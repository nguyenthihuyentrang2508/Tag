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
    <li class="breadcrumb-item" aria-current="page">{{$chapter->tieude}}</li>
  </ol>
</nav>

	<div class="">
		<p style="font-size: 145%; text-shadow: 2px 2px #D3D3D3;" class="font-weight-bold text-center m-0">{{$chapter->truyen->tentruyen}}</p>
		<p class="text-center">{{$chapter->tieude}} 

		@if($chapter->updated_at == null )
            <i class="m-0">(Cập nhật lúc: {{ $chapter->created_at->toDateTimeString()}})</i>
          @else
            <i class="m-0">(Cập nhật lúc: {{ $chapter->updated_at->toDateTimeString()}})</i>   
        @endif
		
		</p>
		@if($chapter->tomtat)
		<p class="text-center m-0" style="font-size: 14px;">Tóm tắt: {{$chapter->tomtat}} </p>
		@endif
	</div>
	<hr>
	<div class="menu_view w-100">
		<div style="margin: 0 auto; width: 540px">
			<a href="{{url('/')}}"><div class="btn pt-1 pb-1 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-home"></i></div></a>		
			<div class="btn pt-1 pb-1  ml-2 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fa fa-plus" aria-hidden="true"></i> Theo dõi</div>
			

			<button type="button" class="btn pt-1 pb-1  ml-2 font-weight-bold"  style="border: 1px solid #ff631c;  border-radius: 8px; font-size: 120%; color: #ff631c" data-toggle="modal" data-target="#exampleModal">
			Báo lỗi
			</button>

			<button type="button" class="btn pt-1 pb-1  ml-2 font-weight-bold"  style="border: 1px solid #ff631c;  border-radius: 8px; font-size: 120%; color: #ff631c" data-toggle="modal" data-target="#exampleModal1">
				<i class="fas fa-cog"></i>
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
					<form method="POST" action="{{ route('reporterror.store') }}">
						@csrf
					<input type="hidden" name ="chapter_id" value="{{$chapter->id}}">
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

	<a href="{{url('xem-chapter/'.$chapter->truyen->slug_truyen.'/'.$min_chapter)}}"><div class="btn pt-1 pb-1 mt-3 font-weight-bold float-left" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-double-left"></i></div></a>

	<a href="{{url('xem-chapter/'.$chapter->truyen->slug_truyen.'/'.$previous_chapter)}}"  class="{{$chapter->id==$min_id->id ? 'isDisable' : '' }}"><div class="btn pt-1 pb-1 ml-2 mt-3 font-weight-bold float-left" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-left"></i></div></a>

	<div class="dropdown shadow-sm float-left ml-2 mr-2">
	  <button class="btn story_1" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 300px">

	    <div class="text-left ">                  
                    <div class="post_story_box" style=" width: 100%;">
                       <div class="shadow-sm" style="width: 100%;">
                     <div class="image_book_box float-left" style="width: 15%;">
                       <img src="{{asset('public/uploads/truyen/'.$chapter->truyen->hinhanh)}}" width="100%" height="60px">
                     </div>
                     <div class="image_book_box pl-2 float-left" style="width: 70%;">
                       <p class="title_story  resomer1 mb-0 font-weight-bold" style="font-size: 100%;">{{$chapter->truyen->tentruyen}}</p>
                       <p class="m-0 resomer1" style="font-size: 90%">Tác giả: {{$chapter->truyen->tacgia}}</p>
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
	  <div class="dropdown-menu " aria-labelledby="dropdownMenuLink" style="width: 300px;  box-shadow: 0px 0px 0px 3px #F5F5F5;">
	  	<p class="text-center">Bảng mục lục</p>

	  	<div class="m-0 p-0"  data-spy="scroll" data-target="#myScrollspy" data-offset="10"  id="scroll_height" style="overflow-y: scroll; height: 200px">
		  @foreach($all_chapter as $key => $chap)	
		  <div class="chapter_selected"  onclick="location.href='{{url('xem-chapter/'.$chap->truyen->slug_truyen.'/'.$chap->slug_chapter)}}'">{{$chap->tieude}}</div>
			  
		@endforeach		
	  	</div>

	  </div>
	</div>

	<a href="{{url('xem-chapter/'.$chapter->truyen->slug_truyen.'/'.$next_chapter)}}"  class="{{$chapter->id==$max_id->id ? 'isDisable' : '' }}"><div class="btn pt-1 pb-1 mt-3 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-right"></i></div></a>
	<a href="{{url('xem-chapter/'.$chapter->truyen->slug_truyen.'/'.$max_chapter)}}"><div class="btn pt-1 pb-1 ml-2 mt-3 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-double-right"></i></div></a>
</div>

</div>


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" style="color: black">Chỉnh sửa</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
<div class="col-md-12">
                       <div class="form-group">
                        <label style="color: black" for="exampleFormControlSelect2">Khung màu</label>
                        <select class="form-control" id="change-color">
                          <option value="fff">Màu trắng</option>
                          <option value="181818">Màu đen</option>
                          <option value="f4f4f4">Xám nhạt</option>
                          <option value="e9ebee">Xanh nhạt</option>
                          <option value="E1E4F2">Xanh đậm</option>
                          <option value="F4F4E4">Vàng nhạt</option>
                          <option value="EAE4D3">Màu sepia</option>
                          <option value="FAFAC8">Vàng đậm</option>
                          <option value="EFEFAB">Vàng ố</option> 
                        </select>
                      </div>

					  <div class="form-group">
                        <label style="color: black" for="exampleFormControlSelect2">Màu chữ</label>
                        <select class="form-control" id="change-color-font">
                          <option value="fff">Màu trắng</option>
                          <option value="181818">Màu đen</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label style="color: black"  for="exampleFormControlSelect2">Font chữ</label>
                        <select class="form-control" id="change-font">

                          <option value="Palatino Linotype">Palatino Linotype</option>
                          <option value="Bookerly">Bookerly</option>
                          <option value="Segoe UI">Segoe UI</option>
                          <option value="Patrick Hand">Patrick Hand</option>
                          <option value="Times New Roman">Times New Roman</option>
                          <option value="Verdana">Verdana</option>
                          <option value="Tahoma">Tahoma</option>
                          <option value="Arial">Arial</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label style="color: black"  for="exampleFormControlSelect2">Chiều cao dòng</label>
                        <select class="form-control" id="change-lineheight">
                          <option value="40">40</option>
                          <option value="60">60</option>
                          <option value="80">80</option>
                          <option value="100">100</option>
                          <option value="120">120</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="mr-3" style="color: black"  for="exampleFormControlSelect2">Kích thước chữ</label>
							<input type="hidden" class="fontsize">
							<button type="button" class="btn btn-success  size-increment"><i class="fas fa-plus"></i></button>
							<button type="button" data-orig_size="25px" class="btn btn-secondary size-orig">Mặc định</button>
							<button type="button" class="btn btn-danger size-decrement"><i class="fas fa-minus"></i></button>
                      </div>
                  </div>
<!-- Modal -->
				</div>
			</div>
		</div>
		</div>

	<div class="container-fluid mt-5" style=" width: 100%; height: 100%;">
		<table width=100% height=100%> 
		    <tr>
				
		        <td class="noidungchuong" style="text-align: align;">
					{!!$chapter->noidung!!}
		        </td>
				
		    </tr>

			

		</table>
	
	</div>

<div class="container">
	<style type="text/css">
	.story_1:hover{
		background: #D2D2D2;
	}
</style>
<div class="mt-3" style="margin: 0 auto; width: 500px">

<a href="{{url('xem-chapter/'.$chapter->truyen->slug_truyen.'/'.$min_chapter)}}"><div class="btn pt-1 pb-1 mt-3 font-weight-bold float-left" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-double-left"></i></div></a>

<a href="{{url('xem-chapter/'.$chapter->truyen->slug_truyen.'/'.$previous_chapter)}}"  class="{{$chapter->id==$min_id->id ? 'isDisable' : '' }}"><div class="btn pt-1 pb-1 ml-2 mt-3 font-weight-bold float-left" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-left"></i></div></a>

	<div class="dropdown shadow-sm float-left ml-2 mr-2">
	  <button class="btn story_1" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 300px">

	    <div class="text-left">                  
                    <div class="post_story_box" style=" width: 100%;">
                       <div class="shadow-sm" style="width: 100%;">
                     <div class="image_book_box float-left" style="width: 15%;">
                       <img src="{{asset('public/uploads/truyen/'.$chapter->truyen->hinhanh)}}" width="100%" height="60px">
                     </div>
                     <div class="image_book_box pl-2 float-left" style="width: 70%;">
                       <p class="title_story mb-0 font-weight-bold resomer1" style="font-size: 100%;">{{$chapter->truyen->tentruyen}}</p>
                       <p class="m-0  resomer1" style="font-size: 90%">Tác giả: {{$chapter->truyen->tacgia}}</p>
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
			<div  class="chapter_selected" onclick="location.href='{{url('xem-chapter/'.$chap->truyen->slug_truyen.'/'.$chap->slug_chapter)}}'">
				{{$chap->tieude}}
			</div>			  
		@endforeach		  
	  	 </div>

	  </div>
	</div>

	<a href="{{url('xem-chapter/'.$chapter->truyen->slug_truyen.'/'.$next_chapter)}}"  class="{{$chapter->id==$max_id->id ? 'isDisable' : '' }}"><div class="btn pt-1 pb-1 mt-3 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-right"></i></div></a>
	<a href="{{url('xem-chapter/'.$chapter->truyen->slug_truyen.'/'.$max_chapter)}}"><div class="btn pt-1 pb-1 ml-2 mt-3 font-weight-bold" style="background: #ff631c;  border-radius: 8px; font-size: 120%; color: white"><i class="fas fa-angle-double-right"></i></div></a>
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
           <input type="hidden" name ="truyen_id" value="{{$chapter->truyen->id}}">
          <input type="submit" value="Đăng" class="form-control z-depth-1 shadow-sm w-25 mt-2" style="background: white;">
        </div>
      </div>
	  @else
      <div class="p-3" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> 
        <p class="text-center m-0" style="font-size: 14px;">Hãy <a href="{{ route('login') }}" class="m-0" style="color:  #ff631c;">đăng nhập</a> để có thể bình luận được ở đây!</p>
      </div>   
      @endif
</div>
@include('pages.commentsDisplay', ['comments' => $chapter->truyen->comments, 'truyen_id' => $chapter->truyen->id])
  
 
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
