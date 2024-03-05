<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
        $usuario = Usuario::create([
            'nombre' => $params['nombre'],
            'apellido' => $params['apellido'],
            'celular' => $params['celular'],
            'libro_id' => $params['libro_id'],
            'resena_id' => $params['resena_id'],
        ]);

        return $usuario;
    }
    public function index(Request $request)
    {
        $params = $request->all();
        $size = isset($params['size']) ? $params['size'] : 5;

        $usuarios = Usuario::with('libro')->where('libro_id', $params['libro_id'])
            ->limit($size)->get();
        $usuarios = Usuario::with('resena')->where('resena_id', $params['resena_id'])
            ->limit($size)->get();

        return $usuarios;
    }
    public function show($id)
    {
        $usuario = Usuario::find($id);

        return $usuario;
    }
    public function update($id, Request $request)
    {
        $params = $request->all();
        Usuario::find($id)->update([
            'nombre' => $params['nombre'],
            'apellido' => $params['apellido'],
            'celular' => $params['celular'],
            'libro_id' => $params['libro_id'],
            'resena_id' => $params['resena_id'],
        ]);

        return 'Registro actualizado';
    }
    public function destroy($id)
    {
        Usuario::find($id)->delete();

        return 'Registro eliminado';
    }
}
