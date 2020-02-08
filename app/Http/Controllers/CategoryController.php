<?php

namespace App\Http\Controllers;

use App\models\Category;
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
        return response()->json(['data'=> $category],200);
           

      
    }

   
    public function show($id)
    {
        $category=Category::findorFail($id);
        return response()->json(['data'=>$category],201);
    }

    
   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string|unique:categorys',
        ]);
        //realizamos la actualizacion del los datos
        $category=Category::findorFail($id);
        $category->name=$request->name;
        $category->save();
        return  response()->json(['data'=>$category],200);
    }

  
    public function destroy($id)
    {
        $category=Category::findorfail($id);
       if( $category->delete()){
           return response()->json(['data'=>$category]);
       }
    }
}
