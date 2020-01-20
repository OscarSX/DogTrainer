<?php

namespace App\Http\Controllers;

use App\Dog;
use Illuminate\Http\Request;

class DogController extends Controller
{
    public function index(Request $request){
        $dogs = Dog::all();
        if($request->ajax()){
            return response()->json($dogs, 200);
        }
        return view('dogs.index');
    }

    public function store(Request $request){
        if($request->ajax()){
            $dog = new Dog();
            $dog->name = $request->input('name');
            $dog->picture = $request->input('picture');
            $dog->save();

            return response()->json([
                "message" => "Dog creado correctamente",
                "dog" => $dog
            ], 200);
        }
    }
}
