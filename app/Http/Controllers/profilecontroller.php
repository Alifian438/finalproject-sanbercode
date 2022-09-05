<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\User;
use File;

class profilecontroller extends Controller
{
    public function index(){
        $idUser = Auth::id();
        $profile = Profile::where('user_id', $idUser)->first();
        return view('profile.profile', ['profile' => $profile]);
    }

    public function edit($id)
    {
        $idUser = Auth::id();
        $profile = Profile::where('user_id', $idUser)->first();
        return view('profile.update', ['profile' => $profile]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'umur' => 'required',
                'bio' => 'required',
                'alamat' => 'required',
                'foto' => 'mimes:jpg,jpeg,png|max:2048'

            ]
        );

        $profile = profile::find($id);

        if ($request->has('foto')) {
            $path = 'foto/';
            File::delete($path . $profile->foto);

            $namafoto = time() . '.' . $request->foto->extension();
            //jika ingin membuat nama gambar berdasarkan slug
            // $namaPoster = Str::slug($request->judul, '-') . '.' . $request->poster->extension();
            $request->foto->move(public_path('foto'), $namafoto);

            $profile->foto = $namafoto;

            $profile->save();
        }

        $profile->user->name = $request->name;
        $profile->umur = $request->umur;
        $profile->bio = $request->bio;
        $profile->alamat = $request->alamat;
        $profile->save();
        $profile->user->save();

        return redirect('/profile');
    }
}
