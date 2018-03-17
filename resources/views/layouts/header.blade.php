<?php
/**
 * Created by PhpStorm.
 * User: HP 840 G3
 * Date: 3/17/2018
 * Time: 03:09 PM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Worldskills Travel</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}/assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}/assets/style.css">
    <script type="text/javascript" src="{{asset('/')}}/assets/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}/assets/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="wrapper">
    <header>
        <nav class="navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{url('home')}}" class="navbar-brand">Worldskills Travel</a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{url('flight')}}">Flights</a></li>
                        @if(Session::has('token'))
                            <li><a href="{{url('logout')}}">Log Out</a></li>
                            <li>{{Session::get('username')}}</li>
                        @else
                            <li><a href="{{url('login')}}">Log In</a></li>
                        @endif
                        <li><a href="{{url('register')}}">Register</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
