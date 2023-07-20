@extends('layout')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Login</h1>
            </div>
            <div class="card-body">
                @if(Session::has('message'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" >
                        {{-- displaying error --}}
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" >
                        {{-- displaying error --}}
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-grid">
                            <button class="btn btn-primary">Login</button>
                        </div>
                        
                    </div>
                    {{-- <div class="mb-3">
                       
                    </div> --}}
                    
                    <div class="mb-3">
                        <div class="d-grid">
                            <a href="{{route('forgetpasswordview')}}" style="text-align: center" >Forgot Password?</a><br>
                            <P style="text-align: center">Don't have an account? <a href="{{route('register')}}">SIGN UP</a></P>
                            <a class="btn btn-lg btn-google" href="{{route('google-auth')}}"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> Continue with Google</a>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection