@extends('layouts.dashboard')

@section('additional-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
@endsection

@section('additional-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="alert {{Session::get('message')=='success' ? 'alert-success' : 'alert-danger'}}">{{Session::get('message')=='success' ? 'Profile berhasil di update!' : 'Profile gagal di update'}}</div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="mx-auto">
                <a href="{{asset('storage/'.$user->avatar)}}" data-toggle="lightbox">
                    <img class="img-profile rounded-circle" style="width:100px; height:100px" src="{{asset('storage/'.$user->avatar)}}">
                </a>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h2><b>{{$user->name}}</b></h2>
                            {{$user->role->name}} {{$data->tingkatan}} {{$data->kelas>0 ? 'Kelas '.$data->kelas : ''}}
                            <small>{{$data->tanggal_lahir}} / {{$data->jenis_kelamin}}</small>
                            <hr />
                            <a href="{{route(strtolower($user->role->name).'.edit')}}"><button class="btn btn-primary">Edit Profile</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <h5>Alamat: <small>Tidak akan ditampilkan secara publik</small></h5>
                        <hr />
                        <p>{{$data->alamat}}</p>
                        <p><b>Kabupaten/Kota</b> {{$data->kabupaten_kota}}</p>
                        <p><b>Kode Pos</b> {{$data->kode_pos}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mt-2">
                    <div class="card-body">
                        <h5>Contact <small>Tidak akan ditampilkan secara publik</small></h5>
                        <hr />
                        <p><b>E-Mail</b> {{Auth::user()->email}}</p>
                        <p><b>Nomor Handphone</b> {{$data->nomor_handphone}}</p>
                        <p><b>Nomor Whatsapp</b> {{$data->nomor_whatsapp}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection