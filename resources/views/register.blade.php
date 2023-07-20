@extends('layout')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Create an Account</h1>
            </div>
            <div class="card-body">
                {{-- @if($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                 @endif --}}
                {{-- @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif --}}
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" >
                        {{-- displaying error --}}
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="name@example.com">
                        {{-- displaying error --}}
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="0123456789" >
                        {{-- displaying error --}}
                        @error('phone')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                        {{-- displaying error --}}
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="d-grid">
                            <button class="btn btn-primary">Register</button>
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <div class="d-grid">
                            <P style="text-align: center">Already have an account? <a href="{{route('login')}}">SIGN IN</a></P>
                            <a class="btn btn-lg btn-google" href="{{route('google-auth')}}"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> Continue with Google</a>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection