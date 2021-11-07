<?php

namespace App\Http\Controllers;
use App\Models\Chapter;
use App\Models\ChapterTranh;
use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Theloai;
use App\Models\Truyen;
use App\Models\Rating;
use App\Models\User;
use CyrildeWit\EloquentViewable\Contracts\Views;
use Symfony\Polyfill\Intl\Idn\Info;

class IndexController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function home(){
        $danhmuc = DanhmucTruyen::orderBy('id','ASC')->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $slide_truyen = Truyen::orderBy('id','ASC')->where('kichhoat',0)->take(8)->get();

        $notification = Chapter::with('truyen')->orderBy('created_at','DESC')->take(6)->get();
      
        $truyen = Truyen::with('thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat', 0)->paginate(10);
        $truyentopngay = Truyen::where('truyen_noibat',1)->take(3)->get();
        $truyentoptuan = Truyen::where('truyen_noibat',2)->take(3)->get();
        $truyentopthang = Truyen::where('truyen_noibat',3)->take(3)->get();
      
        $chuong_moinhat = Truyen::with('thuocnhieutheloaitruyen')->orderBy('updated_at','DESC')->where('kichhoat', 0)->paginate(10);
       
        $dexuat_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(3)->get();
        $dexuat_theloai = Theloai::orderBy('id','DESC')->take(4)->get();
        return view('pages.home')->with(compact('danhmuc','truyen','theloai','slide_truyen','dexuat_truyen','dexuat_theloai','chuong_moinhat', 'truyentopngay','truyentoptuan','truyentopthang','notification'));
        
    }
    public function danhmuc($slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','ASC')->get(); 
        
        $notification = Chapter::with('truyen')->orderBy('created_at','DESC')->take(6)->get();

        $dexuat_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(3)->get();
        $dexuat_theloai = Theloai::orderBy('id','DESC')->take(4)->get();
        
        $danhmuc_id = DanhmucTruyen::where('slug_danhmuc',$slug)->first();
        $truyen = Truyen::with('thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat', 0)->where('danhmuc_id', $danhmuc_id->id)->get();
        
        $truyen_chuahoan = Truyen::with('thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat', 0)->where('tinhtrang', 0)->where('danhmuc_id', $danhmuc_id->id)->get();
        $truyen_dahoan = Truyen::with('thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat', 0)->where('tinhtrang', 1)->where('danhmuc_id', $danhmuc_id->id)->get();
        return view('pages.danhmuc')->with(compact('danhmuc','truyen','danhmuc_id','theloai','dexuat_truyen','dexuat_theloai','truyen_chuahoan', 'truyen_dahoan','notification'));
    }
    public function theloai($slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id', 'ASC')->get();      

        $notification = Chapter::with('truyen')->orderBy('created_at','DESC')->take(6)->get();

        $dexuat_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(3)->get();
        $dexuat_theloai = Theloai::orderBy('id','DESC')->take(4)->get();


        
        $tentheloai = Theloai::orderBy('id','DESC')->get();      
        $theloai_id = Theloai::where('slug_theloai',$slug)->first();
      //  $truyen = Truyen::with('thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat', 0)->where('theloai_id', $theloai_id->id)->get();
        $theloaitruyen = Theloai::find($theloai_id->id);
        // dd($danhmuctruyen->nhieutruyen);
        $nhiutruyen = [];
        foreach($theloaitruyen->nhieutheloaitruyen as $cate){
            $nhiutruyen[] = $cate->id;
        }
        $truyen_chuahoan = Truyen::with('thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat', 0)->where('tinhtrang', 0)->whereIn('id',$nhiutruyen)->get();
        $truyen_dahoan = Truyen::with('thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat', 0)->where('tinhtrang', 1)->whereIn('id',$nhiutruyen)->get();

        $truyen = Truyen::with('thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat',0)->whereIn('id',$nhiutruyen)->paginate(12);
        return view('pages.theloai')->with(compact('danhmuc','truyen','theloai','theloai_id','tentheloai','dexuat_truyen','dexuat_theloai','truyen_chuahoan', 'truyen_dahoan','notification'));
    }
    public function xemtruyen($slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','ASC')->get();

        $notification = Chapter::with('truyen')->orderBy('created_at','DESC')->take(6)->get();

        $dexuat_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(3)->get();
        $dexuat_theloai = Theloai::orderBy('id','DESC')->take(4)->get();

        $truyen = Truyen::with('danhmuctruyen','thuocnhieutheloaitruyen')->where('slug_truyen',$slug)->where('kichhoat',0)->first();
        views($truyen)->record();
        


        $chapter = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->get();
        $chapter_dau = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->first();
        $chapter_cuoi = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->first();


        
        $chaptertranh = ChapterTranh::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->get();
        $chaptertranh_dau = ChapterTranh::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->first();
        $chaptertranh_cuoi = ChapterTranh::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->first();

        $cungdanhmuc = Truyen::with('danhmuctruyen','theloai')->where('danhmuc_id',$truyen->danhmuctruyen->id)->whereNotIn('id',[$truyen->id])->take(3)->get();
        
        $rating = Rating::where('truyen_id', $truyen->id)->avg('rating');
        $rating = round($rating);
        return view('pages.truyen')->with(compact('danhmuc','truyen','chapter','cungdanhmuc','chapter_dau','chapter_cuoi','theloai','dexuat_truyen','dexuat_theloai','chaptertranh','chaptertranh_dau','chaptertranh_cuoi','rating','notification'));

    }

    public function xemchapter($slug_truyen, $slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','ASC')->get();

        $dexuat_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(3)->get();
        $dexuat_theloai = Theloai::orderBy('id','DESC')->take(4)->get();

        $notification = Chapter::with('truyen')->orderBy('created_at','DESC')->take(6)->get();

        $truyen = Chapter::where('slug_chapter',$slug)->first();
        $chapter = Chapter::with('truyen')->where('truyen_id',$truyen->truyen_id)->where('slug_chapter',$slug)->first();
        views($chapter)->record();
        //breadcrumb
        $truyen_breadcrumb = Truyen::with('danhmuctruyen','theloai')->where('id',$truyen->truyen_id)->first();
        //endbreadcrumb

        $max_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->first();
        $min_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->first();
        
        $min_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->min('slug_chapter');
        $max_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->max('slug_chapter');

        $all_chapter = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->truyen_id)->get();

        $next_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','>',$chapter->id)->min('slug_chapter');
        $previous_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','<',$chapter->id)->max('slug_chapter');
        return view('pages.chapter')->with(compact('danhmuc','chapter', 'all_chapter','next_chapter','previous_chapter','max_id','min_id','min_chapter','max_chapter','theloai','truyen_breadcrumb','dexuat_truyen','dexuat_theloai','notification'));
    }
    public function xemchaptertranh($slug_truyen, $slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();

        $notification = Chapter::with('truyen')->orderBy('created_at','DESC')->take(6)->get();
        
        $dexuat_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(3)->get();
        $dexuat_theloai = Theloai::orderBy('id','DESC')->take(4)->get();
        
        $truyen = ChapterTranh::where('slug_chaptertranh',$slug)->first();

        //breadcrumb
        $truyen_breadcrumb = Truyen::with('thuocnhieutheloaitruyen')->where('id',$truyen->truyen_id)->first();
        //end breadcrumb    
        
        $chaptertranh = ChapterTranh::with('truyen')->where('slug_chaptertranh',$slug)->where('truyen_id',$truyen->truyen_id)->first();
        views($chaptertranh)->record();
        $all_chapter = ChapterTranh::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->truyen_id)->get();

        $next_chapter = ChapterTranh::where('truyen_id',$truyen->truyen_id)->where('id','>',$chaptertranh->id)->min('slug_chaptertranh');

        $max_id =  ChapterTranh::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->first();
        $min_id =  ChapterTranh::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->first();

        $min_chapter = ChapterTranh::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->min('slug_chaptertranh');
        $max_chapter = ChapterTranh::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->max('slug_chaptertranh');
        
        $previous_chapter = ChapterTranh::where('truyen_id',$truyen->truyen_id)->where('id','<',$chaptertranh->id)->max('slug_chaptertranh');
      

        return view('pages.truyentranh.xemchapter')->with(compact('danhmuc','chaptertranh','all_chapter','next_chapter','previous_chapter','max_id','min_id','theloai','truyen_breadcrumb','min_chapter','max_chapter','dexuat_truyen','dexuat_theloai','notification'));
    }

    public function timkiem(Request $request){
        $data = $request->all();
        $tukhoa = $data['tukhoa'];
        
        $notification = Chapter::with('truyen')->orderBy('created_at','DESC')->take(6)->get();

        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','ASC')->get();

        $dexuat_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(3)->get();
        $dexuat_theloai = Theloai::orderBy('id','DESC')->take(4)->get();

        $truyen = Truyen::with('danhmuctruyen','theloai')->where('tentruyen','LIKE','%'.$tukhoa.'%')->get();
        return view('pages.timkiem')->with(compact('danhmuc','theloai','truyen','tukhoa','dexuat_truyen','dexuat_theloai','notification'));
    }

    public function timkiem_ajax(Request $request){
        $data = $request->all();

        if($data['keywords']){
            $truyen = Truyen::where('kichhoat',0)->where('tentruyen','LIKE', '%'.$data['keywords'].'%')->get();

            $output = '
                <div class="dropdown-menu" style="display: block";>
            ';

            foreach($truyen as $key => $tr){
                $output .= '
                 <button herf="#" class="li_timkiem_ajax dropdown-item">'.$tr->tentruyen.'</button>         
                ';
            }
            $output .= '</div>';
            echo $output;
        }
    }

    public function tag($tag){
       
        $notification = Chapter::with('truyen')->orderBy('created_at','DESC')->take(6)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $dexuat_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(3)->get();
        $dexuat_theloai = Theloai::orderBy('id','DESC')->take(4)->get();

        $title = 'Tìm kiếm tags';
        $meta_desc = 'Tìm kiếm tags';
        $meta_keywords = 'Tìm kiếm tags';

        $slide_truyen = Truyen::with('thuocnhieutheloaitruyen')->orderBy('id','DESC')->where('kichhoat',0)->take(8)->get();
        
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $tags = explode('-', $tag);
        $truyen = Truyen::with('thuocnhieutheloaitruyen')->where(
            function ($query) use($tags) {
                for ($i = 0; $i < count($tags); $i++){
                    $query->orwhere('tukhoa','LIKE', '%' . $tags[$i] . '%');
                }

            })->paginate(12);
        return view('pages.tag')->with(compact('danhmuc','truyen','theloai','slide_truyen','tag','title','meta_desc','meta_keywords','notification','danhmuc','theloai','dexuat_truyen','dexuat_theloai'
    ));

    }

    public function userProfile($id){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $dexuat_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(3)->get();
        $dexuat_theloai = Theloai::orderBy('id','DESC')->take(4)->get();
        $notification = Chapter::with('truyen')->orderBy('created_at','DESC')->take(6)->get();
        $user = User::find($id);      
        $list_truyen = Truyen::with('thuocnhieuuser')->orderBy('id','DESC')->where('user_id',$user->id)->get();
      
        return view('pages.userProfile')->with(compact('danhmuc','theloai','dexuat_truyen','dexuat_theloai','user','list_truyen','notification'));
    }

    public function userSettings($id){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $dexuat_truyen = Truyen::orderBy('id','DESC')->where('kichhoat',0)->take(3)->get();
        $dexuat_theloai = Theloai::orderBy('id','DESC')->take(4)->get();
        $notification = Chapter::with('truyen')->orderBy('created_at','DESC')->take(6)->get();
        $user = User::find(auth()->user()->id);          
      
        return view('pages.userSettings')->with(compact('danhmuc','theloai','dexuat_truyen','dexuat_theloai','user','notification'));
    }


    function load_data($slug, Request $request)
    {
        $truyen = Truyen::with('danhmuctruyen','thuocnhieutheloaitruyen')->where('slug_truyen',$slug)->where('kichhoat',0)->first();
     if($request->ajax())
     {
      if($request->id > 0)
      {
       $data = Chapter::
          where('id', '<', $request->id)
          ->where('truyen_id',$truyen->truyen_id)
          ->orderBy('id', 'DESC')
          ->limit(2)
          ->get();
      }
      else
      {
       $data = Chapter::
          orderBy('id', 'DESC')
          ->where('truyen_id',$truyen->truyen_id)
          ->limit(2)
          ->get();
      }
      $output = '';
      $last_id = '';
      
      if(!$data->isEmpty())
      {
       foreach($data as $row)
       {
        $output .= '
        <div class="row">
         <div class="col-md-12">
          <h3 class="text-info"><b>'.$row->tieude.'</b></h3>
         
         </div>         
        </div>
        ';
        $last_id = $row->id;
       }
       $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="'.$last_id.'" id="load_more_button">Load More</button>
       </div>
       ';
      }
      else
      {
       $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
       </div>
       ';
      }
      echo $output;
     }
    }
}
