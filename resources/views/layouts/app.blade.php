<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đọc truyện Online</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    
   
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body  id="scroll_height" style="background: #f1f4f5;">
<style type="text/css">
  a:hover{
    text-decoration: none;
  }
		.menu{
   background: #fff;
   position: fixed;
   z-index: 99999;
   height: 75px;
}
.menu nav{ 
  width: 100%;
}
 .menu label.logo{
  color: black;
  font-size: 35px;
  padding: 6px 50px;
  font-weight: bold;
  float: left;
}
 .menu nav ul{
  float: left;
  margin-right: 25px;
}
 .menu nav ul li{
  display: inline-block;
  margin: 18px 10px;
}
nav ul li a{
  color: black;
  font-size: 17px;
  padding: 7px 10px;
  border-radius: 3px;

}
.dropdown-menu{
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  border: none;
  margin-top: 8px;
}
.dropdown-menu a:hover{
  font-weight: bolder;
  color: #ff631c;
  background-color: white;
}
.dropdown-menu:before {
   position: absolute;
   top: -7px;
   left: 9px;
   display: inline-block;
   border-right: 7px solid transparent;
   border-bottom: 7px solid #CCC;
   border-left: 7px solid transparent;
   border-bottom-color: rgba(0, 0, 0, 0.2);
   content: '';
 }

.dropdown-menu:after {
    position: absolute;
    top: -6px;
    left: 10px;
    display: inline-block;
    border-right: 6px solid transparent;
    border-bottom: 6px solid white;
    border-left: 6px solid transparent;
    content: '';
  }
  

	</style>
    <div id="app">
        

        <!-- <div class="menu_main container-fluid p-0" style="height: 75px;" >
	<div class="menu" style="width: 100%;">
    	<nav>
      		<label class="logo" style="color: #ff631c;">LOGO</label>
		      <ul>		

		      	<li>
		        	<div class="dropdown">
                        <button class="btn" type="button" >
                          
                        <a href="{{url('/')}}">Trang chủ</a>
                        </button>					  
				      </div>
		        </li>

		       <li> <div style="width: 300px"></div> </li>

		        <li>
		        	<div class="box p-2 shadow-sm ml-4" style="background: white; border-radius: 10px;">   
			        
			          <input type="search" id="search" placeholder="Tìm kiếm" class="border-0" style="width: 80%;" />
			           <span class="icon float-right pl-2 mr-2" style="width: 15px; border-left: 1px solid #D3D3D3"><i class="fa fa-search"></i></span>
			          <div style="clear: both;"></div>
    				</div>
		        </li>
		        	
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest	
		      </ul>


   		</nav>
   		

   	</div>

</div> -->

        <main class="py-4">
            @yield('content')
        </main>
        
</div>

<script type="text/javascript">
 
 function ChangeToSlug()
     {
         var slug;
      
         //Lấy text từ thẻ input title 
         slug = document.getElementById("slug").value;
         slug = slug.toLowerCase();
         //Đổi ký tự có dấu thành không dấu
             slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
             slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
             slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
             slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
             slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
             slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
             slug = slug.replace(/đ/gi, 'd');
             //Xóa các ký tự đặt biệt
             slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
             //Đổi khoảng trắng thành ký tự gạch ngang
             slug = slug.replace(/ /gi, "-");
             //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
             //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
             slug = slug.replace(/\-\-\-\-\-/gi, '-');
             slug = slug.replace(/\-\-\-\-/gi, '-');
             slug = slug.replace(/\-\-\-/gi, '-');
             slug = slug.replace(/\-\-/gi, '-');
             //Xóa các ký tự gạch ngang ở đầu và cuối
             slug = '@' + slug + '@';
             slug = slug.replace(/\@\-|\-\@|\@/gi, '');
             //In slug ra textbox có id “slug”
         document.getElementById('convert_slug').value = slug;
     }
      



</script>



<script type="text/javascript" src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
<script>
 CKEDITOR.replace('noidung_chapter');
</script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  $('.truyennoibat').change(function(){
    const truyennoibat = $(this).val();
    const truyen_id = $(this).data('truyen_id');
    var _token = $('input[name="_token"]').val();
    if(truyennoibat==0){
            var thongbao = 'Thay đổi truyện mới thành công';
        }else if(truyennoibat==1){
            var thongbao = 'Thay đổi truyện Top ngày thành công';
        }else if(truyennoibat==2){
          var thongbao = 'Thay đổi truyện Top tuần thành công';
        }else{
            var thongbao = 'Thay đổi truyện Top tháng thành công';
        }
    $.ajax({
            url:"{{url('/truyennoibat')}}",
            method:"POST",
            data:{truyennoibat:truyennoibat, truyen_id:truyen_id, _token:_token},
            success:function(data)
                {
                   alert(thongbao);
                }   
        });
  })
</script>

<script type="text/javascript">
	function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
		$('.image-upload-wrap').addClass('image-dropping');
	});
	$('.image-upload-wrap').bind('dragleave', function () {
		$('.image-upload-wrap').removeClass('image-dropping');
});

</script>
</body>
</html>





<style type="text/css">
		.menu{
  /* -webkit-box-shadow: 7px 13px 24px -27px rgba(231,166,26,1);
-moz-box-shadow: 7px 13px 24px -27px rgba(231,166,26,1);
box-shadow: 7px 13px 24px -27px rgba(231,166,26,1);*/
   background: #fff;
   position: fixed;
   z-index: 99999;
   height: 75px;
}
.menu nav{ 
  width: 100%;
}
 .menu label.logo{
  color: black;
  font-size: 35px;
  padding: 6px 50px;
  font-weight: bold;
  float: left;
}
 .menu nav ul{
  float: left;
  margin-right: 25px;
}
 .menu nav ul li{
  display: inline-block;
  margin: 18px 10px;
}
nav ul li a{
  color: black;
  font-size: 17px;
  padding: 7px 10px;
  border-radius: 3px;

}
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