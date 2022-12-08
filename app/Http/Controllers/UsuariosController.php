<?php

namespace App\Http\Controllers;

use App\Models\Aposta;

use App\Models\Jogo;
use App\Models\User;
use App\Models\Fligth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        $jogos = Jogo::all();
        $usuarios = User::all();
        return view('usuarios', ["jogos"=>$jogos, "users"=>$usuarios]);
    }

    public function show($id)
    {
        $usuario = User::find($id);
        return view('usuario', ["user"=>$usuario]);
    }
    
    public function update(Request $request, $id)
    {
        if(empty($request->delete)){

            $usuario = User::find($id);
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->save();

            return view('usuario', ["user"=>$usuario]);

        }else{

            $usuario = User::find($id);
            $usuario->delete();
            return view('usuario', ["user"=>$usuario]);
        }
     }
}
