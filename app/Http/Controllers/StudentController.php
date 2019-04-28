<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class StudentController extends Controller
{
    public function __construct(){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard.indexUser')->with(["user"=>Auth::user(),"data"=>Auth::user()->student]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('dashboard.editUser')->with(["user"=>Auth::user(),"data"=>Auth::user()->student]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $user=Auth::user();
        
        if($request->hasFile('avatar')){
            if(Storage::exists('public/'.$user->avatar)){
                Storage::delete('public/'.$user->avatar);
            }
            $path = $request->avatar->store('user/avatar', 'public');
            $user->avatar=$path;
        }
        $student=$user->student;
        $user->name=$request->name;

        $user->student->tanggal_lahir=$request->tanggal_lahir;
        $user->student->jenis_kelamin=$request->jenis_kelamin;
        $user->student->alamat=$request->alamat;
        $user->student->kabupaten_kota=$request->kabupaten_kota;
        $user->student->kode_pos=$request->kode_pos;
        $user->student->nomor_handphone=$request->nomor_handphone;
        $user->student->nomor_whatsapp=$request->nomor_whatsapp;
        $user->student->tingkatan=$request->tingkatan;
        $user->student->kelas=$request->kelas;

        if($user->save() && $user->student->save()){
            return redirect()->route('student.index')->with('message', 'success');
        }else{
            echo "no";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
