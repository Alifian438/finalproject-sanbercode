<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Kategori;

class downloadpdf extends Controller
{
    public function pdf()

    {
        $kategori = Kategori::all();
        // return view('kategori.cetak',['kategori'=>$kategori]);
        $pdf = PDF::loadview('kategori.cetak',['kategori'=>$kategori]);
        // // $pdf = \PDF::loadview('kategori.index', $kategori);
        // return view('profile.profile', ['profile' => $profile]);
        return $pdf->download('kategori-pdf.pdf');
        

    }
}
