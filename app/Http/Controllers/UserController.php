<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function saveRegister(Request $request){
        $data = $request->validate(
            [
                'username'=>'required',
                'password'=>'required',
                'nama'=>'required',
                'email'=>'required',
            ]
            );
            $simpan = [
                'username'=>$data['username'],
                'password'=>bcrypt($data['password']),
                'nama'=>$data['nama'],
                'email'=>$data['email'],
            ];
            User::create($simpan);
            return redirect('/');
    }
    public function proseslogin(Request $request){
        $data = $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        $data = $request->only(['username','password']);
        if(Auth::attempt($data)){
            return redirect('/galery');
        }else{
            return redirect('/');
        }
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
