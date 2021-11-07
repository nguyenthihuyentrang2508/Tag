@extends('../layout')
@section('content')
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, inital-scale=1"> 
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body id="scroll_height" style="overflow-x: hidden;">
	<style type="text/css">
	
#scroll_height::-webkit-scrollbar-track
{
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  border-radius: 10px;
  background-color: #F5F5F5;
}

#scroll_height::-webkit-scrollbar
{
  width: 4px;
  background-color: #F5F5F5;
}

#scroll_height::-webkit-scrollbar-thumb
{
  border-radius: 10px;
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
  background-color:  #FF641D;
}
	</style>

	

<style type="text/css">
	a#hover_font_bold:hover{
		font-weight: bold;
		color: white;
		text-decoration: none;
	}

	#file-input
		{
			display: none;
		}


	.image-upload i
	{
		width: 30px;
		cursor: pointer;
	}

</style>
<script>   
    $(document).ready(function(){
      $(".edit_profile").click(function(){
        $("#form_edit").fadeIn(0.5);
		$(".edit_profile_out").fadeIn(0.5);
		$(".edit_profile").fadeOut(0.5);
		$(".detail_user").fadeOut(0.5);
		
      });
    });

	$(document).ready(function(){
      $(".edit_profile_out").click(function(){
        $("#form_edit").fadeOut(0.5);
		$(".edit_profile").fadeIn(0.5);
		$(".detail_user").fadeIn(0.5);
		$(".edit_profile_out").fadeOut(0.5);
      });
    });

	function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
