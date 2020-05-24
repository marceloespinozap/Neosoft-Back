<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Imagenes;
use Carbon\Carbon;
use Response;
use File;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function getImagen($id){
        $imagen=Imagenes::findOrFail($id);
        $destination = base_path();
        $destination = substr($destination, 0,strlen($destination)- 4) . "imagenes\\" . $imagen->codigo;
        $file = File::get($destination);
        $type = File::mimeType($destination);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    


     }
    public function index()
    {
        $imagenes=Imagenes::orderBy('id','DESC')->paginate(10);
        
        return response()->json($imagenes);

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
        $request->fecha=$fechaActual;

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'imagen' =>'file|mimes:png,jpeg,jpg|max:5000',

            ]);
        
        if ($validator->fails()) {
            return Response::make([
            'errors' => $validator->errors()
             ]);
            }
        else
        $file = $request->imagen->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $file= uniqid() . "." .  $extension;
        $destination = base_path();
        $destination = substr($destination, 0,strlen($destination)- 4) . "imagenes";

        $request->imagen->move($destination, $file);

        $imagen = new Imagenes;
        $imagen->codigo=$file;
        $imagen->nombre=$request->nombre;

        $ok=array(['imagen añadida correctamente']);
        $imagen->save();

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
        
        $imagen=Imagenes::findOrFail($id);
        return response()->json($imagen);


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
        $comentario=Comentario::findOrFail($id);
        $imagen->delete();
        return response('200', 200);
        $ok =array("Se ha eliminado la imagen");
        return Response::make([
            'errors' => $ok
            ]);    

    }
}
