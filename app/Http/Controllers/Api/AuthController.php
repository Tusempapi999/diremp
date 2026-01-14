<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class AuthController extends Controller
{
    public function register(Request $request) { //Funcion para registrar un usuario y retornar un token
    
        //Validación
        $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users', //unique:users , busca users para que no haya dos ususarios con el mismo correo
        'password' => 'required|string|min:5', //confirmed tambien se usa esta para que se verifique el password en los archivos
        ]);

        //Resivimos como parametro request donde estan los datos del usuario
        $response = ["success" => "false"];//se crea la variable response, va a ser la respuesta retornada

        $input = $request->all();//Mete todos los datos de request en input
        $input["password"] = bcrypt($input['password']);//Busca password en los datos y encripta las contraseñas

        $user = User::create($input);//Toma el mdelo user y crea un nuevo registro en la db con los datos resividos
        $user->assignrole('admin');//le asigna el rol admin

        $response["success"] = true;//Ningun fallo
        //Se crea un token y se agrega a response para retornarlo al sistema
        $response["token"] = $user->createToken("boleto")->plainTextToken;

        //Transforma rsponse en json y envia un codigo 200, que significa todo bien
        return response()->json($response, 200);
    }
}
