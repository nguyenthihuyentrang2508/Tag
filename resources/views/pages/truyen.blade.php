@extends('../layout')

@section('content')



<style>
  .breadcrumb{
    background: none;
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
  .resomer1{
    width: 90%;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 25px;
    -webkit-line-clamp: 1;
    display: -webkit-box;
    -webkit-box-orient: vertical;
        }
    .isDisable{
		pointer-events:none;
		opacity: 0.5;
	}         
</style>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb shadow-sm">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{url('danh-muc/'.$truyen->danhmuctruyen->slug_danhmuc)}}">{{$truyen->danhmuctruyen->tendanhmuc}}</a></li>
    <li class="breadcrumb-item" aria-current="page">{{$truyen->tentruyen}}</li>
  </ol>
</nav>

	<div class="row m-0">


		<div class="col-9 p-2">


<div class="row m-0">
	<div class="col-3 p-0 pr-2">
    <img class="card-img-top"  src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" width="200px" height="300px" style="border-radius: 8px">   
    </div>
        <!-- Lấy biến wishlist -->
    <input type="hidden" value="{{$truyen->tentruyen}}" class="wishlist_title">
		<input type="hidden" value="{{\URL::current()}}" class="wishlist_url">
		<input type="hidden" value="{{$truyen->id}}" class="wishlist_id">
    <input type="hidden" value="{{$truyen->slug_truyen}}" class="slug">
    <input type="hidden" value="{{$truyen->tacgia}}" class="wishlist_content">
         <!-- Lấy biến wishlist -->
      <div class="col-8 p-0 pl-1 ml-3">
        <p class="m-0 font-weight-bold" style="font-size: 135%;line-height: 22px;">{{$truyen->tentruyen}} {{$truyen->thongbao}}</p>

        @if($truyen->updated_at == null)
            <i style="font-size: 14px" class="m-0">[Cập nhật lúc: {{ $truyen->created_at->diffForHumans()}} - {{ $truyen->created_at->toDateString()}}]</i>
        @else
            <i style="font-size: 14px" class="m-0">[Cập nhật lúc: {{ $truyen->updated_at->diffForHumans()}} - {{ $truyen->updated_at->toDateString()}}]</i>   
        @endif

        <div style="width: 350px;">

        <p class="font-weight-bold float-left m-0">Tác giả:</p>
        <p class="float-right m-0">{{$truyen->tacgia}}</p>       
        <div style="clear: both"></div>

        <p class="font-weight-bold float-left m-0">Người đăng:</p>
        <p class="float-right m-0"><a href="{{url('user-profile/'.$truyen->thuocnhieuuser->id)}}">{{$truyen->thuocnhieuuser->name}}</a></p>
        <div style="clear: both"></div>

        <p class="font-weight-bold float-left m-0">Tình trạng:</p>
        <p class="float-right m-0">
                                    @if($truyen->tinhtrang==0)
                                        <span class="">Đang tiến hành</span>
                                    @else
                                        <span class="font-weight-bold">Đã hoàn thành</span>
                                    @endif  
        </p>
        <div style="clear: both"></div>
        
        <p class="font-weight-bold float-left m-0">Danh mục:</p>
        <p class="float-right m-0"><a style="color: #ff631c; font-weight: bold;" href="{{url('danh-muc/'.$truyen->danhmuctruyen->slug_danhmuc)}}">{{$truyen->danhmuctruyen->tendanhmuc}}</a><p>
        <div style="clear: both"></div>

        @php
        $count_chapter = count($chapter);
        $count_chaptertranh = count($chaptertranh);
        @endphp

        @if($count_chapter)
        <p class="font-weight-bold float-left m-0">Số chương:</p>
        <p class="float-right m-0"> {{$count_chapter}}</p>
        <div style="clear: both"></div>
        @elseif($count_chaptertranh)
        <p class="font-weight-bold float-left m-0">Số chương:</p>
        <p class="float-right m-0"> {{$count_chaptertranh}}</p>
        <div style="clear: both"></div>
        @else
        <p class="font-weight-bold float-left m-0">Số chương:</p>
        <p class="float-right m-0"> Chưa có chương nào</p>
        <div style="clear: both"></div>
        @endif

        <p class="font-weight-bold float-left">Lượt xem:</p>
        <p class="float-right">{{ views($truyen)->count() }}</p>
        <div style="clear: both"></div>

        <p class="font-weight-bold float-left m-0">Đánh giá:</p>
        <div class="float-right m-0">
          @if(Auth::user())
          <ul class="list-inline m-0" title="Average Rating">
              @for($count = 1; $count <= 5; $count++)
              @php 
               if($count<=$rating){
                 $color = 'color: #ffcc00;';
               }else{
                 $color = 'color: #ccc;';
               }
               @endphp
              <li id="{{$truyen->id}}-{{$count}}" data-index="{{$count}}" data-truyen_id="{{$truyen->id}}" data-rating = "{{$rating}}" class="rating mr-1 float-left m-0" style="cursor: pointer; {{$color}} ; font-size: 20px">
                &#9733
              </li>
              @endfor
          </ul>
          @else
          <ul class="list-inline m-0" title="Average Rating">
              @for($count = 1; $count <= 5; $count++)
              @php 
               if($count<=$rating){
                 $color = 'color: #ffcc00;';
               }else{
                 $color = 'color: #ccc;';
               }
               @endphp
              <li id="{{$truyen->id}}-{{$count}}" data-index="{{$count}}" data-truyen_id="{{$truyen->id}}" data-rating = "{{$rating}}" class="rating mr-1 float-left m-0" style="pointer-events:none; {{$color}} ; font-size: 20px">
                &#9733
              </li>
              @endfor
          </ul>
          @endif
        </div>
        <div style="clear: both"></div>
       
        @if($chapter_dau)
        <a href="{{url('xem-chapter/'.$chapter_dau->truyen->slug_truyen.'/'.$chapter_dau->slug_chapter)}}"><div class="btn pt-1 pb-1 font-weight-bold m-0 float-left mr-2" style=" background: #ff631c; color: white; border-radius: 8px"><i class="fas fa-book-open mr-2"></i>Bắt đầu đọc</div></a>
        @elseif($chaptertranh_dau)
        <a href="{{url('xem-chapter-tranh/'.$chaptertranh_dau->truyen->slug_truyen.'/'.$chaptertranh_dau->slug_chaptertranh)}}"><div class="btn pt-1 pb-1 font-weight-bold m-0 float-left mr-2" style=" background: #ff631c; color: white; border-radius: 8px"><i class="fas fa-book-open mr-2"></i>Bắt đầu đọc</div></a>
        @else
        <a><div class="btn pt-1 pb-1 font-weight-bold m-0 mb-2" style="background: #DC143C; color: white; border-radius: 8px;">Hiện tại chưa có chương mới...</div></a>
        @endif  
        
        @if(Auth::user())
        <div class="btn btn-thich_truyen pt-1 pb-1 font-weight-bold" style="background: #ff631c;  border-radius: 8px; color: white"><i class="fa fa-heart mr-2" aria-hidden="true"></i>Yêu thích</div>
        @else
        <div class="btn btn-thich_truyen pt-1 pb-1 font-weight-bold isDisable" style="background: #ff631c;  border-radius: 8px; color: white"><i class="fa fa-heart mr-2" aria-hidden="true"></i>Yêu thích</div>
        @endif
        <div style="clear: left"></div>
        @if($chapter_dau)
        <a href="{{url('xem-chapter/'.$chapter_cuoi->truyen->slug_truyen.'/'.$chapter_cuoi->slug_chapter)}}"> <div class="btn mt-3 pt-1 pb-1 font-weight-bold m-0" style=" background: #ff631c; color: white; border-radius: 8px">Đọc chương mới nhất</div></a>
        @elseif($chaptertranh_dau)
        <a href="{{url('xem-chapter-tranh/'.$chaptertranh_cuoi->truyen->slug_truyen.'/'.$chaptertranh_cuoi->slug_chaptertranh)}}"> <div class="btn mt-3 pt-1 pb-1 font-weight-bold m-0" style=" background: #ff631c; color: white; border-radius: 8px">Đọc chương mới nhất</div></a>
        @else
        <div></div>
        @endif    
      </div>
        
      </div>
</div>

<div>
  <p class="font-weight-bold m-0 mb-1 mt-3" style="font-size: 125%">Thể loại</p>
  @foreach($truyen->thuocnhieutheloaitruyen as $thuocloai)
   <a  href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><div class="btn font-weight-bold" style=" background: #ff631c; color: white;padding: 0px 5px 0px 5px;">{{$thuocloai->tentheloai}}</div></a>
   @endforeach
</div>

<div>
	 <p class="font-weight-bold m-0 mb-1 mt-3" style="font-size: 125%">Nội dung</p>
	 <p>
	 {{$truyen->tomtat}}
	 </p>
</div>

<style type="text/css">
  .tagcloud05 ul {
    margin: 0;
    padding: 0;
    list-style: none;
  }
  .tagcloud05 ul li {
    display: inline-block;
    margin: 0 0 .3em 1em;
    padding: 0;
  }
  .tagcloud05 ul li a {
    position: relative;
    display: inline-block;
    height: 30px;
    line-height: 30px;
    padding: 0 1em;
    background-color: #3498db;
    border-radius: 0 3px 3px 0;
    color: #fff;
    font-size: 13px;
    text-decoration: none;
    -webkit-transition: .2s;
    transition: .2s;
  }
  .tagcloud05 ul li a::before {
    position: absolute;
    top: 0;
    left: -15px;
    content: '';
    width: 0;
    height: 0;
    border-color: transparent #3498db transparent transparent;
    border-style: solid;
    border-width: 15px 15px 15px 0;
    -webkit-transition: .2s;
    transition: .2s;
  }
  .tagcloud05 ul li a::after {
    position: absolute;
    top: 50%;
    left: 0;
    z-index: 2;
    display: block;
    content: '';
    width: 6px;
    height: 6px;
    margin-top: -3px;
    background-color: #fff;
    border-radius: 100%;
  }
  .tagcloud05 ul li span {
    display: block;
    max-width: 100px;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
  }
  .tagcloud05 ul li a:hover {
    background-color: #555;
    color: #fff;
  }
  .tagcloud05 ul li a:hover::before {
    border-right-color: #555;
  }

</style>

<style type="text/css">
 	tr td{
 		border-bottom: 1px solid #D3D3D3; 
 		padding: 8px;
     cursor: pointer;
 	}
 	tbody tr:hover{
 		color: white;
 		background: #ff631c;
    
 	}
   #truyenlienquan:hover{
     text-decoration: none;
   }
