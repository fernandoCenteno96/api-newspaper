<?php

namespace App\Http\Controllers;

use App\models\Category;
use Hamcrest\Type\IsObject;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function index()
    {
     $category=Category::all();
        return response()->json(['data'=>$category],201);
      
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|unique:categorys',
        ]);
        //en esta funcion guardamos los datos enviados por post en la base de datos
        $data=$request->all();
        $category=Category::create($data);
        if(is_object($data)){
          return response()->json([
            'code'=>'200',
            'status'=>'success',
            'data'=> $category
            ],200);
           
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'la entrada no existe',
                'code'=>'404'
            ],404);

        }
           

      
    }

   
    public function show($id)
    {
        $category=Category::findorFail($id);
        if(is_object($category)){
            return response()->json([
                    'code'=>'200',
                    'status'=>'success',
                    'data'=>$category
            ],201);
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
        $request->validate([
            'name'=>'required|string|unique:categorys',
        ]);
        //realizamos la actualizacion del los datos
        $category=Category::findorFail($id);
        if(is_object($category)){
            $category->name=$request->name;
           if($category->save()){
                return  response()->json([
                    'data'=>$category,
                    'status'=>'success',
                    'code'=>'200'
            
                ],200);
            }else{
                return  response()->json([
                    'message'=>'error al actualizar',
                    'status'=>'error',
                    'code'=>'404'
                
                ],200);  
            }
        
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'la entrada no existe',
                'code'=>'404'
            ],404);
        }
       
    }

  
    public function destroy($id)
    {
        $category=Category::findorfail($id);
        if(is_object($category)){
            
            if( $category->delete()){
                return response()->json([
                    'code'=>'200',
                    'status'=>'success',
                    'data'=>$category
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
