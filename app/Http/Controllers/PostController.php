<?php

namespace App\Http\Controllers;

use App\models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post= Post::all();
        return response()->json([
            'status'=>'sucess',
            'Data'=> $post
        ],200); 
    }

  

  
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $post=Post::findorfail($id);
        if(is_object($post)){
            return response()->json([
                    'code'=>'200',
                    'status'=>'success',
                    'data'=>$post
                 ]);
            
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'la entrada no existe',
                'code'=>'404'
            ],404);
        }
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        $post=Post::findorfail($id);
        if(is_object($post)){
            
            if( $post->delete()){
                return response()->json([
                    'code'=>'200',
                    'status'=>'success',
                    'data'=>$post
                 ]);
            }else{
                return response()->json([
                    'code'=>'404',
                    'status'=>'error',
                    'message'=>'error al eliminar'
                ],404);

            }
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'la entrada no existe',
                'code'=>'404'
            ],404);
        }
    }
}
