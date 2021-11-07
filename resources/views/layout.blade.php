<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}"></meta>

        <title>Đọc truyện Online</title>
       
        <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
 	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
       
    </head> 
    <body id="scroll_height">
	<style type="text/css">
  a:hover{
    text-decoration: none;
  }
		.menu{
  /* -webkit-box-shadow: 7px 13px 24px -27px rgba(231,166,26,1);
-moz-box-shadow: 7px 13px 24px -27px rgba(231,166,26,1);
box-shadow: 7px 13px 24px -27px rgba(231,166,26,1);*/
   background: #fff;
   position: fixed;
   z-index: 99999;
   height: 75px;
   border-bottom: 1px solid #DCDCDC;
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
   
  .resomer{
          width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 25px;
    -webkit-line-clamp: 2;
  
    display: -webkit-box;
    -webkit-box-orient: vertical;
        }

    .resomer2{
    width: 60%;
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 1;

        }

/* .dropdown-menu:before, .dropdown-menu.pull-right:before {
right: 12px;
left: auto;
}

.dropdown-menu::after, .dropdown-menu.pull-right:after {
right: 13px;
left: auto;
} */
         
	</style>
  

<div class="menu_main container-fluid p-0" style="height: 75px;" >
	<div class="menu" style="width: 100%;">
    	<nav>
      <a href="{{url('/')}}">	<label class="logo" style="color: #ff631c; cursor: pointer">LOGO</label></a>
		      <ul>		

		     
		        <li>
		        	<div class="dropdown">
					  <button class="btn btn_color dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					   	Danh mục
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              @foreach($danhmuc as $key => $danh)
					    <a class="dropdown-item" href="{{url('danh-muc/'.$danh->slug_danhmuc)}}">{{$danh->tendanhmuc}}</a>
              @endforeach
					  </div>
					</div>
		        </li>

		        <li>
		        	<div class="dropdown">
					  <button class="btn btn_color dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Thể loại
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              @foreach($theloai as $key => $cate)
					      <a class="dropdown-item" href="{{url('the-loai/'.$cate->slug_theloai)}}">{{$cate->tentheloai}}</a>
              @endforeach
					  </div>
					</div>
		        </li>

		        

		        <li>
            <div class="form-group m-0 p-0">
                <select class="custom-select mr-sm-2" id="switch_color">                   
                      <option value="trang">Trắng</option>
                      <option value="den">Đen</option>                
                </select>
              </div>
		        </li>

            <li style="width: 30px"></li>

            <li>
		        	<div class="dropdown">
					  <button class="btn btn_color" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               @php 
                  $count_noti = count($notification);
               @endphp
                <i class="far fa-bell"></i> <span class="badge rounded-circle" style="position: absolute; top: -3px; background: #ff631c; color: white;">{{$count_noti}}</span>
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              @foreach($notification as $key => $noti)
					      <a class="dropdown-item m-0" style="font-size: 14px;" href="#">{{$noti->truyen->tentruyen}} - {{$noti->tieude}}</a>
                <hr>
              @endforeach
					  </div>
					</div>
		        </li>

		         <li>
		        	<form autocomplete="off" class="box p-2 shadow-sm ml-1" style="background: white; border-radius: 10px;" action="{{url('tim-kiem')}}" method="POST">   
                @csrf
                <div class="dropdown">
			          <input type="search" name="tukhoa" id="keywords" placeholder="Tìm truyện..." class="border-0" style="width: 70%;" />			         
                <button class="btn float-right m-0 p-0" type="submit"><span class="icon pl-2 mr-2" style="width: 15px; border-left: 1px solid #D3D3D3"><i class="fa fa-search"></i></span></button>
                <div id="search_ajax"></div>
                <div style="clear: both;"></div>
                </div>
              </form>
		        </li> 

            
           
            @guest 
                @if (Route::has('login'))
                        <li class="nav-item">
                            <a  class="btn" style="background:  #ff631c; color: white; border-radius: 8px" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                @endif
                @if (Route::has('register'))
                        <li class="nav-item">
                            <a  class="btn" style="background:  #ff631c; color: white; border-radius: 8px" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                @endif  
                @else
                    <li class="nav-item dropdown pr-2">
                        <a id="navbarDropdown" class="btn nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="background:  #ff631c; color: white; border-radius: 8px">
                        @if(Auth::user()->image)
                          <img class="d-flex rounded-circle z-depth-1-half mr-1 float-left" style="margin-top: 0.5px"  width="20px" height="20px" src="{{asset('public/uploads/avatar/'.Auth::user()->image)}}"
                            alt="Avatar">
                        @else
                          <img class="d-flex rounded-circle z-depth-1-half mr-1 float-left" style="margin-top: 0.5px" width="20px" height="20px" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-10.jpg"
                                    alt="Avatar">    
                        @endif
                          <p class="resomer2 float-left"> {{ Auth::user()->name }} </p>
                        </a>

                        <div style="clear: both;"></div>
                        
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" >
                        <a class="dropdown-item m-0" href="{{\url('user-profile',[Auth::user()->id])}}">
                            <div class="icon_box float-left mr-2" style="width: 20px;height: 20px;">
                                
                            <i class="fas fa-user" style="color: #ff631c"></i>
                            </div>
                              <p class="m-0"> Profile </p>
                            </a>

                            <div class="dropdown-divider"></div>
                        @hasanyrole('uploader|admin')
                            <a class="dropdown-item m-0" href="{{route('home')}}">
                            <div class="icon_box float-left mr-2" style="width: 20px;height: 20px;">
                                <svg id="Icon_home" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 47.365 38.763">
                                  <path id="Path" d="M39.6,19.091h5.106a2.436,2.436,0,0,0,1.56-4.448L25.243.47a2.823,2.823,0,0,0-3.121,0L1.1,14.643a2.436,2.436,0,0,0,1.56,4.448H7.765V36.3a2.562,2.562,0,0,0,2.653,2.459h7.959V24.009H28.989V38.763h7.959A2.562,2.562,0,0,0,39.6,36.3Z" transform="translate(0 0)" fill="#ff631c"/>
                                </svg>
                                  </g>
                                </svg>
                            </div>
                              <p class="mt-1 m-0"> Admin </p>
                            </a>
                            <div class="dropdown-divider"></div>
                          @else
                          

                          <a class="dropdown-item m-0" href="https://www.facebook.com/thithaotrinh.nguyen.7">
                            <!-- <div class="icon_box float-left mr-2" style="width: 20px;height: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 35.498 35.498">
                              <path id="ic_language_24px" d="M19.731,2A17.749,17.749,0,1,0,37.5,19.749,17.74,17.74,0,0,0,19.731,2Zm12.3,10.649H26.8a27.775,27.775,0,0,0-2.449-6.319A14.252,14.252,0,0,1,32.031,12.649ZM19.749,5.621a25,25,0,0,1,3.39,7.029h-6.78A25,25,0,0,1,19.749,5.621ZM6.011,23.3a13.884,13.884,0,0,1,0-7.1h6a29.313,29.313,0,0,0-.248,3.55,29.313,29.313,0,0,0,.248,3.55Zm1.455,3.55H12.7a27.776,27.776,0,0,0,2.449,6.319,14.176,14.176,0,0,1-7.685-6.319Zm5.236-14.2H7.467a14.176,14.176,0,0,1,7.685-6.319A27.776,27.776,0,0,0,12.7,12.649Zm7.046,21.228a25,25,0,0,1-3.39-7.029h6.78A25,25,0,0,1,19.749,33.877ZM23.9,23.3H15.6a26.114,26.114,0,0,1-.284-3.55A25.887,25.887,0,0,1,15.6,16.2H23.9a25.887,25.887,0,0,1,.284,3.55A26.114,26.114,0,0,1,23.9,23.3Zm.444,9.868A27.776,27.776,0,0,0,26.8,26.849h5.236A14.252,14.252,0,0,1,24.346,33.167ZM27.488,23.3a29.313,29.313,0,0,0,.248-3.55,29.313,29.313,0,0,0-.248-3.55h6a13.884,13.884,0,0,1,0,7.1Z" transform="translate(-2 -2)" fill="#ff631c"/>
                            </svg>
                                
                            </div> -->
                              <p class="mt-1 m-0"> Đăng ký upload </p>
                            </a>
                            <div class="dropdown-divider"></div>
                          @endrole

                            <a class="dropdown-item m-0" href="{{\url('user-settings',[Auth::user()->id])}}">
                                <div class="icon_box float-left mr-2" style="width: 20px;height: 20px;">
                                <i class="fas fa-cog"style="color: #ff631c"></i>
                                </div>
                                  <p class="m-0"> Cài đặt </p>
                            </a>
                            <div class="dropdown-divider"></div>
                            

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                            <div class="icon_box float-left mr-2" style="width: 20px;height: 20px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 37.979 32.876">
                                                <g id="Group_2" data-name="Group 2" transform="translate(-508.223 -782.414)">
                                                  <path id="Path_110" data-name="Path 110" d="M524.46,783.914H512.142s-2.54.792-2.413,4.3,0,23.313,0,23.313a2.8,2.8,0,0,0,2.413,2.15c2.032.226,12.317,0,12.317,0" transform="translate(0 0)" fill="none" stroke="#ff631c" stroke-width="3"/>
                                                  <path id="Path_111" data-name="Path 111" d="M514.632,793H540.79" transform="translate(3.719 6.641)" fill="none" stroke="#ff631c" stroke-width="3"/>
                                                  <path id="Path_112" data-name="Path 112" d="M523.656,787.969l8.127,7.984-8.127,7.165" transform="translate(12.219 3.819)" fill="none" stroke="#ff631c" stroke-width="3"/>
                                                </g>
                                              </svg>                                           
                                            </div>
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

</div>

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


<div class="container mt-2">

  


	<!-- <div class="slide p-0">
		<img src="img/image_story/tlou.jpg" width="100%" height="100%">
	</div> -->
  @yield('slide')

 


   @yield('content')
		<!-- Dãy ngăn cách 2 cột -->

	<div class="container p-0">
	<!-- ---Truyện đề xuất--- -->
<p class=" mt-1 m-0" style="font-size: 145%; font-weight: bold;">Đề xuất</p>
<div class=" table-responsive">
    <div class="mb-1" style="width: 800px;">

      @foreach($dexuat_theloai as $key => $cate)
      <div class="btn float-left m-1 p-1 pl-3 pr-3" style="background: #eee9e9;border-radius: 15px;"><a style="color: black" href="{{url('the-loai/'.$cate->slug_theloai)}}">{{$cate->tentheloai}}</a></div>
      @endforeach

      <div style="clear: both;"></div>
</div>
    </div>

    <div class="row p-0 mt-2">
    @foreach($dexuat_truyen as $key => $dexuat)
    	<div class="col-4 m-0">
     
    		          <div class="mb-2">
                  <div class="row m-0 text-left " >
                   
                    <div class="post_story_box  mb-2" style=" width: 100%; height: 150px">
                       <div class=" shadow-sm" style="width: 100%;border-radius: 8px;">
                       <a href="{{url('xem-truyen/'.$dexuat->slug_truyen)}}" class="text-dark">
                     <div class="image_book_box float-left" style="width: 30%;">
                       <img src="{{asset('public/uploads/truyen/'.$dexuat->hinhanh)}}" width="100%" height="150px" style="border-radius: 8px">
                     </div>
                     <div class="image_book_box pl-2 float-right" style="width: 70%;">

                       <p class="title_story mb-0 font-weight-bold resomer1" style="font-size: 110%;">{{$dexuat->tentruyen}} </p>
                       <p class="m-0">{{$dexuat->danhmuctruyen->tendanhmuc}}</p>
                       <!-- @php
                        $count_chapter = count($dexuat->chapter);
                        @endphp
                        @if($count_chapter)
                        <p class="m-0" style="font-size: 100%">Chương {{$count_chapter}}</p>
                        @else
                        <p class="m-0 text-danger">Hiện tại chưa có chương mới...</p>
                        @endif -->
                      </a>  
                       <div class="tag_box">
                       @foreach($dexuat->thuocnhieutheloaitruyen as $thuocloai)
                        <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><div class="btn mt-1 mb-1 font-weight-bold" style="font-size: 12px; background: #ff631c; color: white;padding: 0px 5px 0px 5px;">{{$thuocloai->tentheloai}}</div></a>
                        @endforeach
                       </div>
                       <i class="resomer m-0" style="font-size: 95%;">Nội dung: {{$dexuat->tomtat}}</i>
                       <p style="font-size: 85%" class="comment_story m-0 mt-2" > <i class="fa fa-eye mr-1"></i>  {{ views($dexuat)->count() }} lượt xem   </p>
                       
                     </div>
                     <div style="clear: both;"></div>
                     </div>
                  </div>
              </div>
          </div>
       
    	</div>
      @endforeach

    



    </div>
</div>

<a href="#" class="btn mb-5 mr-3" style="position: fixed; bottom: 0; right: 0; z-index: 999;" >
        <i class="fas fa-chevron-up" style="font-size: 40px; color: #ff631c"></i>
</a> 

<script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>  
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
<script type="text/javascript">
 $('#keywords').keyup(function(){
          var keywords = $(this).val();

            if(keywords != '')
              {
               var _token = $('input[name="_token"]').val();

               $.ajax({
                url:"{{url('/timkiem-ajax')}}",
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

<script type="text/javascript">
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    dots:false,
    nav: true,
    autoplay:true,   
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>
<script type="text/javascript"> 
  $('#select-chapter').on('change',function(){
      var url = $(this).val();
      alert(url);
      if(url){
		window.location = url;
	  }
	  return false;
  });
</script>
<style>
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
<script type="text/javascript">
      show_wishlist();
      function show_wishlist(){
          if(localStorage.getItem('wishlist_truyen')!=null){

             var data = JSON.parse(localStorage.getItem('wishlist_truyen'));

             data.reverse();

             for(i=0;i<data.length;i++){

                var title = data[i].title;
                var img = data[i].img;
                var id = data[i].id;
                var url = data[i].url;
                var content = data[i].content;
                $('#yeuthich').append(` 

                <div class="mb-2">
             
                    <div class="row m-0 text-left " >
                    
                      <div class="post_story_box  mb-2" style=" width: 100%;">
                        <div class=" shadow-sm" style="width: 100%;border-radius: 8px;">
                        <a href="`+url+`" class="text-dark">
                      <div class="image_book_box float-left" style="width: 15%;">
                        <img class="card-img-top" src="`+img+`" alt="`+title+`" width="50px" height="70px" style="border-radius: 8px; display:block;">
                      </div>
                        </a>
                      <div class="image_book_box pl-2 float-right" style="width: 85%;">
                      
                      <a class="text-dark" href="`+url+`">
                        <p class="title_story mb-0 font-weight-bold resomer1" style="font-size: 110%;">`+title+`</p>
                       
                        <p class="m-0" style="font-size: 100%">Tác giả: `+content+`</p>
                       
                      </a>        
                      <button style="font-size: 85%; background: white; border-radius: 4px" class="delete_withlist delete mr-2 m-0 border-0 float-right font-weight-bold">Xóa<i class="fas fa-times ml-1"></i></button>
                      </div>
                      <div style="clear: both;"></div>
                      </div>
                    </div>
                </div>
                
            </div>
                  
                 `);
            }

          }
      }
      $('.btn-thich_truyen').click(function(){
        
        $('.fa.fa-heart').css('color','red');
        const id = $('.wishlist_id').val();
        const title = $('.wishlist_title').val();
        const img = $('.card-img-top').attr('src');
        const url = $('.wishlist_url').val();
        const content = $('.wishlist_content').val();
        // alert(id);
        // alert(title);
        // alert(img);
        // alert(url);
        const item = {
          'id': id,
          'title': title,
          'img': img,
          'url': url,
          'content' : content
        }
        if(localStorage.getItem('wishlist_truyen')==null){
           localStorage.setItem('wishlist_truyen', '[]');
        }
        var old_data = JSON.parse(localStorage.getItem('wishlist_truyen'));
        var matches = $.grep(old_data, function(obj){
            return obj.id == id;
        })
        var data = JSON.parse(localStorage.getItem('wishlist_truyen'));
        if(matches.length){
            alert('Truyện đã có trong danh sách yêu thích');        
               
        }else{
            if(old_data.length<=10){
              old_data.push(item);                           
            }else{
              alert('Đã đạt tới giới hạn lưu truyện yêu thích.');
            }
            $('#yeuthich').append(`

            <div class="mb-2">
             
             <div class="row m-0 text-left " >
             
               <div class="post_story_box  mb-2" style=" width: 100%;">
                 <div class=" shadow-sm" style="width: 100%;border-radius: 8px;">
                 <a class"text-dark" href="`+url+`">
               <div class="image_book_box float-left" style="width: 15%;">
                 <img class="card-img-top" src="`+img+`" alt="`+title+`" width="50px" height="75px" style="border-radius: 8px; display:block;">
               </div>
                 </a>
               <div class="image_book_box pl-2 float-right" style="width: 85%;">
               
               <a class"text-dark" href="`+url+`">
                 <p class="title_story mb-0 font-weight-bold resomer1" style="font-size: 110%;margin-top: 5px;">`+title+`</p>
                
                 <p class="m-0" style="font-size: 100%">Tác giả `+content+`</p>
                
               </a>        
               </div>
               <div style="clear: both;"></div>
               </div>
             </div>
         </div>
         
     </div>
              `);
             
            localStorage.setItem('wishlist_truyen', JSON.stringify(old_data));
            alert('Đã lưu vào danh sách truyện yêu thích.');
            
        }
       
         localStorage.setItem('wishlist_truyen', JSON.stringify(old_data));
             
      }); 

$(document).on('click','.delete_withlist',function(event) {
              event.preventDefault();
              
              var result = JSON.parse(localStorage.getItem('wishlist_truyen'));
              for(i=0;i<result.length;i++){
                var id = result[i].id;
              }
              if (result) {
                for(var i = 0; i < result.length; i++) {
                    if(result[i].id == id) {
                     result.splice(i,i);
                     break;
                 }
             }
             localStorage.setItem('wishlist_truyen',JSON.stringify(result));
             swal({
                title: 'Truyện đã được xóa khỏi danh mục yêu thích!!!',
                icon: "success",
                button: "Quay lại",
            }).then(ok=>{
               window.location.reload();
            });

         }
         if(result.length==1){
          for(var i = 0; i < result.length; i++) {
            if(result[i].id == id) {
             result.splice(i,1);
             break;
         }
     }
     localStorage.setItem('wishlist_truyen',JSON.stringify(result));
     swal({
                title: 'Truyện đã được xóa khỏi danh mục yêu thích!!!',
                icon: "success",
                button: "Quay lại",
            }).then(ok=>{
               window.location.reload();
            });
 }

});
    </script>

<!-- <script type="text/javascript">
    $(document).ready(function(){
      
      load_comment(); 
     
        function load_comment(){
        var truyen_id = $('.comment_truyen_id').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
                  url:"{{url('/load-comment')}}",
                  method:"POST",
                  data:{truyen_id = truyen_id, _token:_token},
                  success:function(data){
                  $('#comment_show').htmlt(data);  
                  
                  }
                });

              }
    }); 
</script> -->
<style>
          h5{
            font-weight: bold;
            line-height: 25px;
          }
           .switch_color{
            background: #181818;
            color: #fff  !important;
          }
          .switch_color_light{
            background: #181818 !important;
            color: white !important;
          }
          .noidung_color {
            color:#000;
          }
</style>
<script type="text/javascript">
      $(document).ready(function(){

         if(localStorage.getItem('switch_color')!==null){
            const data = localStorage.getItem('switch_color');
            const data_obj = JSON.parse(data);
            $(document.body).addClass(data_obj.class_1);
            $('.album').addClass(data_obj.class_2);
            $('.btn_color').addClass(data_obj.class_1);
            $('.menu').addClass(data_obj.class_1);
            $('.story_1').addClass(data_obj.class_1);
            $('.text-dark').addClass(data_obj.class_1);
            $("select option[value='den']").attr("selected", "selected");


          }
        })
      $("#switch_color").change(function(){
           $(document.body).toggleClass('switch_color');
           $(document.nav).toggleClass('switch_color');
           $('.menu').toggleClass('switch_color');
            $('.btn_color').toggleClass('switch_color');
            $('.tentruyen').toggleClass('switch_color_light');
             $('.noidungchuong').addClass('noidung_color');
             $('.story_1').toggleClass('switch_color');
             $('.text-dark').toggleClass('switch_color');
           if($(this).val() == 'den'){

               var item = {
                  'class_1':'switch_color',
                  'class_2':'switch_color_light'
                 
                }   
              localStorage.setItem('switch_color', JSON.stringify(item));

            }else if($(this).val() == 'trang'){
              
              localStorage.removeItem('switch_color');
              $('ul.mucluctruyen > li > a').css('color','#000');
               $('.sidebar > a').css('color','#000');
             
            }

          
          
          
      });

    </script>

  <script>
    function remove_background(truyen_id){
      for(var count = 1; count <= 5; count++){
        $('#'+truyen_id+'-'+count).css('color', '#ccc');
      }
    }
    //hover chuột đánh giá sao
    $(document).on('mouseenter', '.rating', function(){
      var index = $(this).data("index");
      var truyen_id = $(this).data('truyen_id');
      remove_background(truyen_id);

      for(var count = 1; count<=index; count++){
        $('#'+truyen_id+'-'+count).css('color', '#ffcc00');
      }
    });  
    //Nhả chuột ko đánh giá sao
    $(document).on('mouseleave', '.rating', function(){
      var index = $(this).data("index");
      var truyen_id = $(this).data('truyen_id');
      var rating = $(this).data("rating");
      remove_background(truyen_id);
      for(var count = 1; count<=rating; count++){
        $('#'+truyen_id+'-'+count).css('color', '#ffcc00');
      }
    });

    //click đánh giá sao
    $(document).on('click', '.rating',function(){
      var index = $(this).data("index");
      var truyen_id = $(this).data('truyen_id');
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url: "{{url('insert-rating')}}",
        method: "POST",
        data: {index:index, truyen_id:truyen_id, _token:_token},
        success:function(data){
          if(data == 'done')
          {
            alert("Bạn đã đánh giá "+index +" trên 5 ");
          }
          else{
            alert("Lỗi đánh giá");
          }
        }
      });
    });
  </script>



  <script type = "text/javascript" >

$(document).ready(function() {

    var color = $('#change-color :selected').val();
    var color_font = $('#change-color-font :selected').val();
    var font = $('#change-font :selected').val();
    var lineheight = $('#change-lineheight :selected').val();


    if (localStorage.getItem("chapter_style") === null) {

        $('.noidungchuong').css({         
            'line-height': '40px',
            'font-size': '25px',
            'font-family': '"Palatino Linotype","Arial"'
        });
    } else if (localStorage.getItem("chapter_style") !== null) {


        const data = localStorage.getItem('chapter_style');
        const data_obj = JSON.parse(data);

        $("select option[value='" + data_obj.color + "']").attr("selected", "selected");
        $("select option[value='" + data_obj.color_font + "']").attr("selected", "selected");
        $("select option[value='" + data_obj.font + "']").attr("selected", "selected");
        $("select option[value='" + data_obj.lineheight + "']").attr("selected", "selected");

        $('.noidungchuong').css({
            'background': '#' + data_obj.color,
            'color': '#' + data_obj.color_font,
            'line-height': data_obj.lineheight + 'px',
            'font-family': data_obj.font,
            'font-size': data_obj.font_size,
            
        });

    }


    $('#change-color,#change-color-font,#change-font,#change-lineheight').on('change', function() {

        var color = $('#change-color :selected').val();
        var color_font = $('#change-color-font :selected').val();
        var font = $('#change-font :selected').val();
        var lineheight = $('#change-lineheight :selected').val();

        //localstorage




        localStorage.setItem('chapter_style', '[]');
        var newItem = {
            'color': color,
            'font': font,
            'lineheight': lineheight,
            'font_size': 25,
            'color_font': color_font,
            

        }
        localStorage.setItem('chapter_style', JSON.stringify(newItem));




        // var old_data = JSON.parse(localStorage.getItem('chapter_style'));

        const data = localStorage.getItem('chapter_style');
        const data_obj = JSON.parse(data);


        if (color != '' || font != '' || lineheight != '') {
            $('.noidungchuong').css({
                'background': '#' + data_obj.color,
                'line-height': data_obj.lineheight + 'px',
                'font-family': data_obj.font,
                'font-size': data_obj.font_size,
                'color': '#' + data_obj.color_font,
                 
            });
        }

    });

    var $affectedElements = $('.noidungchuong');

    $('.size-increment').click(function() {
        changeFontSize(2);

    })
    $('.size-decrement').click(function() {
        changeFontSize(-2);

    })
    $(".size-orig").click(function() {
        $affectedElements.each(function() {
            var $this = $(this);
            $this.css("font-size", $('.size-orig').data('orig_size'));
            // Get the existing data



        });
        if (localStorage.getItem("chapter_style") === null) {
            var newItem = {
                'color': color,
                'color_font': color_font,
                'font': font,
                'lineheight': lineheight,
                'font_size': parseInt($('.size-orig').data('orig_size'))
                
            }
        } else if (localStorage.getItem("chapter_style") !== null) {
            const data = localStorage.getItem('chapter_style');
            const data_obj = JSON.parse(data);
            var newItem = {
                'color': data_obj.color,
                'color_font': data_obj.color_font,
                'font': data_obj.font,
                'lineheight': data_obj.lineheight,
                'font_size': parseInt($('.size-orig').data('orig_size'))
                
            }
        }

        // Save back to localStorage
        localStorage.setItem('chapter_style', JSON.stringify(newItem));

    })

    function changeFontSize(direction) {
        $affectedElements.each(function() {
            var $this = $(this);
            $this.css("font-size", parseInt($this.css("font-size")) + direction);

            // Get the existing data



        });
        if (localStorage.getItem("chapter_style") === null) {
            var newItem = {
                'color': color,
                'color_font': color_font,
                'font': font,
                'lineheight': lineheight,
                'font_size': parseInt($affectedElements.css("font-size")) + direction
                
            }
        } else if (localStorage.getItem("chapter_style") !== null) {
            const data = localStorage.getItem('chapter_style');
            const data_obj = JSON.parse(data);
            var newItem = {
                'color': data_obj.color,
                'color_font': data_obj.color_font,
                'font': data_obj.font,
                'lineheight': data_obj.lineheight,
                'font_size': parseInt($affectedElements.css("font-size")) + direction
               
            }
        }


        // Save back to localStorage
        localStorage.setItem('chapter_style', JSON.stringify(newItem));

    }



})

</script>
   


<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=904936396798004&autoLogAppEvents=1" nonce="9zKBA61a"></script>


</body>
</html>
