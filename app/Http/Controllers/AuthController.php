<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Alert;

class AuthController extends Controller
{
    public function index(){
        return view('register');
    }

    public function kirim(Request $request){
        $nama = $request['nama'];
        $alamat = $request['alamat'];
        $email = $request['email'];
        $nohp =$request['no_hp'];

        if ($request['gender']=="1") {
            $gender ="Laki-laki";
        } else {
            $gender ="Perempuan";
        }
        

        return view('biodata',['nama' => $nama , 'alamat' => $alamat , 'email' => $email , 'hp' => $nohp , 'gender' => $gender] );
    }

    public function signup(Request $request){

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'pwd'   => 'required'
        ]);

        $user = new User;
        $user->firstname=$request['fname'];
        $user->lastname=$request['lname'];
        $user->email=$request['email'];
        $user->password=$request['pwd'];
        $user->save();  //insert into posts

        Alert::success('Congrats', 'You\'ve Successfully Registered');
        return redirect('/login');
       /* return redirect('/login')->with('success','Berhasil Signup!'); */
 
    }
}
