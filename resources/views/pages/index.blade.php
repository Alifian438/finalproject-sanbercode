@extends('layouts.master')


@section('content')

<div class="inner-main-body p-2 p-sm-3 forum-content show">
    <div class="card mb-2">
        @forelse ($forum as $item)
        <div class="card-body p-2 p-sm-3">
            <div class="media forum-item">
                {{-- diubah untuk profile --}}
                <img src="{{ asset('foto/'.$item->user->profile->foto) }}" class="mr-3 rounded-circle" width="50" height="50" alt="User" /></a>
                <div class="media-body">
                    <h6><a href="/forum/{{$item->id}}" class="text-body">{{$item->judul}}</a></h6>
                    <p class="text-secondary">
                        {{Str::limit($item->isi, 30)}}
                    </p>
                    {{-- diubah untuk user name --}}
                    <p class="text-muted">Posted by {{$item->user->name}}</a>
                        {{-- @empty
                         <p>No Posts</p> --}}
                </div>
            </div>
        </div>
        @empty
        <p>No Posts</p>
    </div>
</div>
@endforelse

@endsection