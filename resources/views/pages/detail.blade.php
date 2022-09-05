@extends('layouts.master')

@section('content')
@push('scripts')
<script src="https://cdn.tiny.cloud/1/nlhj8xqunlsj381i8jk0d3c8plyejyyt3vsupj6z6351qvil/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
      toolbar_mode: 'floating',
    });
  </script>
@endpush
<div class="inner-main-body p-2 p-sm-3 forum-content">
    <a href="/forum" class="btn btn-light btn-sm mb-3 has-icon" ><i class="fa fa-arrow-left mr-2"></i>Back</a>
    <div class="card mb-2">
        <div class="card-body">
            <div class="media forum-item">
                <img src="{{ asset('foto/'.$forum->user->profile->foto) }}" class="mr-3 rounded-circle" width="50" height="50" alt="User" />
                <div class="media-body ml-3">
                    <h5 class="mt-1">{{$forum->judul}}</h5>
                    {{-- Masukkin User --}}
                    <p class="text-muted">Posted by {{$forum->user->name}}</a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle text-dark" data-toggle="dropdown">
                        <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a href="/forum/{{$forum->id}}/edit/" class="dropdown-item">Edit</a>
                        <form action="/forum/{{$forum->id}}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="dropdown-item btn btn-light btn-sm">
                        </form>
                        </div>
                    </div>
                    {{-- <small class="text-muted ml-2">1 hour ago</small> --}}
                    <div class="mt-3 font-size-sm">
                        <img src ="{{asset('/images/'.$forum->gambar)}}" height="200px" width="100%" alt="...">
                        <p>
                           {{$forum->isi}}
                        </p>
                    </div>
                    <label >Reply</label>
                    {{-- <button class="btn btn-primary" id="btn-komentar">Reply</button> --}}
                    <form action="" style="margin-top:10px;" id="komentar" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="forum_id" value="{{$forum->id}}">
                        <textarea name="isi" class="form-control" rows="4"></textarea>
                        <div class="form-group">
                            {{-- <label>Gambar</label> --}}
                            <input type="file" name="gambar" class="form-control mt-3">
                          </div>
                        <input type="submit" class="btn btn-primary" value="kirim" >
                    </form>
                </div>
                {{-- <div class="text-muted small text-center">
                    <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 19</span>
                    <span><i class="far fa-comment ml-2"></i> 3</span> --}}
                </div>
            </div>
        </div>   
    </div>
    <div class="inner-main-body p-2 p-sm-3 forum-content">
        <h3 class="mb-3 has-icon" >Komentar</h3>
        @foreach ($forum->komentar as $item)
        <div class="card mb-2">
            <div class="card-body">
                <div class="media forum-item">
                        <img src="{{ asset('foto/'.$item->user->profile->foto) }}" class="rounded-circle" width="50" height="50" alt="User" />
                    <div class="media-body ml-3">
                        {{-- Masukkin User --}}
                        <a href="javascript:void(0)" class="text-secondary">{{$item->user->name}}</a>
                        {{-- <small class="text-muted ml-2">1 hour ago</small> --}}
                        <h5 class="mt-1">{{$forum->judul}}</h5>
                        <div class="mt-3 font-size-sm">
                            <img src ="{{asset('images/'.$item->gambar)}}" height="200px" width="100%" alt="...">
                            <p>
                               {!!$item->isi!!}
                            </p>
                        </div>
                        
                    </div>
                    {{-- <div class="text-muted small text-center">
                        <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 19</span>
                        <span><i class="far fa-comment ml-2"></i> 3</span> --}}
                    </div>
                </div>
            </div> 
            @endforeach  
        </div>
        
        
   
        
@endsection

