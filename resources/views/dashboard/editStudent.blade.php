@extends('layouts.dashboard')

@section('content')
<form action="{{route('student.update')}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @CSRF
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Profile</h1>
                <hr />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card border-left-warning mt-2">
                    <div class="card-body">
                        <h2>Biodata</h2>
                        <hr />

                        {{-- nama lengkap --}}
                        <div class="form-group">
                            <label for="name">Nama Lengkap:</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}"
                                placeholder="Nama lengkap" >
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="form-group">
                            <label for="name">Tanggal Lahir:</label>
                            <input type="date" class="form-control" name="tanggal_lahir"
                                value="{{$user->student->tanggal_lahir}}" placeholder="Nama lengkap" >
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="card mt-2">
                    <div class="card-body border-bottom-warning">
                        <h2>Avatar</h2>
                        <hr />
                        <img src="{{Storage::url($user->avatar)}}">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="avatar" id="avatar">
                                <label class="custom-file-label" for="customFile">Pilih Foto</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-body">
                        <h2>Alamat:</h2>
                        <hr />
                        {{-- alamat lengkap --}}
                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap:</label>
                            <input type="text" class="form-control" name="alamat" value="{{$user->student->alamat}}" placeholder="Alamat Lengkap">
                        </div>

                        {{-- kabupaten/kota --}}
                        <div class="form-group">
                            <label for="kabupaten_kota">Kabupaten/Kota:</label>
                            <input type="text" class="form-control" name="kabupaten_kota" value="{{$user->student->kabupaten_kota}}" placeholder="Kabupaten/Kota">
                        </div>
    
                        {{-- Kode Pos --}}
                        <div class="form-group">
                            <label for="kode_pos">Kode Pos:</label>
                            <input type="number" class="form-control" name="kode_pos" value="{{$user->student->kode_pos}}" placeholder="Masukkan Kode Pos">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <h2>Pendidikan</h2>
                        <hr />
                        {{-- Tingkatan --}}
                        <div class="form-group">
                            <label for="tingkatan">Tingkatan:</label>
                            <select  class="form-control" name="tingkatan">
                                <option value="TK">TK</option>
                                <option value="SD" {{ $user->student->tingkatan=='SD' ? 'selected': '' }}>SD</option>
                            </select>
                        </div>

                        {{-- Kelas --}}
                        <div class="form-group">
                            <label for="Kelas">Kelas:</label>
                            <input type="number" class="form-control" name="kelas" value="{{$user->student->kelas ? $user->student->kelas : 0 }}" placeholder="Masukkan Kelas 0 - 6">
                            <small class="form-text text-muted">
                                Jika Tingakatan <b>TK</b> isi dengan 0
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <h2>Nomor Handphone</h2>
                        <hr />
                        {{-- nomor handphone --}}
                        <div class="form-group">
                            <label for="nomor_handphone">Nomor Handphone</label>
                            <input type="number" placeholder="Nomor Handphone" class="form-control" value="{{$user->student->nomor_handphone}}">
                        </div>

                        <div class="form-group">
                                <label for="nomor_whatsapp">Nomor Whatsapp</label>
                                <input type="number" placeholder="Nomor Whatsapp" class="form-control" value="{{$user->student->nomor_whatsapp}}">
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <hr />
        <div class="col-md-12 mt-3">
            <button class="btn btn-block btn-primary btn-sm" type="submit">UPDATE</button>
        </div>

    </div>
    @endsection


    @section('additional-js')
    <script>
            // Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
            </script>
            @endsection