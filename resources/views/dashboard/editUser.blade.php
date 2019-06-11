@extends('layouts.dashboard')

@section('content')
<form action="{{route( (Auth::user()->role->name=='Student' ? 'student' : 'teacher').'.update' ) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @CSRF
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Profile <small><i>{{Auth::user()->role->name}}</i></small></h1>
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
                                placeholder="Nama lengkap">
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="form-group">
                            <label for="name">Tanggal Lahir:</label>
                            <input type="date" class="form-control" name="tanggal_lahir"
                                value="{{$data->tanggal_lahir}}" placeholder="Nama lengkap">
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-Laki" {{$data->jenis_kelamin=="Laki-Laki" ? 'selected' : ''}}>
                                    Laki-Laki</option>
                                <option value="Perempuan" {{$data->jenis_kelamin=="Perempuan" ? 'selected' : ''}}>
                                    Perempuan</option>
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
                        <img class="img-thumbnail" src="{{Storage::url($user->avatar)}}">
                        <div class="form-group mt-2">
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
                            <input type="text" class="form-control" name="alamat" value="{{$data->alamat}}"
                                placeholder="Alamat Lengkap">
                        </div>

                        {{-- kabupaten/kota --}}
                        <div class="form-group">
                            <label for="kabupaten_kota">Kabupaten/Kota:</label>
                            <input type="text" class="form-control" name="kabupaten_kota"
                                value="{{$data->kabupaten_kota}}" placeholder="Kabupaten/Kota">
                        </div>

                        {{-- Kode Pos --}}
                        <div class="form-group">
                            <label for="kode_pos">Kode Pos:</label>
                            <input type="number" class="form-control" name="kode_pos" value="{{$data->kode_pos}}"
                                placeholder="Masukkan Kode Pos">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @if(Auth::user()->role->name=="Student")
            <div class="col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <h2>Pendidikan</h2>
                        <hr />
                        {{-- Tingkatan --}}
                        <div class="form-group">
                            <label for="tingkatan">Tingkatan:</label>
                            <select class="form-control" name="tingkatan" id="tingkatan">
                                <option value="TK" {{ $data->tingkatan=='TK' ? 'selected': '' }}>TK</option>
                                <option value="SD" {{ $data->tingkatan=='SD' ? 'selected': '' }}>SD</option>
                                <option value="SMP" {{ $data->tingkatan=='SMP' ? 'selected': '' }}>SMP</option>
                            </select>
                        </div>
                        {{-- Kelas --}}
                        <div class="form-group">
                            <label for="Kelas">Kelas:</label>
                            <input type="number" class="form-control" name="kelas"
                                value="{{$data->kelas ? $data->kelas : 0 }}" placeholder="Masukkan Kelas 0 - 6">
                            <small class="form-text text-muted">
                                Jika Tingakatan <b>TK</b> isi dengan 0
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(Auth::user()->role->name=="Teacher")
            <div class="col-md-12">
                <div class="card mt-2">
                    <div class="card-body">
                        <h2>Pendidikan & Pekerjaan</h2>
                        <hr />
                        <div class="form-group">
                            <label for="pendidikan_terakhir">Pendidikan Terakhir:</label>
                            <input type="text" class="form-control" name="pendidikan_terakhir" value="{{$data->pendidikan_terakhir}}"
                                placeholder="Pendidikan Terakhir (S1, D3)">
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" class="form-control" name="pekerjaan" value="{{$data->pekerjaan}}" placeholder="Pekerjaan Terakhir / saat ini">

                        </div>
                        <input type="checkbox" name="masih_bekerja" value="TRUE" {{$data->masih_bekerja ? 'checked' : ''}}>Masih Bekerja?
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <h2>Berkas</h2>
                        <hr />

                        <label for="CV">Curiculum Vite</label>
                        <br />
                        <div id="CV">
                            @if($data->CV )
                                <div id="fileCv">

                                    <a href="{{Storage::url($data->CV)}}">{{'CV_'.Auth::user()->name}}</a>
                                    <a href="#" onClick="hapusCv()" class="text-danger">Hapus</a>
                                </div>
                            @else
                                <input type="file" class="form-control" name="CV">
                            @endif
                        </div>
                        <br />

                        <div id="transkrip">
                            <label for="transkrip">Transkrip</label>
                            @if($data->transkrip )
                                <div id="fileTranskrip">
                                    <a href="{{Storage::url($data->transkrip)}}">{{'transkrip_'.Auth::user()->name}}</a>
                                    <a href="#" onClick="hapusTranskrip()" class="text-danger">Hapus</a>
                                </div>
                            @else
                                <input type="file" class="form-control" name="transkrip">
                            @endif
                        </div>

                        <div id="field-certificate">
                            <label for="certificate[]">certificate</label>
                            @if($data->certificates)
                            <div id="fileCertificate">
                                @foreach($data->certificates as $certificate)
                                    <a href="{{Storage::url($certificate->file)}}">{{$certificate->name}}</a>
                                    <a href="#" onClick="hapusCertificate({{$certificate->id}})" class="text-danger">Hapus</a>
                                    <br />
                                @endforeach
                            </div>
                            @else
                                <input type="file" class="form-control" name="certificate[]">
                            @endif
                        </div>
                        <br />
                        <button  id="tambah-sertifikat" type="button" class="btn btn-success btn-block">Tambah Sertifikat</button>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <h2>Nomor Handphone</h2>
                        <hr />
                        {{-- nomor handphone --}}
                        <div class="form-group">
                            <label for="nomor_handphone">Nomor Handphone</label>
                            <input type="number" placeholder="Nomor Handphone" name="nomor_handphone"
                                class="form-control" value="{{$data->nomor_handphone}}">
                        </div>

                        <div class="form-group">
                            <label for="nomor_whatsapp">Nomor Whatsapp</label>
                            <input type="number" placeholder="Nomor Whatsapp" name="nomor_whatsapp" class="form-control"
                                value="{{$data->nomor_whatsapp}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr />
        <div class="col-md-12 mt-3">
            <button onClick="" class="btn btn-block btn-primary btn-sm" type="submit">UPDATE</button>
        </div>

    </div>
</form>
@endsection


@section('additional-js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });



    function hapusCv(){
        $('#fileCv').remove();
        $.ajax({
            type: "DELETE",
            url:"{{route('teacher.deleteCv')}}",
            success: function(response) {
                alert(response.msg);
                $('#CV').append('<input type="file" class="form-control" name="CV">');
            },
        })


    }

    function hapusTranskrip(){
        $('#fileTranskrip').remove();
        $.ajax({
            type: "DELETE",
            url:"{{route('teacher.deleteTranskrip')}}",
            success: function(response) {
                alert(response.msg);
                $('#transkrip').append('<input type="file" class="form-control" name="transkrip">');
            },
        })
    }

    function hapusCertificate(id){
        // $('#file0Certificate').remove();

        $.ajax({
            type: "DELETE",
            url:"{{route('teacher.deleteCertificate')}}",
            data:{'id': id},
            success: function(response) {
                alert(response.msg);
                // $('#field-certificate').append('<input type="file" class="form-control" name="certificate[]">');
            },
        })
    }

    $("#tambah-sertifikat").click(function(e){
        $("#field-certificate").append('<input type="file" class="form-control" name="certificate[]">');
    });
</script>
@endsection
