@extends('layout')

@section('content')
    <h1>Selamat Datang! {{Auth::user()->name}}</h1>
    <a href="{{route('logout')}}">Logout</a>
 
@endsection