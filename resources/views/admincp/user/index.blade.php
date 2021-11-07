@extends('layouts.app')

@section('content')
@include('layouts.nav')
<style>
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
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>  
<script>   
   $(document).ready(function(){
      $(".all").click(function(){
        $("#tbl_all").fadeIn(0.5);
        $("#header_all").fadeIn(0.5);
        $("#header_admin").fadeOut(0.5);
        $("#header_uploader").fadeOut(0.5);
        $("#tbl_admin").fadeOut(0.5);
        $("#tbl_uploader").fadeOut(0.5);
        $("#pagination_admin").fadeOut(0.5);
        $("#pagination_uploader").fadeOut(0.5);
        $("#pagination_user").fadeIn(0.5);
      });
    });

    $(document).ready(function(){
      $(".admin").click(function(){
        $("#tbl_admin").fadeIn(0.5);
        $("#header_admin").fadeIn(0.5);
        $("#header_all").fadeOut(0.5);
        $("#header_uploader").fadeOut(0.5);
        $("#tbl_all").fadeOut(0.5);
        $("#tbl_uploader").fadeOut(0.5);
        $("#pagination_user").fadeOut(0.5);
        $("#pagination_uploader").fadeOut(0.5);
        $("#pagination_admin").fadeIn(0.5);
      });
    });  

    $(document).ready(function(){
      $(".uploader").click(function(){
        $("#tbl_uploader").fadeIn(0.5);
        $("#header_uploader").fadeIn(0.5);
        $("#header_admin").fadeOut(0.5);
        $("#header_all").fadeOut(0.5);
        $("#tbl_all").fadeOut(0.5);
        $("#tbl_admin").fadeOut(0.5);   
        $("#pagination_user").fadeOut(0.5);
        $("#pagination_uploader").fadeIn(0.5);
        $("#pagination_admin").fadeOut(0.5);  
      });
    }); 
