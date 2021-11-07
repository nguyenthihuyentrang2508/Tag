
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

<p class="m-0" style="font-size: 145%; font-weight: bold">Truyện đề cử</p>
  <div class="owl-carousel owl-theme">

  @foreach($slide_truyen as $key => $slide)
  <a  href="{{url('xem-truyen/'.$slide->slug_truyen)}}" class="text-dark">
    <div class="card p-0 bg-dark text-white">
      <img src="{{asset('public/uploads/truyen/'.$slide->hinhanh)}}" width="100%" height="300px" class="card-img" alt="...">
      <div class="card-img-overlay p-0" style="margin-top:225px">
        <div style="background-color: hsla(0, 100%, 90%, 0.5);">
          <p class="card-title resomer1 p-0 mt-0 mb-0 ml-3 text-center" style="font-size: 20px ;color: white; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;" >{{$slide->tentruyen}}</p>
          @php
          $count_chapter = count($slide->chapter);
          @endphp
          @if($count_chapter)
          <p class="card-text p-0 mt-0 mb-0 ml-2 float-left" style=" color: white; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">Chương {{$count_chapter}}</p>
            <p class="card-text p-0 mt-0 mb-0 mr-2 float-right" style=" color: white; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
              <i class="far fa-clock mr-1" style="font-size: 14px;"></i>
              @if($slide->updated_at == null)
            <i style="font-size: 14px" class="m-0">{{ $slide->created_at->diffForHumans()}}</i>
              @else
                  <i style="font-size: 14px" class="m-0"> {{ $slide->updated_at->diffForHumans()}}</i>   
              @endif
            </p>
          @else
          <p class="card-text resomer1 p-0 mt-0 mb-0 ml-3" style=" color: white; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">Chương truyện đang được cập nhật...</p>
          @endif
          <div style="clear:both"></div>
        </div>
      </div>
    </div>
  </a> 
  @endforeach
    
  </div>