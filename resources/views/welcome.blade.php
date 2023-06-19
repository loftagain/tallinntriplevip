<!DOCTYPE html>
<html>
<head>
    <title>Tallinn Triple VIP</title>
    <style>
        body {
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-y:hidden;
        }

        .content {
            text-align: center;
            color: #fff;
        }

        .login-button {
            display: inline-block;
            background-color: #4267B2;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .container  {
  height: 100%; /* Full-height: remove this if you want "auto" height */
  width: 450px; /* Set the width of the sidebar */
  position: fixed; /* Fixed Sidebar (stay in place on scroll) */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  right: 0;
  background-color: rgb(255, 214, 51);
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 20px;}
  .virsraksts, h1{
        position: center;
        text-align: center;
        font:bold;
        color:rgb(255, 255, 255);
        font-size: 2rem;
       text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        border-radius:4px;
        margin-bottom: 5px;
    }
    h1{
        color:black;
        text-shadow:none;
        font-size: 1.5em;
        margin: 30px 15px 15px;
    }
    .card {
        position: relative;
top: 1em;
align-self: center;
        margin: 15px 15px 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.7);
        border-radius: 6px;
        
        background-color: rgba(255, 214, 51);

    }
    .card-body {
        padding: 15px 15px 15px;
        align-content: center;
    }
    .card2{
position: relative;
top: 1em;

    }
    .card2 a.active{
        background-color: black;
        color: white;
        margin: 5px 5px 5px;
        margin-bottom: 20px;
        width:150px;
        display: inline-block;
        
        padding: 5px 5px 5px;
        font-family: Arial, Helvetica, sans-serif;
        text-transform: uppercase;
        text-align: center;
        text-decoration: none;
    }
    .card2 a:hover {
          color: rgba(255, 214, 51);
          
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="virsraksts">Welcome to the most popular pancake destination!</div>
<h1>Become a member, dictate our monthly specials and earn free premium meals!</h1>
                <div class="card">
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                    
                                    <br><a href="{{ route('register') }}" class="btn btn-primary">Register Now</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
              <div class="card2">
        <h1>
            <a class="active" href="{{ route('wall') }}">Wall</a><br>
            <a class="active" href="{{ route('about') }}">About Us</a>
        </h1>
        
    </div>
        </div>
    </div>
@endsection

 
</body>
</html>
