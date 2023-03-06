<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnosController extends Controller
{
    public function index() {
        $alumnos = Alumno::all();

        $argumentos = array();
        $argumentos['alumnos'] = $alumnos;

        return view ('alumnos.index',$argumentos);
    }

    public function create() {
        $argumentos = array();
            return view('alumnos.create', $argumentos);

    }

    public function store(Request $request) {
        $nuevoAlumno = new Alumno();
        //Las columnas de la tabla asociada
        //Se representan mediante propiedades del objeto
        $nuevoAlumno->nombre = $request->input('nombre');
        $nuevoAlumno->save();
        return redirect()->route('alumnos.index');

    }

//Estamos recibiendo parametros de ruta a traves de parametros de funcion
    public function edit($id) {
        $alumno = Alumno::find($id);
        $argumentos = array();
        $argumentos['alumno'] = $alumno;
        return view('alumnos.edit', $argumentos);
    }

    public function update(Request $request,$id) {
//Busca al alumno
        $alumno = Alumno::find($id);
//Actualiza sus datos en base a los valores del form
        $alumno->nombre = $request->input('nombre');
        $alumno->save();
        return redirect()->route('alumnos.edit',$id)
            ->with('exito', 'El alumno se ha actualizado exitosamente');
    }
}