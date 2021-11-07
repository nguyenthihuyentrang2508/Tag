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
<div class="container-fluid mt-2" style="margin-left: 120px">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                   <div class="float-left"> Liệt kê user </div>
                   <div class="float-right"><a href="{{route('user.index')}}" ><i class="fas fa-arrow-left"></i></a></div>
                   <div style="clear: both;"></div>
                </div>
               
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
            
                    @role('admin') 
                    <table class="table table-responsive">
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
                         
                        @foreach($list_user as $key => $u)
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
                        @endrole

                          

                        </tbody>
                    </table>
                    
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
