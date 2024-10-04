@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{ $title }}</h1>
    @include('sweetalert::alert')
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="h5">{{ $title }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id=""
                                aria-describedby="namaHelp" placeholder="{{$user}}" value="{{$user}}" disabled/>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="text" class="form-control" name="password" id=""
                                aria-describedby="pwHelp" placeholder="" />
                        </div>
                        <div class="mb3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .btn-label {
            position: relative;
            left: -12px;
            display: inline-block;
            padding: 6px 12px;
            background: rgba(0, 0, 0, 0.15);
            border-radius: 3px 0 0 3px;
        }

        .btn-labeled {
            padding-top: 0;
            padding-bottom: 0;
        }

        .btn {
            margin-bottom: 10px;
        }
    </style>
@stop
