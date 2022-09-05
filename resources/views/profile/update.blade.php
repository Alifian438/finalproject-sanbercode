@extends('layouts.master')

@section('content')
<form action="/profile/{{$profile->id}}" method="post" enctype="multipart/form-data">
   
   @csrf
   @method('put')
   {{-- nama --}}
   <div class="form-group">
    <label>nama</label>
    <input type="text" name="name" value="{{old("name", $profile->user->name)}}" class="form-control">
  </div>
{{-- Error umur --}}
@error('umur')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
   {{-- umur --}}
   <div class="form-group">
     <label>umur</label>
     <input type="text" name="umur" value="{{old("umur", $profile->umur)}}" class="form-control">
   </div>
{{-- Error umur --}}
@error('umur')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
{{-- bio --}}
   <div class="form-group">
     <label>bio</label>
     <textarea name="bio" class="form-control" cols="30" rows="10">{{old("bio", $profile->bio)}}</textarea>
   </div>
{{-- Error bio --}}
@error('bio')
   <div class="alert alert-danger">{{ $message }}</div>
@enderror

{{-- alamat --}}
<div class="form-group">
  <label>alamat</label>
  <textarea name="alamat" class="form-control" cols="30" rows="10">{{old("alamat", $profile->alamat)}}</textarea>
</div>
{{-- Error alamat --}}
@error('alamat')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

{{-- Gambar --}}
<div class="form-group">
    {{-- <label>Gambar</label> --}}
    <input type="file" name="foto" class="form-control">
  </div>
  {{-- Error Kategori--}}
@error('foto')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
  
    <a href="/profile" class="btn btn-secondary">Kembali ke Profile</a>
   <button type="submit" class="btn btn-primary">Submit</button>
 </form>
@endsection