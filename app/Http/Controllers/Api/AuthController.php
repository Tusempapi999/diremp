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
        'password' => 'required|string|min:5|confirmed', //confirmed tambien se usa esta para que se verifique el password en los archivos
        ]);

        //Resivimos como parametro request donde estan los datos del usuario
        $response = ["success" => false];//se crea la variable response, va a ser la respuesta retornada

        $input = $request->all();//Mete todos los datos de request en input
        $input["password"] = bcrypt($input['password']);//Busca password en los datos y encripta las contraseñas

        $user = User::create($input);//Toma el mdelo user y crea un nuevo registro en la db con los datos resividos
        $user->assignrole('admin');//le asigna el rol admin o client

        $response["success"] = true;//Ningun fallo
        //Se crea un token y se agrega a response para retornarlo al sistema
        
        $response["token"] = $user->createToken("auth_token")->plainTextToken;

        //Transforma rsponse en json y envia un codigo 200, que significa todo bien
        return response()->json($response, 200);
    }

    public function login(Request $request){//Funcion para el inicio de sesión de usuarios ya registrados

        //Validación
        $request->validate([
        'email'    => 'required|string|email|max:255',
        'password' => 'required|string|min:5', 
        ]);

        //Resivimos como parametro request donde estan los datos del usuario
        $response = ["success" => false];//se crea la variable response, va a ser la respuesta retornada

        if(auth()->attempt(['email'=> $request->email, 'password' => $request->password])){
            $user = auth()->user();
            $user->hasRole('client'); //add rol
            $response['token'] = $user->createToken("auth_token")->plainTextToken;
            $response['user'] = $user;
            $response['success'] = true;
        }
        return response()->json($response, 200);

    }

    public function logout(Request $request){//Funcion para el cierre de sesíon
        $response = ["success" => false];
        auth()->user()->tokens()->delete();
        $response = [
            "success" => true,
            "message" => "sesión cerrada"  
        ];
        return response()->json($response, 200);
    }
}
