@extends('layout')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Set New Password</h1>
            </div>
            <div class="card-body">


                @if(Session::has('message'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif


                <form action="{{route('resetpassword') }}" method="POST">
                    @csrf
                    <input type="text" name="token" value="{{$token}}" hidden><br>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" >
                        {{-- displaying error --}}
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" id="password" >
                        {{-- displaying error --}}
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" id="cpassword">
                        {{-- displaying error 
                        @error('cpassword')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    
                    
                    <div class="mb-3">
                        <div class="d-grid">
                            <button class="btn btn-primary">Reset Password</button>
                        </div>
                        
                    </div> 
                    {{-- <div class="mb-3">
                       
                    </div> --}}
                    
                   
                </form>
            </div>
        </div>
    </div>
</div>
@endsection