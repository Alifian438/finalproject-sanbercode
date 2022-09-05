@extends('layouts.master')

@section('content')
<form action="/forum" method="post" enctype="multipart/form-data">
   {{-- Judul --}}
   @csrf
   {{-- @method() --}}
   <div class="form-group">
     <label>Judul</label>
     <input type="text" name="judul" class="form-control">
   </div>
{{-- Error Juduk --}}
@error('judul')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
{{-- Pertanyaan --}}
   <div class="form-group">
     <label>Pertanyaan</label>
     <textarea name="isi" class="form-control" cols="30" rows="10"></textarea>
   </div>
{{-- Error Pertanyaan --}}
@error('isi')
   <div class="alert alert-danger">{{ $message }}</div>
@enderror
{{-- Kategori --}}
<div class="form-group">
  <label>Kategori</label>
  <select type="text" name="kategori_id" class="form-control" id="">
    <option value="">--- Pilih Kategori ---</option>
  @forelse ($kategori as $item)
      <option value="{{$item->id}}">{{$item->nama}}</option>
  @empty
      <option value="">No Kategori</option>
  @endforelse
</select>
</div>
{{-- Error Kategori--}}
@error('kategori_id')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
{{-- Gambar --}}
<div class="form-group">
    {{-- <label>Gambar</label> --}}
    <input type="file" name="gambar" class="form-control">
  </div>
  {{-- Error Kategori--}}
@error('gambar')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
  

   <button type="submit" class="btn btn-primary">Submit</button>
 </form>
@endsection