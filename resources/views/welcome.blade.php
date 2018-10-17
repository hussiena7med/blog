@extends('layouts.master')

@section('title')
    blog1
@endsection

@section('content')

@include('includes.message-block')

    <div class="row">
        <div class="col-md-6">
            <h3> Sign Up </h3>
            <form action="{{route('signup')}}" method="post">

                <div class="form-group {{$errors->has('email') ? 'has-error':''}}">


                    <label for="email">your E-mail</label>
                    <input class="form-control" type="text" id="email" name="email" value="{{\Illuminate\Support\Facades\Request::old('email')}}">
                </div>
                <div class="form-group {{$errors->has('first_name') ? 'has-error':''}}">


                    <label for="first_name">your first name</label>
                    <input class="form-control" type="text" id="first_name" name="first_name"  value="{{\Illuminate\Support\Facades\Request::old('first_name')}}">
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-error':''}}">


                    <label for="password">your password</label>
                    <input class="form-control" type="password" id="password" name="password"  value="{{\Illuminate\Support\Facades\Request::old('password')}}">
                </div>
                <button type="submit" class="btn btn-primary">submit</button>
                <input type="hidden" name="_token" value="{{\Illuminate\Support\Facades\Session::token()}}">
            </form>

        </div>

        <div class="col-md-6">
            <h3> Sign In </h3>
            <form action="{{route('signin')}}" method="post">

                <div class="form-group {{$errors->has('email') ? 'has-error':''}}">


                    <label for="email">your E-mail</label>
                    <input class="form-control" type="text" id="email" name="email"  value="{{\Illuminate\Support\Facades\Request::old('email')}}">
                </div>

                <div class="form-group {{$errors->has('password') ? 'has-error':''}}">


                    <label for="password">your password</label>
                    <input class="form-control" type="password" id="password" name="password"  value="{{\Illuminate\Support\Facades\Request::old('password')}}">
                </div>
                <button type="submit" class="btn btn-primary">submit</button>
                <input type="hidden" name="_token" value="{{\Illuminate\Support\Facades\Session::token()}}">
            </form>

        </div>


    </div>
@endsection