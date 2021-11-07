@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                <div class="card-header text-center font-weight-bolder">{{ __('Welcome to Login!') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                         <!-- ---Login with Google, Facebook--- -->

                        <div class="mt-3">
                                

                                <div class="btn shadow-sm" style="width: 80%; margin-left: 10%; height: 40px; border: 1px solid #EEEEEE ">
                                    <img src="https://images.theconversation.com/files/93616/original/image-20150902-6700-t2axrz.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=1000&fit=clip" class="float-left m-1" width="20px" height="20px">  
                                    <p class="text-center mb-0"> Login in with Google<p>
                                </div>   

                            <div style="clear: left"></div>

                                <div class="btn shadow-sm  mt-3" style="width: 80%; margin-left: 10%; height: 40px; border: 1px solid #EEEEEE; ">
                                <img src="https://i.pinimg.com/originals/b3/26/b5/b326b5f8d23cd1e0f18df4c9265416f7.png" class="float-left mb-2" width="28px" height="28px">  
                                    <p class="text-center mb-0"> Login in with Facebook<p>
                                </div>   

                            <div style="clear: left"></div>


                        </div>

                        <div class="mb-4 mt-4">
                            <div class="line float-left mt-2" style="border: 1px solid #EEEEEE; width: 30%"></div>
                                <p class="float-left ml-2 text-center font-weight-bold" style="font-size: 12px; width: 36%; color:  #A9A9A9">OR LOGIN WITH EMAIL</p>
                            <div class="line float-right mt-2" style="border: 1px solid #EEEEEE; width: 30%"></div>

                            <div style="clear: both"></div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-3 mb-3">
                                <div class="custom-control custom-checkbox col-md-4 text-md-right ml-5">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember" >   {{ __('Remember Me') }}</label>
                                </div>

                               
                                    @if (Route::has('password.request'))   
                                    <div class="custom-control col-md-6 text-md-right">          
                                        <a href="{{ route('password.request') }}" class="btn btn-link" style="color:  #ff631c; font-size: 14px;">
                                        {{ __('Forgot Your Password?') }}
                                        </a> 
                                    </div>    
                                    @endif
                                
                             
                        </div>   

                            

                            

                        
                    

                        <!-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->
                     
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn" style="background: #ff631c; color: white; width: 80%; margin-left: 10%; ">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
   
                        

                        <div class="text-center mt-2"> 
                            @if (Route::has('register'))   
                                    <div class="custom-control m-0">    
                                        Not a member?      
                                        <a href="{{ route('register') }}" class="m-0" style="color:  #ff631c; font-size: 14px;">
                                        {{ __('Sign up') }}
                                        </a> 
                                        now!
                                    </div>    
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
