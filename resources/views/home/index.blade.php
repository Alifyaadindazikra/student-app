@extends('layout')

@section('content')
@if(Session::get('sucessAdd'))
  <h2>{(Session::get('sucessAdd'))}</h2>
@endif


<a href="/login">Login</a>

    <table border="1">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>JK</th>
            <th>Umur</th>
            <th>Foto</th>
            <th>Aksi</th>
            
        </tr>
        @foreach($students as $st)
        <tr>
            <td>-</td>
            <td>{{$st['nis']}}</td>
            <td>{{$st['nama']}}</td>
            <td>{{$st['JK']}}</td>
            <td>{{$st['umur']}}</td>
            <td><img src="{{asset('assets/image/' . $st->foto)}}" width="80"></td>
            <td style="display: flex; align-items: center;">
            <td>
                <button><a href="/edit/{{$st->id}}">Edit</a></button> 
                
                <form action="/hapus/{{$st->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <a href="/tambah-data">Tambah Data Baru</a>           
@endsection 