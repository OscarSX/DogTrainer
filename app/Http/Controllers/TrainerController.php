<?php

namespace App\Http\Controllers;

use App\Trainer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTrainerRequest;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $trainers = Trainer::all();
        return view('trainers.index', compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request) //Sirve con el codigo de vlidateData
    public function store(StoreTrainerRequest $request)
    {
        //Existe documentacion en laravel para ver las distintas validaciones existentes
            //se movió a app/http/requests/StoreTrainerRequest.php
        /*$validatedData = $request->validate([
            'name' => 'required|max:12',
            'avatar' => 'required|image',
            'description' => 'required'
        ]);*/

        $trainer = new Trainer();

        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);
        }

        $trainer->name = $request->input('name');
        $trainer->avatar = $name;
        $trainer->description = $request->input('description');
        $trainer->slug = time().$request->input('name');
        $trainer->save();

        return redirect()->route('trainers.index')->with('status','Entrenador creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function show($id) //Una manera de obtener el id y uilizarlo en la linea 63
    public function show(Trainer $trainer) //implicit binding: resuelve automáticamente los modelos Eloquent
    //public function show($slug) //No buscar por id, sino por otro id alternativo, ayuda a protejer la logica de programacion al cliente final
    {
        //$trainer = Trainer::find($id); //modelo Eloquent
        //$trainer = Trainer::where('slug','=',$slug)->firstOrFail(); //lineas agregadas en trainer ayuda a usar implicit binding sin la necesidad de utilizar el id, sino un slug
        return view('trainers.show', compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
        return view('trainers.edit', compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
        $trainer->fill($request->except('avatar'));

        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();
            $trainer->avatar = $name;
            $file->move(public_path().'/images/', $name);
        }

        $trainer->save();
        return redirect()->route('trainers.show',[$trainer])->with('status','Entrenador actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainer $trainer)
    {
        $file_path=public_path().'/images/'.$trainer->avatar;
        if(\File::exists($file_path)){
            \File::delete($file_path);
        }
        else{
            dd('El archivo no existe');
        }
        $trainer->delete();
        return redirect()->route('trainers.index')->with('status','Entrenador eliminado correctamente');
    }
}
