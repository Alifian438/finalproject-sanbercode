@extends('layouts.master')

@section('content')

<div class="text-center">
    <img src="{{ asset('foto/'. $profile->foto) }}" class="rounded-circle my-3" width="150" height="150" alt="">
    {{-- <p>{{$user->name}}</p> --}}
    <h3>{{$profile->user->name}}</h3>
    <p class="text-scondary">{{$profile->umur}} tahun</p>
    <p class="text-scondary">{{$profile->alamat}}</p>
    <h3 class="my-3">Biodata</h3>
    <p>{{$profile->bio}}</p>
    <a href="/profile/{profile}/edit" class="btn btn-primary my-5">Edit Profile</a>    
</div>

@endsection