</style>

<p>Từ khóa tìm kiếm:
  @php
    $tukhoa = explode(",", $truyen->tukhoa);
  @endphp
  <div class="tagcloud05">
    <ul>
      @foreach ($tukhoa as $key => $tu )
      <li><a href="{{url('tag/'.\Str::slug($tu))}}"><span>{{$tu}}</span></a></li>
      @endforeach     
    </ul>
  </div>  
</p>

 
<div>
	 <p class="font-weight-bold m-0 mb-1 mt-3" style="font-size: 125%">Danh sách chương</p>

  @php
    $mucluc = count($chapter);
    $mucluc_tranh = count($chaptertranh);
  @endphp

  @if($mucluc>0)
	<table style="width: 100%;">
	<thead>
	  <tr>
	    <th>Chương mới</th>
	    <th>Cập nhật</th>
	    <th>Lượt xem</th>
	  </tr>
  </thead>

  <tbody> 

 @foreach($chapter as $key => $chap)   
    <tr onclick="location.href='{{url('xem-chapter/'.$chap->truyen->slug_truyen.'/'.$chap->slug_chapter)}}'" >
     
      <td>{{$chap->tieude}}</td>
      <td>
          @if($chap->updated_at == null )
            <i class="m-0">{{ $chap->created_at->diffForHumans()}}</i>
          @else
            <i class="m-0">{{ $chap->updated_at->diffForHumans()}}</i>   
          @endif
      </td>
      <td>{{ views($chap)->count() }}</td>
     
    </tr>
 
 @endforeach 
 

 

  </tbody>
  </table>
  <div class="text-center" style="margin: 0 auto; width: 100%"><a href="#" style="color: #ff631c; font-size: 120% ">Xem tất cả</a></div>
