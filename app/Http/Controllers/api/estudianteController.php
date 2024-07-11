<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class estudianteController extends Controller
{

    public function index()
    {
        $estudiantes =  Estudiante::all();
        $data = [
            'estudiantes' => $estudiantes,
            'status' => 200
        ];
        return response()->json($data, 200);
    }


    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'email' => 'required|email|unique:estudiante',
            'telefono' => 'required|digits:10',
            'lenguaje' => 'required|in:Ingles,Frances,Aleman,Español',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $estudiante = Estudiante::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'lenguaje' => $request->lenguaje
        ]);

        if (!$estudiante) {
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'estudiante' => $estudiante,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'Estudiante' => $estudiante,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $estudiante->delete();

        $data = [
            'message' => 'Estudiante eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);



        if (!$estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'email' => 'required|email',
            'telefono' => 'required|digits:10',
            'lenguaje' => 'required|in:Ingles,Frances,Aleman,Español',
        ]);


        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 404);
        }


        $estudiante->nombre = $request->nombre;
        $estudiante->email = $request->email;
        $estudiante->telefono = $request->telefono;
        $estudiante->lenguaje = $request->lenguaje;
        $estudiante->save();

        $data = [
            'message' => 'Estudiante actualizado correctamente',
            'estudiante' => $estudiante,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {

        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'max:255',
            'email' => 'email|',
            'telefono' => 'digits:10',
            'lenguaje' => 'in:Ingles,Español,Aleman,Frances'
        ]);

        if (!$validator) {
            $data = [
                'message' => 'Error en la validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        if ($request->has('nombre')) {
            $estudiante->nombre = $request->nombre;
        }

        if ($request->has('email')) {
            $estudiante->email = $request->email;
        }

        if ($request->has('telefono')) {
            $estudiante->telefono = $request->telefono;;
        }

        if ($request->has('lenguaje')) {
            $estudiante->lenguaje = $request->lenguaje;
        }

        $estudiante->save();

        $data = [
            'message' => 'Estudiante actualizado correctamente',
            'estudiante' => $estudiante,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
