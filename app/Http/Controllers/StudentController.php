<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $user =$request->only('email','password');

        if (Auth::attempt($user)) {
            return redirect()->route('dashboard');
        }else {
            return redirect()->back()->with('error', 'Gagal Login');
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function logout()
   {
        Auth::logout();
        return redirect('/');
     
   }

    public function index()
    {
        $students = Student::all();//memanggil tampilan yang ekstensinfile nya .blade
        return view ("home.index", compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nis' => 'required|min:8',
            'nama' => 'required|min:3',
            'JK' => 'required',
            'umur' => 'required|numeric',
            'foto' => 'required|image|mimes:jpeg,jpg,png,svg',
            
        ]);

        $image = $request->file('foto');
        $imgName = rand() . '.' . $image->extension();
        $path =public_path('assets/image/');
        $image->move($path,$imgName);


        Student::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'JK' => $request->JK,
            'umur' => $request->umur,
            'foto' => $imgName,
            
             

        ]);

        return redirect('/')->with('sucessAdd','Berhasil Menambahkan Data Baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //{{$ST->id}} dikrim data ke path dinamis {id}, trus dkkrim k reresources edit dan diambil di paramter ($id)
        //dopakai untuk filter data mana yang akan diambil atau di ubah nntnya
        //first or fail mengambil hanya stu data yang palng seesuai
        //datnya dikiirmke blade melalui compact
        $data = Student::where('id', '=', $id)->firstOrFail();
        return view('home.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request -> validate([
            'nis' => 'required|min:8',
            'nama' => 'required|min:3',
            'JK' => 'required',
            'umur' => 'required|numeric',
            
        ]);
        if (is_null($request->file('foto'))){
            $imgName = Student::where('id', '.' , $id)->value('foto');
        }else {
            $image = $request->file('foto');
            $imgName = rand() . '.' . $image->extension();
            $path =public_path('assets/image/');
            $image->move($path,$imgName);
        }
//cari dulu datanya pake where lalu ubah
        Student::where ('id', '=', $id)->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'JK' => $request->JK,
            'umur' => $request->umur,
            'foto' => $imgName,
        ]);
        return redirect()->route('home')->with('successUpdate', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::where('id', '=', $id)->delete();
        return redirect()->back()->with
        ('successDelete', 'Berhasil menghapus data!');
    }
}