@elseif($mucluc_tranh>0)
<table style="width: 100%;">
	<thead>
	  <tr>
	    <th>Chương mới</th>
	    <th>Cập nhật</th>
	    <th>Lượt xem</th>
	  </tr>
  </thead>

  <tbody>

 @foreach($chaptertranh as $key => $chap)   
    <tr onclick="location.href='{{url('xem-chapter-tranh/'.$chap->truyen->slug_truyen.'/'.$chap->slug_chaptertranh)}}'">
     
      <td>{{$chap->tieude}}</td>
      <td>
          @if($chap->updated_at == null )
            <i class="m-0">{{ $chap->created_at->diffForHumans()}}</i>
          @else
            <i class="m-0">{{ $chap->updated_at->diffForHumans()}}</i>   
          @endif
      </td>
      <td>{{ views($chap)->count() }}</td>
     
    </tr>
 
 @endforeach 

  </tbody>
  </table>
  <div class="text-center" style="margin: 0 auto; width: 100%"><a href="#" style="color: #ff631c; font-size: 120% ">Xem tất cả</a></div>

@else
<div class="card-body mt-3 bg-warning text-white text-center m-0">
    <p class="m-0 font-weight-bold">Truyện hiện tại chưa có chương mới... </p>
    <i class="fas fa-exclamation-triangle mt-2" style="font-size: 145%;"></i>
