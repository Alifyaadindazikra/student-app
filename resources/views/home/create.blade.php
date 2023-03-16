@extends('layout')

@section('content')
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="font-weight: bold">{($error)}</li>
        @endforeach
    </ul>
@endif

        
    

    <form action="{{route('kirim_data')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="number" name="nis" placeholder="Masukkan NIS">
        <input type="text" name="nama" placeholder="Masukkan Nama">
        <select name="JK">
            <option value="perempuan">Perempuan</option>
            <option value="laki-laki">Laki-Laki</option>
        </select>
        <input type="number" name="umur" placeholder="Masukkan Umur">
        <input type="file" name="foto">
        <button type="submit">Kirim</button>
        <a href="{{ route('home') }}">Kembali</a>
    </form>

@endsection 