</script>
<div class="container-fluid mt-2" style="margin-left: 120px">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Danh sách User</div>

                <li class="mr-3" style="list-style-type: none">
                    <h5 class="ml-4 mt-2 mb-2">Tìm kiếm user</h5>
		        	<form autocomplete="off" class="box p-2 ml-4" style="background: white; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;" action="{{url('tim-kiem-user-admin')}}" method="POST">   
                @csrf
                        <div class="dropdown">
                            <input type="search" name="tukhoa" id="keywords" placeholder="Tìm user..." class="border-0" style="width: 70%;" />			         
                        <button class="btn float-right m-0 p-0" type="submit"><span class="icon pl-2 mr-2" style="width: 15px; border-left: 1px solid #D3D3D3"><i class="fa fa-search"></i></span></button>
                        <div id="search_ajax"></div>
                        <div style="clear: both;"></div>
                        </div>
                    </form>
		        </li> 

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert  alert-dismissable alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('status') }}
                        </div>
                    @endif
                 
                <div class="m-0 p-0">
                     <button type="button" class="all btn btn-success float-left mr-2">Tất cả</button>
                     <button type="button" class="admin btn btn-danger float-left mr-2">Liệt kê Admin</button>
                     <button type="button" class="uploader btn btn-warning float-left mr-2">Liệt kê Uploader</button>
                </div>
                     </div>
                   <div style="clear: both;"></div>  

                    <table id="tbl_all" class="table table-striped table-responsive">
                        <h4 id="header_all" class="p-0 text-center font-weight-bold">Tất cả user</h4>
                        <thead>
                           
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">Ảnh đại diện</th>
                                <th scope="col">Tên user</th>
                                <th scope="col">Email</th>
                           <!-- <th scope="col" hidden>Password</th> -->
                                <th scope="col">Vai trò (Role)</th>
                                <th scope="col">Quyền (Permission)</th>
                                <th scope="col" style="width: 30%">Quản lý</th>
                                
                            </tr>
                           
                        </thead>
                       
                        <tbody>
                        @foreach($user as $key => $u)
                            <tr>
                            
                                <th scope="row">{{$key}}</th>
                                <td>
                                    @if($u->image)
                                        <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" width="35px" height="35px" src="{{asset('public/uploads/avatar/'.$u->image)}}"
                                                alt="Avatar">
                                    @else
                                        <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" width="35px" height="35px" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-10.jpg"
                                                alt="Avatar">
                                    @endif 
                                </td>
                                <td><a href="{{url('user-profile/'.$u->id)}}">{{$u -> name}}</a></td>
                                <td>{{$u -> email}}</td>
                                <!-- <th scope="row" hidden>{{$u -> password}}</th> -->
                                <td>
                                    @foreach($u->roles as $key => $role)
                                        <span class="badge badge-danger">{{$role->name}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($role->permissions as $key => $permission)
                                        <span class="badge badge-success">{{$permission->name}}</span>
                                    @endforeach
                                </td>
                              
                                <td>
                                    <a href="{{url('phan-vai-tro/'.$u->id)}}" class="btn btn-primary float-left mr-2">Phân vai trò</a>
                                    <a href="{{url('phan-quyen/'.$u->id)}}" class="btn btn-warning float-left mr-2">Phân quyền</a>
                                    <a href="{{url('/chuyen-quyen/user/'.$u->id)}}" class="btn btn-success float-left mr-2">Chuyển user nhanh</a>
                                    <form action="{{route('user.destroy',[ $u -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa user này không?')" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                    </form>
                                </td>
                           
                            </tr>
                        @endforeach  
                               
                        </tbody>
                       
                    </table>
                    <div style="margin: 0 auto">  
                                    {{$user->onEachSide(1)->links('pagination::bootstrap-4')}} 
                    </div>

                    <!-- Table Admin -->

                    <table id="tbl_admin" class="table table-striped table-responsive" style="display: none">
                        <h4  id="header_admin" class="p-0 text-center font-weight-bold" style="display: none">Admin</h4>
                        <thead>
                           
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">Ảnh đại diện</th>
                                <th scope="col">Tên user</th>
                                <th scope="col">Email</th>
                           <!-- <th scope="col" hidden>Password</th> -->
                                <th scope="col">Vai trò (Role)</th>
                                <th scope="col">Quyền (Permission)</th>
                                <th scope="col" style="width: 30%">Quản lý</th>
                                
                            </tr>
                           
                        </thead>
                       
                        <tbody>
                        @foreach($admin as $key => $u)
                            <tr>
                            
                                <th scope="row">{{$key}}</th>
                                <td>
                                    @if($u->image)
                                        <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" width="35px" height="35px" src="{{asset('public/uploads/avatar/'.$u->image)}}"
                                                alt="Avatar">
                                    @else
                                        <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" width="35px" height="35px" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-10.jpg"
                                                alt="Avatar">
                                    @endif 
                                </td>
                                <td><a href="{{url('user-profile/'.$u->id)}}">{{$u -> name}}</a></td>
                                <td>{{$u -> email}}</td>
                                <!-- <th scope="row" hidden>{{$u -> password}}</th> -->
                                <td>
                                    @foreach($u->roles as $key => $role)
                                        <span class="badge badge-danger">{{$role->name}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($role->permissions as $key => $permission)
                                        <span class="badge badge-success">{{$permission->name}}</span>
                                    @endforeach
                                </td>
                              
                                <td>
                                    <a href="{{url('phan-vai-tro/'.$u->id)}}" class="btn btn-primary float-left mr-2">Phân vai trò</a>
                                    <a href="{{url('phan-quyen/'.$u->id)}}" class="btn btn-warning float-left mr-2">Phân quyền</a>
                                    <a href="{{url('/chuyen-quyen/user/'.$u->id)}}" class="btn btn-success float-left mr-2">Chuyển user nhanh</a>
                                    <form action="{{route('user.destroy',[ $u -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa user này không?')" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                    </form>
                                </td>
                           
                            </tr>
                        @endforeach   
                        </tbody>
                    </table>
                    <div id="pagination_admin" style="margin: 0 auto">  
                                    {{$admin->onEachSide(1)->links('pagination::bootstrap-4')}} 
                    </div>

                    <!-- Table Uploader -->

                    <table id="tbl_uploader" class="table table-striped table-responsive" style="display: none">
                        <h4  id="header_uploader" class="p-0 text-center font-weight-bold" style="display: none">Uploader</h4>
                        <thead>
                           
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">Ảnh đại diện</th>
                                <th scope="col">Tên user</th>
                                <th scope="col">Email</th>
                           <!-- <th scope="col" hidden>Password</th> -->
                                <th scope="col">Vai trò (Role)</th>
                                <th scope="col">Quyền (Permission)</th>
                                <th scope="col" style="width: 30%">Quản lý</th>
                                
                            </tr>
                           
                        </thead>
                       
                        <tbody>
                        @foreach($uploader as $key => $u)
                            <tr>
                            
                                <th scope="row">{{$key}}</th>
                                <td>
                                    @if($u->image)
                                        <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" width="35px" height="35px" src="{{asset('public/uploads/avatar/'.$u->image)}}"
                                                alt="Avatar">
                                    @else
                                        <img class="d-flex rounded-circle avatar z-depth-1-half mr-3" width="35px" height="35px" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-10.jpg"
                                                alt="Avatar">
                                    @endif 
                                </td>
                                <td><a href="{{url('user-profile/'.$u->id)}}">{{$u -> name}}</a></td>
                                <td>{{$u -> email}}</td>
                                <!-- <th scope="row" hidden>{{$u -> password}}</th> -->
                                <td>
                                    @if($u->roles)
                                        @foreach($u->roles as $key => $role)
                                            <span class="badge badge-danger">{{$role->name}}</span>
                                        @endforeach 
                                    @endif        
                                </td>
                                <td>
                                    @if($role->permissions)
                                        @foreach($role->permissions as $key => $permission)
                                            <span class="badge badge-success">{{$permission->name}}</span>
                                        @endforeach 
                                    @endif    
                                </td>
                              
                                <td>
                                    <a href="{{url('phan-vai-tro/'.$u->id)}}" class="btn btn-primary float-left mr-2">Phân vai trò</a>
                                    <a href="{{url('phan-quyen/'.$u->id)}}" class="btn btn-warning float-left mr-2">Phân quyền</a>
                                    <a href="{{url('/chuyen-quyen/user/'.$u->id)}}" class="btn btn-success float-left mr-2">Chuyển user nhanh</a>
                                    <form action="{{route('user.destroy',[ $u -> id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có chắc muốn xóa user này không?')" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                    </form>
                                </td>
                           
                            </tr>
                        @endforeach   
                        {{$uploader->onEachSide(1)->links('pagination::bootstrap-4')}}
                        </tbody>
                    </table>
                    <div id="pagination_uploader" style="margin: 0 auto">  
                                    {{$uploader->onEachSide(1)->links('pagination::bootstrap-4')}} 
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
 $('#keywords').keyup(function(){
          var keywords = $(this).val();

            if(keywords != '')
              {
               var _token = $('input[name="_token"]').val();

               $.ajax({
                url:"{{url('/timkiemuser-ajax-admin')}}",
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
@endsection
