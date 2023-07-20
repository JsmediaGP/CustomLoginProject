@extends('layout')
@section('content')
<div>
    <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Logout</button>
    </form>
</div>
<div class="container">
    <h1> Welcome back, <p>{{ Auth::user()->email }}</p></h1>
 </div>


 @endsection 