@extends('layout')

@section('content')
   @if(Session::get('error'))
       {{Session::get('error')}}
     @endif
  <form action="{{route('auth')}}" method="post">
    @csrf
    <label for="email">Email :</label>
    <input type="email" name="email" id="email" placeholder="Masukkan Email">
    <label for="password">Password :</label>
    <input type="password" name="password" id="password" placeholder="Masukkan Pasword">
    <button type="submit">Masuk</button>
  </form>

@endsection