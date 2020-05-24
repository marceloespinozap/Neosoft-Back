<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comentarios;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Facades\Validator;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    



    public function index($id_imagen)
    {
        $comentarios=Comentarios::where('imagen_id','=',$id_imagen)
        ->orderBy('id', 'desc')
        ->get();
        return response()->json($comentarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fechaActual = Carbon::now()->toDateTimeString();
        $request->request->add(['fecha' => $fechaActual]);
        $request->fecha=$fechaActual;

        $validator = Validator::make($request->all(), [
            'comentario' => 'required',
            'imagen_id' => 'required',
            'fecha' =>'required'
            ]);

        if ($validator->fails()) {
            return Response::make([
            'errors' => $validator->errors()
             ]);
            }
        else
        $ok=array(['comentario creado correctamente']);
        $request = Comentarios::create($request->all());
        return Response::make([
            'errors' => $ok
             ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
