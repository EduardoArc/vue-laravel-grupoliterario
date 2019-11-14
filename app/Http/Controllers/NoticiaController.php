<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Noticia;


class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return Noticia::orderBy('created_at', 'DESC')->get();
        }else{
            return view('home');
        }
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
        //TODO::Agregar validaciones

        $imagen = $request->file('imagen');
        $noticia = new Noticia();
        $noticia->imagen = $imagen->getClientOriginalName();
        $noticia->titulo = $request->titulo;
        $noticia->subtitulo = $request->subtitulo;
        $noticia->cuerpo = $request->cuerpo;
        $noticia->user_id = auth()->id();
        $noticia->save();

        //pide el (nombre, archivo)
        \Storage::disk('local')->put($imagen->getClientOriginalName(), \File::get($imagen));

        return $noticia;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('detalleNoticia',['id' => $id ]);
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
        //TODO::Validar y hacer bien el update men
        $imagen = $request->file('imagen');
        $noticia = Noticia::find($id);
        $noticia->imagen = $request->$imagen->getClientOriginalName();//tomar el nombre
        $noticia->titulo = $request->titulo;
        $noticia->subtitulo = $request->subtitulo;
        $noticia->cuerpo = $request->cuerpo;
        $noticia->save();
        return $noticia;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::find($id);
        $noticia->delete();
    }

    public function detalle($id){
        return response()->json([ 'noticia'=> Noticia::find($id)], 200);
    }

    public function obtenerImagen($nombre){


        $imagen = \Storage::disk('local')->get($nombre);
        return response($imagen, 200);
    }


}
