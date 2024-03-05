<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resena;

class ResenaController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
        $resena = Resena::create([
            'usuario_id' => $params['usuario_id'],
            'libro_id' => $params['libro_id'],
            'comentario' => $params['comentario'],
        ]);

        return $resena;
    }
    public function index(Request $request)
    {
        $params = $request->all();
        $size = isset($params['size']) ? $params['size'] : 5;

        $resenas = Resena::with('usuario')->where('usuario_id', $params['usuario_id'])
            ->limit($size)->get();
        $resenas = Resena::with('libro')->where('libro_id', $params['libro_id'])
            ->limit($size)->get();

        return $resenas;
    }
    public function show($id)
    {
        $resena = Resena::find($id);

        return $resena;
    }
    public function update($id, Request $request)
    {
        $params = $request->all();
        Resena::find($id)->update([
            'usuario_id' => $params['usuario_id'],
            'libro_id' => $params['libro_id'],
            'comentario' => $params['comentario'],
        ]);

        return 'Registro actualizado';
    }
    public function destroy($id)
    {
        Resena::find($id)->delete();

        return 'Registro eliminado';
    }
}
