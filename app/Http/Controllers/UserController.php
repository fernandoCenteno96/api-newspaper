<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        return response()->json(['data'=>$user],201);
    }

   

  
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|',
            'surname'=>'required',
            'email'=>'required|email|unique:Users',
            'description'=>'required',
            'image'=>'required',
            'role'=>'required',
            'password'=>'required|min:6|confirmed'

        ]);
        $user=new User();
        $user->name=$request->name;
        $user->username=$request->username;
        $user->email=$request->email;
        $user->description=$request->description;
        $user->password=bcrypt($request->password);
        $user->image=$request->image;
        $user->role=$request->role;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $user=User::findorFail($id);
       return response()->json(['data'=>$user],201);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findorfile($id);
        $user->delete();

        return response()->json(['data'=>$user,'message'=>'delete complete'],201);
    }
}
