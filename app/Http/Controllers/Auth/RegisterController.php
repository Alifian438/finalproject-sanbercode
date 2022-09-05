<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Profile;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'umur' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'bio' => ['required'],
            'alamat' => ['required'],
            // 'foto' => ['mimes:jpg,jpeg,png|max:2048']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $request = request();
        $namafoto = time() . '.' . $request->foto->extension();
        //jika ingin membuat nama gambar berdasarkan slug
        // $namaPoster = Str::slug($request->judul, '-') . '.' . $request->poster->extension();
        $request->foto->move(public_path('foto'), $namafoto);
        // $foto = $request->file('foto');
        // $fotoSaveAsName = time() . Auth::id() . "-foto." . $foto->getClientOriginalExtension();
        // $upload_path = 'foto/';
        // $foto_url = $upload_path . $fotoSaveAsName;
        // $success = $foto->move($upload_path, $fotoSaveAsName);

        // if ($data == 'foto') {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $profile = new profile;

        $profile->fill([
            'user_id' => $user->id,
            'foto' => $namafoto,
            'umur' => $data['umur'],
            'bio' => $data['bio'],
            'alamat' => $data['alamat']
        ]);

        $profile->save([$user]);

        return $user;
        // }


        // $user = User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);

        // $request = request();
        // $namafoto = time() . '.' . $request->foto->getClientOriginalExtension();
        // $request->foto->move(public_path('foto'), $namafoto);

        // // $namafoto = time() . '.' . $data['foto']->extension();
        // // $data['foto']->move(public_path('image'), $namafoto);

        // Profile::create([
        //     'umur' => $data['umur'],
        //     'bio' => $data['bio'],
        //     'alamat' => $data['alamat'],
        //     'foto' => $namafoto,
        //     'user_id' => $user->id
        // ]);





        // if (request()->hasFile(key: 'foto')) {
        //     $foto = request()->file(key: 'foto')->getClientOriginalName();
        //     request()->file(key: 'foto')->storeAs(path: 'foto', name: $profile->id . '/' . $foto, options: '');
        //     $profile->update(['foto' => $foto]);
        // }

        // return $user;
    }
}
