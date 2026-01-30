<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){//función para mostrar la lista de usuarios
        $data = User::get(["id","name"]);//Obtine el id y nombre de cada usuario
        return response()->json($data, 200);
    }

    public function show($id){//función para mostrar un usuario
        $data = User::find($id);//Busca el usuario con ese id
        return response()->json($data, 200);
    }

    public function update(Request $request, $id){//función para actualizar un usuario
        $data = User::find($id);
        $data->fill($request->all());//Vacia toda la info del json enviado y lo acomoda en data, donde estan los datos del user
        $data->save();//Hace la actualización permanente
        return response()->json($data, 200);
    }
}
