@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid mt-2" style="margin-left: 120px">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left"> Phân quyền cho user : {{$user->name}} </div>
                    <div class="float-right"><a href="{{route('user.index')}}" ><i class="fas fa-arrow-left"></i></a></div>
                    <div style="clear: both;"></div>
                </div>

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

                <div class="card-body">
                    @if (session('status'))
                   
                        <div class="alert  alert-dismissable alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            {{ session('status') }}
                        </div>
                    @endif

                <form action="{{url('/insert_permission',[$user->id])}}" method="POST">
                  @csrf
                  @if(isset($name_roles))
                    <p style="font-weight: bolder;">  Vai trò hiện tại : {{$name_roles}} </p>
                  @endif  
                        @foreach($permission as $key => $per)
                            <div class="form-check">
                                <input class="form-check-input"  

                                @foreach($get_per_via_role as $key => $get)
                                    @if( $get->id == $per->id ) 
                                    checked
                                    @endif
                                @endforeach

                                type="checkbox" name="permission[]"  value="{{$per->id}}" id="{{$per->id}}">
                                <label class="form-check-label ml-4" for="{{$per->id}}">
                                    {{$per->name}}
                                </label>
                            </div>
                        @endforeach      
               
                <br>
                <hr>
                
                             

                <input type="submit" name="insertroles" value="Cấp quyền cho user" class="btn btn-success">
                </form>
            </div>
        </div>
       
            <div class="card">

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

                <div class="card-body">
                    @if (session('status'))
                   
                        <div class="alert  alert-dismissable alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            {{ session('status') }}
                        </div>
                    @endif

              
                 
                <form method="POST" action="{{url('insert-permission')}}">
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên quyền</label>
                        <input type="text" class="form-control"  value="{{old('permission')}}" name="permission" placeholder="Tên quyền...">
                    </div>

                    <input type="submit" name="insertper" value="Thêm quyền" class="btn btn-danger">
                    </form>              
                
            </div>


    </div>
</div>


      
@endsection
