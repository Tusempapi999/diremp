<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str; //Tratamiento de cadenas
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function index(){//función para mostrar la lista de Empresas
        $data = Empresa::orderBy("orden")->get(["id","nombre"]);//Obtine el id y nombre de cada Empresa, las ordena por orden
        return response()->json($data, 200);
    }

    public function store(Request $request){ //Guardar una empresa
        $data = new Empresa($request->all());
        //upload image base 64
        if($request->urlfoto){
            $img = $request->urlfoto;
            //proceso
            $folderPath = "/img/empresa/";
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . Str::slug($request->nombre) . '.' .$image_type;
            file_put_contents(public_path($file), $image_base64);

            $data->urlfoto = Str::slug($request->nombre) . '.' .$image_type;
        }

        $data->save();
        return response()->json($data, 200);
    }

    public function show($id){//función para mostrar una Empresa
        $data = Empresa::find($id);//Busca la Empresa con ese id
        return response()->json($data, 200);
    }

    public function update(Request $request, $id){//función para actualizar una Empresa
        $data = Empresa::find($id);
        $data->fill($request->all());//Vacia toda la info del json enviado y lo acomoda en data, donde estan los datos de la Empresa

        if($request->urlfoto){
            $img = $request->urlfoto;
            //proceso
            $folderPath = "/img/empresa/";
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . Str::slug($request->nombre) . '.' .$image_type;
            file_put_contents(public_path($file), $image_base64);

            $data->urlfoto = Str::slug($request->nombre) . '.' .$image_type;
        }

        $data->save();//Hace la actualización permanente
        return response()->json($data, 200);
    }

    public function destroy($id){ //Elimina una empresa
        $data = Empresa::find($id);
        $data->delete();
        return response()->json("Empresa borrada", 200);
    }
}
