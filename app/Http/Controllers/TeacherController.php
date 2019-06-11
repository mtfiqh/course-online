<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.indexUser')->with(["user"=>Auth::user(),"data"=>Auth::user()->teacher]);

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
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
        return view('dashboard.editUser')->with(["user"=>Auth::user(),"data"=>Auth::user()->teacher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
        $user=Auth::user();
        $teacher=$user->teacher;
        $user->name=$request->name;

        $user->teacher->tanggal_lahir=$request->tanggal_lahir;
        $user->teacher->jenis_kelamin=$request->jenis_kelamin;
        $user->teacher->alamat=$request->alamat;
        $user->teacher->kabupaten_kota=$request->kabupaten_kota;
        $user->teacher->kode_pos=$request->kode_pos;
        $user->teacher->nomor_handphone=$request->nomor_handphone;
        $user->teacher->nomor_whatsapp=$request->nomor_whatsapp;

        $user->teacher->pendidikan_terakhir=$request->pendidikan_terakhir;
        $user->teacher->pekerjaan = $request->pekerjaan;
        $request->masih_bekerja ? $user->teacher->masih_bekerja = TRUE : $user->teacher->masih_bekerja= FALSE;

        if($request->hasFile('avatar')){
            if(Storage::exists('public/'.$user->avatar)){
                Storage::delete('public/'.$user->avatar);
            }
            $path = $request->avatar->store('user/avatar', 'public');
            $user->avatar=$path;
        }

        // file management
        if($request->hasFile('CV')){
            if(Storage::exists('public/'.$user->teacher->CV)){
                Storage::delete('public/'.$user->teacher->CV);
            }
            $path = $request->CV->store('user/'.$user->id.'/CV', 'public');
            $user->teacher->CV=$path;
        }

        if($request->hasFile('transkrip')){
            if(Storage::exists('public/'.$user->teacher->transkrip)){
                Storage::delete('public/'.$user->teacher->transkrip);
            }
            $path = $request->transkrip->store('user/'.$user->id.'/transkrip', 'public');
            $user->teacher->transkrip=$path;
        }
        if($request->hasFile('certificate')){
            foreach($request->certificate as $certificate){
                $path = $certificate->store('user/'.$user->id.'/certificate', 'public');
                $newCertificate = new \App\Certificate;
                $newCertificate->name=$certificate->getClientOriginalName();
                $newCertificate->file=$path;
                $newCertificate->teacher_id = Auth::user()->teacher->id;
                $newCertificate->save();
                // $user->teacher->certificate=$path;
            }
        }
        if(!$this->anyNull($user)){
            //complete set true
            $user->filled=true;
        }else{
            //complete set false
            $user->filled=false;

        }
        if($user->save() && $user->teacher->save()){
            return redirect()->route('teacher.index')->with('message', 'success');
        }
    }
    /**
     * check any null data on teacher data
     * @param @user
     */
    private function anyNull($user){
        if($user->name==NULL){
            return true;
        }else if($user->email==NULL){
            return true;
        }else if($user->teacher->tanggal_lahir==NULL){
            return true;
        }else if($user->teacher->nomor_handphone==NULL){
            return true;
        }else if($user->teacher->nomor_whatsapp==NULL){
            return true;
        }else if($user->teacher->pendidikan_terakhir==NULL){
            return true;
        }else if($user->teacher->jenis_kelamin==NULL){
            return true;
        }else if($user->teacher->alamat==NULL){
            return true;
        }else if($user->teacher->kabupaten_kota==NULL){
            return true;
        }else if($user->teacher->kode_pos==NULL){
            return true;
        }else if($user->teacher->CV==NULL){
            return true;
        }else if($user->teacher->transkrip==NULL){
            return true;
        }
        return false;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    public function deleteCv(Request $request){
        Storage::delete('public/'.Auth::user()->teacher->CV);
        Auth::user()->teacher->CV=NULL;
        Auth::user()->teacher->save();

        return response([
            'msg' => "berhasil dihapus",
        ],200);
    }

    public function deleteTranskrip(Request $request){
        Storage::delete('public/'.Auth::user()->teacher->transkrip);
        Auth::user()->teacher->transkrip=NULL;
        Auth::user()->teacher->save();

        return response([
            'msg' => "transkirp berhasil dihapus",
        ],200);
    }

    public function deleteCertificate(Request $request){
        $certificate = \App\Certificate::find($request->id);
        Storage::delete('public/'.$certificate->file);
        $certificate->delete();

        return response([
            'msg' => "certificate berhasil dihapus",
        ],200);
    }
}
