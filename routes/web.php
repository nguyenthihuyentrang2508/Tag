<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChapterTranhController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TheloaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportCommentController;
use App\Http\Controllers\ReportErrorController;
use App\Http\Controllers\ReportErrorTranhController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layout');
// });

Route::get('/', [IndexController::class, 'home']);


Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc']);
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai']);
Route::get('/xem-truyen/{slug}', [IndexController::class, 'xemtruyen']);
Route::get('/xem-chapter-tranh/{slug_truyen}/{slug}', [IndexController::class,'xemchaptertranh']);
Route::get('/xem-chapter/{slug_truyen}/{slug}', [IndexController::class, 'xemchapter']);

Route::get('/user-profile/{id}', [IndexController::class, 'userProfile']);

Route::get('/user-settings/{id}', [IndexController::class, 'userSettings']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);

Route::post('/tim-kiem', [IndexController::class, 'timkiem']);
Route::post('/timkiem-ajax', [IndexController::class, 'timkiem_ajax']);


Route::post('/tim-kiem-admin', [TruyenController::class, 'timkiem']);
Route::post('/timkiem-ajax-admin', [TruyenController::class, 'timkiem_ajax']);

Route::post('/tim-kiem-user-admin', [UserController::class, 'timkiem']);
Route::post('/timkiemuser-ajax-admin', [UserController::class, 'timkiem_ajax']);


// Route::get('/loadmore', [IndexController::class]);
// Route::post('/loadmore/load_data/{slug}', [IndexController::class, 'load_data'])->name('loadmore.load_data');
// Route::post('/load-comment', [TruyenController::class, 'load_comment']);

Auth::routes();

Auth::routes();

Route::group(['middleware' => ['role:admin']], function() {
    Route::get('/phan-vai-tro/{id}', [UserController::class, 'phanvaitro']);
    Route::post('/insert_roles/{id}', [UserController::class, 'insert_roles']);
    
    Route::post('/add-permission', [UserController::class, 'add_permission']);
    Route::get('/chuyen-quyen/user/{id}', [UserController::class,'impersonate']);
    
    Route::get('/phan-quyen/{id}', [UserController::class, 'phanquyen']);
    Route::post('/insert_permission/{id}', [UserController::class, 'insert_permission']);
});    
Route::group(['middleware' => ['check:admin|uploader']], function() {

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/liet-ke-truyen/{id}', [TruyenController::class, 'showByUserId']);

Route::resource('/danhmuc', DanhmucController::class);
Route::resource('/truyen', TruyenController::class);

Route::resource('/chapter', ChapterController::class);
Route::get('/chapter/create/{id}', [ChapterController::class, 'create']);
Route::post('/chapter/store/{id}', [ChapterController::class, 'store']);

Route::resource('/chaptertranh', ChapterTranhController::class);
Route::get('/chaptertranh/create/{id}', [ChapterTranhController::class, 'create']);
Route::post('/chaptertranh/store/{id}', [ChapterTranhController::class, 'store']);

Route::resource('/theloai', TheloaiController::class);
Route::resource('/user', UserController::class);
});
// Route::group(['middleware' => ['auth']], function() {
//     Route::get('/', [IndexController::class, 'home']);
// });

//Comment
Route::post('/store', [CommentController::class, 'store'])->name("comment.store");
Route::get('/comment', [ReportCommentController::class, 'index'])->name("reportcomment.index");
Route::get('/allcomment', [CommentController::class, 'index'])->name("comment.index");
Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name("comment.destroy");
Route::delete('/delete-reported/{id}', [ReportCommentController::class, 'destroy'])->name("reportcomment.destroy");
Route::post('/report', [ReportCommentController::class, 'store'])->name("reportcomment.store");

//report error Truyện
Route::post('/report-error', [ReportErrorController::class, 'store'])->name("reporterror.store");
Route::get('/manage-report-error', [ReportErrorController::class, 'index'])->name("reporterror.index");
Route::delete('/delete-report-error/{id}', [ReportErrorController::class, 'destroy'])->name("reporterror.destroy");
//Report error Truyện tranh
Route::post('/report-error-tranh', [ReportErrorTranhController::class, 'store'])->name("reporterrortranh.store");
Route::get('/manage-report-error-tranh', [ReportErrorTranhController::class, 'index'])->name("reporterrortranh.index");
Route::delete('/delete-report-error-tranh/{id}', [ReportErrorTranhController::class, 'destroy'])->name("reporterrortranh.destroy");
//Truyện
Route::post('/truyennoibat', [TruyenController::class, 'truyennoibat']);

//Rating
Route::post('/insert-rating', [TruyenController::class, 'insert_rating']);

//upload-image-user
Route::post('/upload-image-user/{id}', [UserController::class, 'update'])->name("user.update");

//cài đặt user
Route::post('/setting-user/{id}', [UserController::class, 'settings'])->name("user.settings");
Route::post('/change-password/{id}', [UserController::class, 'change_password'])->name("user.change_password");