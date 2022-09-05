@extends('layouts.master')

@section('content')
<form action="/forum/{{$forum->id}}" method="post" enctype="multipart/form-data">
   {{-- Judul --}}
   @csrf
   @method('put')
   <div class="form-group">
     <label>Judul</label>
     <input type="text" name="judul" value="{{old('judul',$forum->judul)}}" class="form-control">
   </div>
{{-- Error Juduk --}}
@error('judul')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
{{-- Pertanyaan --}}
   <div class="form-group">
     <label>Pertanyaan</label>
     <textarea name="isi" class="form-control"  cols="30" rows="10">{{old('isi',$forum->isi)}}</textarea>
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
  @if ($item->id === $forum->kategori_id)
  <option value="{{$item->id}}"selected>{{$item->nama}}</option>
  @else
  <option value="{{$item->id}}">{{$item->nama}}</option>
  @endif
      
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