@extends('layouts.master')

@section('content')
<form action="/kategori/{{$kategori->id}}" method="post" enctype="multipart/form-data">
   {{-- Nama --}}
   @csrf
   @method('put')
   <div class="form-group">
     <label>Nama</label>
     <input type="text" name="nama" value="{{old('nama',$kategori->nama)}}" class="form-control">
   </div>
{{-- Error Nama --}}
@error('nama')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
   <button type="submit" class="btn btn-primary">Submit</button>
 </form>
@endsection