@extends('layout')

@section('content')
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="font-weight: bold">{($error)}</li>
        @endforeach
    </ul>
@endif

    <form action="/ubah/{{$data->id}}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PATCH')
        <input type="number" name="nis" placeholder="Masukkan NIS" value="{{$data->nis}}">
        <input type="text" name="nama" placeholder="Masukkan Nama" value="{{$data->nama}}">
        <select name="JK">
            <option value="perempuan"{{$data->JK=="perempuan" ? 'selected' : ''}}>Perempuan</option>
            <option value="laki-laki"{{$data->JK=="laki-laki" ? 'selected' : ''}}>Laki-Laki</option>
        </select>
        <input type="number" name="umur" placeholder="Masukkan Umur" value="{{$data->umur}}">
        <img src="{{asset('assets/image/' . $data->foto)}}" width="50">
        <input type="file" name="foto">
        <button type="submit">Kirim</button>
        <a href="{{ route('home') }}">Kembali</a>
    </form>

@endsection 