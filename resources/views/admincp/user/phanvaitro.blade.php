@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid mt-2" style="margin-left: 120px">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">Cấp vai trò cho user : {{$user->name}}</div>
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

                <form action="{{url('/insert_roles',[$user->id])}}" method="POST">
                  @csrf
                
                @foreach($role as $key => $r)
                @if(isset($all_column_roles))
                <div class="form-check form-check-inline m-2">
                   
                  <input class="form-check-input" {{$r->id==$all_column_roles->id ? 'checked' : ''}} type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}">
                  <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                </div>
                
                @else
                <div class="form-check form-check-inline m-2">
                   
                   <input class="form-check-input" type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}">
                   <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                 </div>
                @endif
                @endforeach
                <br>
                <hr>
<!--                 
                @foreach($permission as $key => $per)
                <div class="form-check">
                    <input class="form-check-input"  type="checkbox" value="{{$per->name}}" id="{{$per->id}}">
                    <label class="form-check-label" for="{{$per->id}}">
                        {{$per->name}}
                    </label>
                </div>
                @endforeach                     -->

                <input type="submit" name="insertroles" value="Cấp vai trò cho user" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
