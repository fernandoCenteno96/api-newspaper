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
    public function login(Request $request){
        $jwtAuth=new \App\helpers\JwtAuth ();
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
           $email= $request->email; 
           $password=hash('sha256',$request->password);
            $signup=$jwtAuth->signup($email,$password);
        
        if(!empty($request->gettoken)){

            $signup=$jwtAuth->signup($email,$password,true);
        }
        
           return response()->json($signup,200); 

    }
   

  
    public function store(Request $request)
    {
        
        $request->validate([
            'name'=>'required|string|',
            'surname'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);
       
        $user=new User();
        $user->name=$request->name;
        $user->surname=$request->surname;
        $user->email=$request->email;
        $user->description="";
        $user->password=hash('sha256',$request->password);
        $user->role="USER_ROLE";
        $user->image="";
        
        if($user->save()){
            return response()->json([
                'code'=>'201',
                'status'=>'success',
                'data'=>$user],201);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'el usuario no se ha creado',
                'code'=>'404'
            ],404);
        }
        
    }
    public function upload(){

        return "funciona ";
    }


  
    public function update(Request $request, $id)
    {
        $token=$request->header('authorization');
        $jwtAuth=new \app\helpers\jwtAuth;
        $checktoken=$jwtAuth->checkToken($token);
        
        if($checktoken){
        $request->validate([
            'name'=>'required|string|',
            'surname'=>'required',
            'email'=>'required|unique:users,email,'.$id,
            'description'=>'required',
            'password'=>'required|min:6|confirmed'

        ]);
       
        $user= User::findOrfail($id);
        $user->name=$request->name;
        $user->surname=$request->surname;
        $user->email=$request->email;
        $user->description=$request->description;
        $user->password=hash('sha256',$request->password);
        $user->role="USER_ROLE";
        
        
        if($user->save()){
            return response()->json([
                'code'=>'201',
                'status'=>'success',
                'data'=>$user],201);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'el usuario no se ha actualizado',
                'code'=>'404'
            ],404);

        }
            
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'el usuario no esta identificado correctamente',
                'code'=>'404'
            ],404);
        }
  
        
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
       if(is_object($user)){
        return response()->json([
            'data'=>$user,
            'status'=>'seccess',
            'code'=>'201'
        ],201);
       }else{
            return response()->json([
            'code'=>'404',
            'status'=>'error',
            'message'=>'error la entrada no existe'
            ],404);
       }
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
        if(is_object($user)){
            if($user->delete()){
                return response()->json([
                    'data'=>$user,
                    'message'=>'delete complete',
                    'status'=>'success',
                    'code'=>'201'
                ],201);
            }else{
                return response()->json([
                    'code'=>'404',
                    'status'=>'error',
                    'message'=>'error al eliminar'
                ],404);
            }

        }else{
            return response()->json([
                'code'=>'404',
                'status'=>'error',
                'message'=>'error la entrada no existe'
                ],404);
        }
        
    }
}
