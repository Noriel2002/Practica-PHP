<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;

class AutorController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
        $autor = Autor::create([
            'nombre' => $params['nombre'],
            'libro_id' => $params['libro_id'],
        ]);

        return $autor;
    }
    public function index(Request $request)
    {
        $params = $request->all();
        $size = isset($params['size']) ? $params['size'] : 5;

        $autores = Autor::with('libro')->where('libro_id', $params['libro_id'])
            ->limit($size)->get();

        return $autores;
    }
    public function show($id)
    {
        $autor = Autor::find($id);

        return $autor;
    }
    public function update($id, Request $request)
    {
        $params = $request->all();
        Autor::find($id)->update([
            'nombre' => $params['nombre'],
            'libro_id' => $params['libro_id'],
        ]);

        return 'Registro actualizado';
    }
    public function destroy($id)
    {
        Autor::find($id)->delete();

        return 'Registro eliminado';
    }

}
