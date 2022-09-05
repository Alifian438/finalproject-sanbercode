<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Komentar;
// use File;

use Illuminate\Support\Facades\DB; 

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {
        $user = Auth::user();
        // dd($user);
        $forum = Forum::where('user_id', $user)->first();
        $forum = Forum::all();
        $profile= Profile::all();
        // dd($forum);
        return view('pages.index', ['forum'=>$forum, 'profile'=>$profile]);
        // return "berhasil";
        // $forum =DB::table('forum')->get();
        // dd($forum);
 
        // return view('pages.index', ['forum' => $forum]);
        // return view('pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('pages.create', ['kategori'=>$kategori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' =>'required|mimes:jpg,jpeg,png,csv',
            // 'profile_id'=>'required',
            // 'user_id'=>'required',
            'kategori_id'=>'required',
        ]);
        $filename = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('images'),$filename);

        $forum = new Forum;
        $profile = new Profile;
        $forum->user_id = Auth()->id();
        $profile->profile_id = $request->foto;
        $forum->judul = $request->judul;
        $forum->isi = $request->isi; 
        $forum->gambar = $filename;
        $forum->kategori_id = $request->kategori_id;

        $forum->save();
        // dd($forum);
        return redirect('/forum');
        // DB::table('forum')->insert([
        //     'nama' => $request['nama'],
        //     'umur' => $request['umur'],
        //     'bio' => $request['bio']
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $forum = Forum::where('user_id', $user)->first();
        $forum = Forum::find($id);
        // dd($forum);
        return view('pages.detail', ['forum'=>$forum]);
        // $forum = DB::table('forum')->where('id', $id)->first();
        // return view('pages.detail', ['forum'=>$forum]);
        // return view('pages.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        // $user = Auth::user();
        $kategori = Kategori::all();
        $forum = Forum::find($id);
        $this->authorize('update', $forum);
        // $forum = Forum::where('user_id', $user)->first();
        return view('pages.edit',['forum'=>$forum, 'kategori'=>$kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if($forum->author !== auth()->id || auth()->user()->cannot('edit posts')) abort(404);
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' =>'mimes:jpg,jpeg,png,csv',
            // 'profile_id'=>'required',
            // 'user_id'=>'required',
            'kategori_id'=>'required',
        ]);
        $forum = Forum::find($id);

        if($request->has('gambar')){
        $path = 'images/';
        File::delete($path.$forum->gambar);

        $filename = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('images'),$filename);
        $forum->gambar = $filename;
        $forum->save();
        }
        $forum->judul = $request->judul;
        $forum->isi = $request->isi; 
        $forum->kategori_id = $request->kategori_id;
        $forum->save();
        return redirect('/forum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $user = Auth::user();
        $forum = Forum::find($id);
        $this->authorize('delete', $forum);
        // $forum = Forum::where('user_id', $user)->first();
        
        // if(auth()->guest() || auth()->user()->id !== $forum->user_id){
        //     abort (403);
        // }
        $path = 'images/';
        File::delete($path.$forum->gambar);
        
        $forum->delete();
        

        return redirect('/forum');
    }

    public function komentar(Request $request, $id){

        $user = Auth::user();
        $forum = Forum::find($id);

        $filename = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('images'),$filename);

        $komentar = new Komentar;
        $profile = new Profile;
        $profile->profile_id = $request->foto;
        $komentar->isi = $request->isi; 
        $komentar->gambar = $filename;
        $komentar->user_id = auth()->user()->id;
        $komentar->forum_id = $request->forum_id;
        $komentar->save();
        // dd($forum);
        // return redirect('/forum/{forum}');
        return view('pages.detail', ['forum'=>$forum]);
    }
}