</script>

	<div class="container-fluid">
		<div style="background-image: url(img/image_story/bg_avatar.jpg); background-repeat: no-repeat; background-size: cover ;width: 100%; height: 400px;">		
			<button class="edit_profile btn float-right" type="submit shadow-sm" style="background: white; color: #ff631c; border: 1px solid #D3D3D3"><i class="fas fa-pen mr-2"></i>Chỉnh sửa</button>
		<div style="clear: both;"></div>
		<button class="edit_profile_out btn" type="submit shadow-sm" style="display: none;background: white; color: #ff631c; border: 1px solid #D3D3D3"><i class="fas fa-arrow-left"></i></button>	
		
				<div class="" style="width: 100%; padding-top: 80px">
		            <div class="avatar_box" style="width:200px;height: 115px;margin: auto; ">

					@if($user->image != '')
		           	<img id="thumbnil" class="center rounded-circle ml-5" width="115px" height="115px" src="{{asset('public/uploads/avatar/'.$user->image)}}" alt="Your avatar">
                    @else
					<img class="center rounded-circle ml-5" width="115px" height="115px" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-10.jpg" alt="Your default avatar">
					@endif


					

		            	<form id="form_edit" style="display: none" method="POST" action="{{url('/upload-image-user',[Auth::user()->id])}}" enctype="multipart/form-data">	
                    	@csrf

							<div class="image-upload">
								<label for="file-input">
									<i class="fas fa-camera"  style="font-size:25px; position: relative;margin-left: 93px;top: -20px; color: #ff631c;"></i></div>
								</label>

								<input id="file-input" type="file" name="image" onchange="showMyImage(this)"/>
								
								<div class="form-group text-center mt-2">
									<label for="exampleFormControlTextarea1">Giới thiệu</label>
									@if($user->intro)
									<textarea name="intro" class="form-control ml-2" id="exampleFormControlTextarea1" rows="3" style="resize: none; width: 200px">{{$user->intro}}</textarea>
									@else
									<textarea name="intro" class="form-control ml-2" id="exampleFormControlTextarea1" rows="3" style="resize: none; width: 200px"></textarea>
									@endif
								</div>
								
								<button type="submit" class="btn" type="submit shadow-sm" style="background: white; color: #ff631c; border: 1px solid #D3D3D3; position: absolute; right: 150px; top: 80px">Lưu</button> 
							</div>
						</form>
						

						<div style="clear: both;"></div>


						

						
						<div class="text">
		             		 <p class="text-center font-weight-bold mt-3 text-dark" style="font-size: 130%">{{Auth::user()->name}}</p>                         
		           		</div>

		           		<div class="row detail_user" style="width: 500px; margin: 0 auto;">
                           @php 
                                $count_truyen = count($list_truyen);
                           @endphp
		           			<div class="col-4 text-center ">
		           				<a href="#" id="hover_font_bold" class="text-dark">{{$count_truyen}} <br>Tác phẩm</a> 
		           			</div>
		           			<div class="col-4 text-center" >
		           				<a href="#" id="hover_font_bold" class=" text-dark">15 <br> Đang theo dõi </a>
		           			</div>
		           			<div class="col-4 text-center ">
		           				<a href="#" id="hover_font_bold" class=" text-dark">130 <br>Người theo dõi</a>
		           			</div>
		           		</div>

		          	</div>
		      	 </div>
			
		</div>
	</div>

	<div class="container">
		<div class="row m-0">
			<div class="col-4 p-0">

		<style type="text/css">
          a.menu_person_page{
         border-bottom: 3px solid #EEEEEE;
          }
          a.menu_person_page.active{
            border-bottom: 3px solid #ff631c;
          }
          a.menu_person_page:hover{
            border-bottom: 3px solid #ff631c;
          }
        </style>

          <div class="mb-2 mt-1" style="width: 100%; margin: 0 auto;">

          <nav class="nav text-center m-0" >
            <a class="menu_person_page nav-link active m-0 text-dark" style="width: 30%;">Giới thiệu</a>
            <a class="menu_person_page nav-link m-0 text-dark" style="width: 30%;">Tin tức</a>
            <a class="menu_person_page nav-link m-0 text-dark" style="width: 40%;">Đang theo dõi</a>
          </nav>
      	  </div>

			</div>
			<!-- ---Dãy ngăn cách col-- -->
			<div class="col-8 p-0">
				<div class="float-right">
					<button  type="submit" class="btn mt-2 shadow-sm" style="background: white; color: #ff631c; border: 1px solid #D3D3D3">
						<p class="m-0"><i class="fas fa-user-plus mr-2"></i>Theo dõi</p>
					</button>
					<button  type="submit" class="btn mt-2 shadow-sm" style="background: white; color: #ff631c; border: 1px solid #D3D3D3">
						<p class="m-0"><i class="fas fa-envelope mr-2"></i>Nhắn tin</p>
					</button>

					
				      <button type="submit" class="btn mt-2 shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: white; border: 1px solid #D3D3D3">
				        <i class="fas fa-ellipsis-h m-0" style="color: #ff631c;"></i>
				      </button>
				      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				        <a class="dropdown-item" href="#"><i class="fas fa-user-slash mr-2"></i>Chặn</a>
				         <div class="dropdown-divider"></div>
				        <a class="dropdown-item" href="#"><i class="far fa-flag mr-2"></i>Báo cáo</a>
				      </div>
				   

				</div>
			</div>
			<!-- ---End row--- -->
		</div>
	</div>

	<div class="container mt-3 mb-3">
		<div class="row m-0">
			<div class="col-4 p-0">
				<div class="p-3" style="box-shadow: 0 1px 10px 0 #D3D3D3; border: 1px solid transparent">
					<div class="Status">
						@if($user->intro)
						<p>{{$user->intro}}</p>
						@else
						<p>Xin chào! Tôi tên là {{$user->name}}...</p>
						@endif
					</div>
					<hr>
					<div class="Following">
						<p class="text-uppercase" style="font-size: 80%; color: #666">Đang theo dõi</p>
						<div class="float-left mr-2" style="height: 45px; width: 45px;">
							<img src="img/imgae_login/admin.jpg" width="100%" height="100%;" style="border-radius: 50%;">
						</div>
						<div class="float-left mr-2" style="height: 45px; width: 45px;">
							<img src="img/imgae_login/admin.jpg" width="100%" height="100%;" style="border-radius: 50%;">
						</div>
						<div class="float-left mr-2" style="height: 45px; width: 45px;">
							<img src="img/imgae_login/admin.jpg" width="100%" height="100%;" style="border-radius: 50%;">
						</div>
						<div class="float-left mr-2" style="height: 45px; width: 45px;">
							<img src="img/imgae_login/admin.jpg" width="100%" height="100%;" style="border-radius: 50%;">
						</div>
						<div class="float-left mr-2" style="height: 45px; width: 45px;">
							<img src="img/imgae_login/admin.jpg" width="100%" height="100%;" style="border-radius: 50%;">
						</div>
						<div class="btn" style="border-radius: 50%; width: 45px; height: 45px; background: #ff631c;">
							<p class="text-center text-white mt-1 m-0 font-weight-bold">+6</p>
						</div>
						<div style="clear: both"></div>
					</div>
					<hr>
					<div class="Share">
						<p class="text-uppercase" style="font-size: 80%; color: #666">Chia sẻ</p>
							<div class="icon_link mt-3" style="margin: 0 auto; width: 50%">
								<div class="fb-share-button ml-5" data-href="http://127.0.0.1:8000/#" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F127.0.0.1%3A8000%2F%23&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"></a></div>
							</div>
						<div style="clear: both"></div>
					</div>
				</div>
			</div>
			<!-- ---Dãy phân cách col--- -->
			<div class="col-8 p-0">
				<div class="p-3 ml-4" style="box-shadow: 0 1px 10px 0 #D3D3D3; border: 1px solid transparent">
					<p class="font-weight-bold m-0" style="font-size: 120%">Truyện của {{Auth::user()->name}}</p>
					<p class="text-uppercase" style="font-size: 80%; color: #666">Người này đã đăng {{$count_truyen}} truyện</p>

                    @foreach($list_truyen as $key => $truyen)
				<div class="mb-2">
                  <div class="row m-0 text-left " >
                  <a  href="{{url('xem-truyen/'.$truyen->slug_truyen)}}" class="text-dark tentruyen">
                    <div class="post_story_box mb-2" style=" width: 100%; height: 150px">
                       <div class="shadow-sm" style="width: 100%;border-radius: 8px; border: 1px solid whitesmoke">
                     <div class="image_book_box float-left" style="width: 15%;">
                       <img  src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" width="100%" height="150px" style="border-radius: 8px">
                     </div>
                     <div class="image_book_box pl-2 float-right" style="width: 85%;">

                       <p class="title_story mb-0 font-weight-bold" style="font-size: 110%;margin-top: 5px;">{{$truyen->tentruyen}}</p>
                       <p class="mb-0">Tác giả: {{$truyen->tacgia}}</p>
                    </a> 
                       <p class="m-0">{{$truyen->danhmuctruyen->tendanhmuc}}</p>
                         
                       <div class="tag_box">
                        @foreach($truyen->thuocnhieutheloaitruyen as $thuocloai)
                        <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><div class="btn mt-1 mb-1 font-weight-bold" style="font-size: 12px; background: #ff631c; color: white;padding: 0px 5px 0px 5px;">{{$thuocloai->tentheloai}}</div></a>
                        @endforeach
                      </div>
                       <p style="font-size: 85%" class="comment_story m-0 mt-2" ><i class="fa fa-eye mr-1"></i>{{ views($truyen)->count() }} lượt xem</p>
                       
                     </div>
                     <div style="clear: both;"></div>
                     </div>
                  </div>
                 
              </div>
          </div>
          @endforeach

          <div class="btn" style="width: 100%; background: #ff631c; color: white">
          	Xem thêm <i class="fas fa-chevron-down ml-2"></i>
          </div>



				</div>
			</div>
			<!-- ---End row--- -->
		</div>		
	</div>
</body>
</html>
@endsection