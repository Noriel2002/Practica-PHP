<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibroController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
        $libro = Libro::create([
            'titulo' => $params['titulo'],
            'autor_id' => $params['autor_id'],
            'resena_id' => $params['resena_id'],
            'categoria_id' => $params['categoria_id'],
        ]);

        return $libro;
    }
    public function index(Request $request)
    {
        $params = $request->all();
        $size = isset($params['size']) ? $params['size'] : 5;

        $libros = Libro::with('autor')->where('autor_id', $params['autor_id'])
            ->limit($size)->get();
        $libros = Libro::with('resena')->where('resena_id', $params['resena_id'])
            ->limit($size)->get();
        $libros = Libro::with('categoria')->where('categoria_id', $params['categoria_id'])
            ->limit($size)->get();
        return $libros;
    }
    public function show($id)
    {
        $libro = Libro::find($id);

        return $libro;
    }
    public function update($id, Request $request)
    {
        $params = $request->all();
        Libro::find($id)->update([
            'titulo' => $params['titulo'],
            'autor_id' => $params['autor_id'],
            'resena_id' => $params['resena_id'],
            'categoria_id' => $params['categoria_id'],
        ]);

        return 'Registro actualizado';
    }
    public function destroy($id)
    {
        Libro::find($id)->delete();

        return 'Registro eliminado';
    }
}
