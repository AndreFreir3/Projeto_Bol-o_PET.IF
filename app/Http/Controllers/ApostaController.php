<?php

namespace App\Http\Controllers;

use App\Models\Aposta;
use Illuminate\Http\Request;
use App\Models\Jogo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ApostaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jogos = Jogo::paginate(3);
        $usuarios = User::all();
        $apostas = Aposta::where('user_id', Auth::user()->id)->orderBy("updated_at", "desc")->get();
        return view('apostas', ["jogos" => $jogos, "users"=>$usuarios, "apostas" => $apostas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Validator::make(
            $request->all(), [
            'palpite_1' => 'required|numeric',
            'palpite_2' => 'required|numeric',
        ],
        [
            'required' => 'O  campo :attribute é obrigatório.'
        ]
    )->validate();

            $aposta = Aposta::where('jogo_id', $request->id)->where('user_id', Auth::user()->id)->first();
            if ($aposta){
                $aposta->palpite_1 = $request->palpite_1;
                $aposta->palpite_2 = $request->palpite_2;
                $aposta->save();
            } else {
                $aposta = new Aposta();
                $aposta->jogo_id = $request->id;
                $aposta->user_id = Auth::user()->id;
                $aposta->palpite_1 = $request->palpite_1;
                $aposta->palpite_2 = $request->palpite_2;
                

            }
                $aposta->save();
        

        return back()->with("sucess", "Aposta Realizada com Sucesso!");


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aposta  $aposta
     * @return \Illuminate\Http\Response
     */
    public function show(Aposta $aposta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aposta  $aposta
     * @return \Illuminate\Http\Response
     */
    public function edit(Aposta $aposta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aposta  $aposta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'palpite_1' => 'required|numeric',
                'palpite_2' => 'required|numeric',
            ],
            [
                'required' => 'O campo :attribute é obrigatório.',
            ]
        )->validate();
        $aposta = Aposta::find($request->id);
        if($aposta){
        $aposta->palpite_1 = $request->palpite_1;
        $aposta->palpite_2 = $request->palpite_2;
        $aposta->save();
        }
        return back()->with("sucess", "Aposta atualizada com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aposta  $aposta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aposta $aposta)
    {
        $aposta->delete();
        return back()->with("sucess", "Aposta removida com sucesso");
    }
}
