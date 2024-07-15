@extends('layouts.app')

@section('title', 'Halaman Dashboard Admin')
@section('content')

    <div class="container">
        <div class="row justify-content-center mt-5">

            <h4 class="font-weight-light text-center">👋 Selamat Datang </h4>
            <h4 class="font-weight-bold text-center"> Admin {{ auth()->user()->name }}</h4>



        </div>
    </div>

@endsection
