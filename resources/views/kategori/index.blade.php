@extends('layouts.master')


@section('content')
{{-- Create Button --}}
<a href="/kategori/create" class="btn btn-primary btn-sm mb-3 "> Create</a>
{{-- Download PDF --}}
<a href="/kategori-pdf" class="btn btn-warning btn-sm mb-3 "> Download PDF</a>
{{-- Table --}}
 <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Action</th>
            {{-- <th scope="col">Umur</th>
            <th scope="col">Bio</th> --}}
        </tr>
    </thead>
    <tbody>
        @forelse ($kategori as $key => $value)
            <tr>
                <td>{{$key +1}}</td>
                <td>{{$value->nama}}</td>
                {{-- <td><{{$value->umur}}/td>
                <td>{{$value->Bio}}</td> --}}
                <td>
                    <form action="/kategori/{{$value->id}}" method="POST">
                    <a href="/kategori/{{$value->id}}/edit" class="btn btn-warning btn-sm "> Edit</a>
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-danger btn-sm" >
                    </form>
                </td>
                
            </tr>
        @empty
            <tr>
                <td> No Kategori</td>
            </tr>
        @endforelse
    </tbody>
 </table>

@endsection