</div>
@endif    
</div>

</div>
<div class="col-3 p-0">

@if(Auth::user())  
   <div>
				<p class="font-weight-bold m-0 mb-1 mt-3" style="font-size: 125%">Truyện yêu thích</p>
        <div class="mt-3"   data-spy="scroll" data-target="#myScrollspy" data-offset="10"  id="scroll_height" style="overflow-y: scroll; height: 150px">
        <div id="yeuthich"></div>
        </div>
   </div>
   @else
      <div> 
        <div class="btn p-2 border-0 text-center font-weight-bold w-100" style="border-radius: 8px; background: #ff631c; color: white;">Truyện yêu thích</div>
        <p class="text-center" style="font-size: 14px;">Hãy <a href="{{ route('login') }}" class="m-0" style="color:  #ff631c;">đăng nhập</a> để sử dụng tính năng này</p>
      </div>    
   @endif 
   <hr>
			<div>
				<p class="font-weight-bold m-0 mb-1 mt-3" style="font-size: 125%">Truyện liên quan</p>

        @foreach($cungdanhmuc as $key => $value)
				<div class="m-0">
                  <div class="row m-0 text-left " >
                   
                    <div class="post_story_box mb-2" style=" width: 100%; height: 165px">
                       <div class=" shadow-sm" style="width: 100%;border-radius: 8px;">
                       <a id="truyenlienquan"  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                        <div class="image_book_box float-left" style="width: 35%;">
                          <img  src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" width="100%" height="145px" style="border-radius: 8px">
                        </div>
                      </a>
                     <div class="image_book_box pl-2 float-right" style="width: 65%;">

                       
                     <a id="truyenlienquan"  href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="text-dark">
                        <p class="title_story mb-0 font-weight-bold resomer1" style="font-size: 110%;">{{$value->tentruyen}}</p>
                        <p class="m-0">{{$value->danhmuctruyen->tendanhmuc}}</p>
                      </a>  
                      <i class="resomer m-0" style="font-size: 95%;">Nội dung: {{$value->tomtat}}</i>
                       <p style="font-size: 85%" class="comment_story m-0 mt-2" ><i class="fa fa-eye mr-1"></i> {{ views($value)->count() }} lượt xem</p>
                       
                     </div>
                     <div style="clear: both;"></div>
                     </div>
                  </div>
              </div>
          </div>
   @endforeach


   

        


          


			</div>	
      	
		</div>
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
          <textarea class="form-control z-depth-1 shadow-sm" id="exampleFormControlTextarea345" rows="3" placeholder="Viết bình luận của bạn ở đây..." name="body"></textarea>
           <input type="hidden" name ="truyen_id" value="{{$truyen->id}}">
          <input type="submit" value="Đăng" class="form-control z-depth-1 shadow-sm w-25 mt-2" style="background: white;">
        </div>
      </div>
      @else
      <div class="p-3" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> 
        <p class="text-center m-0" style="font-size: 14px;">Hãy <a href="{{ route('login') }}" class="m-0" style="color:  #ff631c;">đăng nhập</a> để có thể bình luận được ở đây!</p>
      </div>   
      @endif  
</div>
@include('pages.commentsDisplay', ['comments' => $truyen->comments, 'truyen_id' => $truyen->id])
  

  </div>
</div>

</div>
</form>

@endsection        