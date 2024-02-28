<?php

namespace App\Http\Controllers;

use id;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $galeris = Galery::where('iduser',Auth::user()->id)->get();
        return view('timeline',['galeris'=>$galeris]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate ([
            'judul'=>'required',
            'deskripsi'=>'required',
            'foto'=>'required',
        ]);

    $namafoto = Auth::user()->id.'-'.date('YmdHis').$request->foto->getClientOriginalName();

        $data = [
            'judul'=>$request->judul,
            'deskripsi'=>$request->deskripsi,
            'tanggal'=>now(),
            'foto'=>$namafoto,
            'iduser'=>Auth::user()->id
        ];
        $request->foto->move(public_path('images'),$namafoto);
        Galery::create($data);
        return redirect('/galery');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        Galery::where('id',$id)->delete();
        return redirect('/galery');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galery $galery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galery $galery)
    {
        //
        if($request->hasFile('foto'))
        {
            $namafoto = Auth::user()->id.'-'.date('YmdHis').$request->foto->getClientOriginalName();
            $request->foto->move(public_path('images'),$namafoto);
            $galery->judul=$request->judul;
            $galery->deskripsi=$request->deskripsi;
            $galery->tanggal=now();
            $galery->foto=$namafoto;
            $galery->iduser=Auth::user()->id;
            $galery->save();
        } else {
            $galery->judul=$request->judul;
            $galery->deskripsi=$request->deskripsi;
            $galery->tanggal=now();
            $galery->foto=$galery->foto;
            $galery->iduser=Auth::user()->id;
            $galery->save();
        }
        return redirect('/galery');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galery $galery)
    {
        //
    }
}
