@extends('layouts.master')

@section('content')
<form action="/kategori" method="post" enctype="multipart/form-data">
   {{-- Nama --}}
   @csrf
   {{-- @method() --}}
   <div class="form-group">
     <label>Nama Kategori</label>
     <input type="text" name="nama" class="form-control">
   </div>
{{-- Error kategori --}}
@error('nama')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

   <button type="submit" class="btn btn-primary">Submit</button>
 </form>
@endsection