@extends('../layout')
@section('content')
<style type="text/css">
          a.menu_story_page{
         border-bottom: 3px solid #EEEEEE;
          }
          a.menu_story_page.active{
            border-bottom: 3px solid #ff631c;
          }
          a.menu_story_page:hover{
            border-bottom: 3px solid #ff631c;
          }
          li.dropdown-item{
            border-bottom: 1px solid #D3D3D3;
          }
          .story_part_wrapper{
            height: 150px;
            overflow-y: scroll;
          }
          a.story{
            color: black;
            text-decoration: none;
          }
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

        <p class="font-weight-bold m-0 mb-4" style="font-size: 120%;">Cài đặt tài khoản</p>
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

                    @if (session('status'))
                   
                        <div class="alert  alert-dismissable alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            {{ session('status') }}
                        </div>
                    @endif

  <div id="edit_user">
        <nav class="nav text-center m-0"  >
            <a class="menu_story_page nav-link active m-0 text-dark" style="width: 50%;" onclick="change_page1()">Chỉnh sửa hồ sơ</a>
            <a class="menu_story_page nav-link text-dark" style="width: 50%;"  onclick="change_page()">Đổi mật khẩu</a>
          </nav>

          <form id="form_edit" method="POST" action="{{url('/setting-user',[Auth::user()->id])}}" enctype="multipart/form-data">	
            @csrf
                <div class="pt-2 mt-3" style="width: 100%;">
                    <div class="avatar_box" style="width:115px;height: 115px;margin: auto; ">
                    @if($user->image != '')
                        <img  id="thumbnil" class="center rounded-circle" width="115px" height="115px" src="{{asset('public/uploads/avatar/'.$user->image)}}"  alt="Your Avatar">
                    @else    
                         <img class="center rounded-circle" width="115px" height="115px" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-10.jpg" alt="Your default avatar">
					@endif
                        <!-- <img src="img/icon/icon_change_avatar.svg" width="25px" style="position: relative;margin-left: 82px;margin-top: -65px"> -->
                        <div class="image-upload">
							<label for="file-input">
                                <i class="fas fa-camera"  style="font-size:25px; position: relative;margin-left: 50px;top: -15px; color: #ff631c;"></i>
                            </label>        
                                <input id="file-input" type="file" name="image" onchange="showMyImage(this)"/>
                        </div>        
                    </div>
                    <div class="text">
                    <p class="text-center font-weight-bold m-0 mt-2" style="font-size: 130%">{{$user->name}}</p>
                    </div>
                </div>

               <div class="p-2 shadow-sm" style="border-radius: 8px;"  >
                  <div class="row">
                  <div class="form-group col-lg-12 col-sm-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" value="{{$user->email}}" placeholder="Nhập email" name="email">
                  </div>
                  <div class="form-group col-lg-12 col-sm-6">
                    <label for="username">Tên hiển thị:</label>
                    <input type="username" class="form-control" value="{{$user->name}}" placeholder="Nhập tên hiển thị" name="name">
                  </div>
                  <div class="form-group col-lg-12 col-sm-6">
                    <label for="pwd">Giới tính:</label>
                    <select class="form-control">
                      <option for="pwd">Nam</option>
                      <option for="pwd">Nữ</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-12 col-sm-6">
                    <label for="pwd">Địa điểm:</label>
                    <input type="text" class="form-control" placeholder="Thành phố Đà Nẵng" id="pwd">
                  </div>
                  </div>
                  <button type="submit" class="btn" style="background: #ff631c; color: white">Lưu</button>
                   <!-- <button type="submit" class="btn shadow-sm" style="background: white; color: #ff631c; border: 1px solid #D3D3D3">Không lưu</button> -->
                 </form>
               </div>
             </div>

        <div  style="display: none;" id="change_password">
         <nav class="nav text-center m-0" >
            <a class="menu_story_page nav-link m-0 text-dark" style="width: 50%;"  onclick="change_page1()">Chỉnh sửa hồ sơ</a>
            <a class="menu_story_page nav-link active text-dark" style="width: 50%;" onclick="change_page()">Đổi mật khẩu</a>
          </nav>
                 

               <div class="p-2 shadow-sm" style="border-radius: 8px;" >
                 <form  id="form_edit" method="POST" action="{{url('/change-password',[Auth::user()->id])}}">
                 @csrf

                  <div class="form-group">
                    <label for="pwd">Mật khẩu mới:</label>
                    <div style="width:100%; background: white;  border-radius: 2px; border: 1px solid #D3D3D3">
                      <input style="width: 95%;" type="password" class="form-control border-0 float-left" placeholder="Nhập mật khẩu mới" name="password" id="myInput">
                     <div class="btn"><i class="fas fa-eye" style="color:dodgerblue; 	cursor: pointer;" onclick="myFunction()"></i></div>
                    </div>
                  </div>

                  <div style="clear: both;"></div>
                  
                  <div class="form-group">
                    <label for="pwd">Nhập lại mật khẩu:</label>
                    <div style="width:100%; background: white;  border-radius: 2px; border: 1px solid #D3D3D3">
                      <input style="width: 95%;" type="password" class="form-control border-0 float-left" placeholder="Nhập lại mật khẩu" name="password_confirmation"  id="myInput1">
                      <div class="btn"><i class="fas fa-eye" style="color:dodgerblue; 	cursor: pointer;" onclick="myFunction1()"></i></div>
                    </div>
                  </div>
                  <button type="submit" class="btn" style="background: #ff631c; color: white">Đổi</button>
                 </form>
               </div>
</div>


<script type="text/javascript">
  function change_page(){
     document.getElementById('change_password').style.display = 'block';
    document.getElementById('edit_user').style.display = 'none';
  }
  function change_page1() {
     document.getElementById('change_password').style.display = 'none';
    document.getElementById('edit_user').style.display = 'block';
  }
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

<script>
  function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function myFunction1() {
  var x = document.getElementById("myInput1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
@endsection