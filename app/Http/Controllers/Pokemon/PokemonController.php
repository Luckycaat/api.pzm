<?php

namespace App\Http\Controllers\Pokemon;

use App\Models\Pokemon\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Http\Response as ResponseHttp;
use App\Lib\ResponseJson;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class PokemonController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->setDefaultRoutes($request);
        $data['collection'] = Pokemon::all()->sortByDesc('created_at');
        return view('index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $pokemonId)
    {
        try {
            $this->business->update($request, $pokemonId);
            $jsonResponse = new ResponseJson(
                type: true,
                message: 'Apelido atualiazado com sucesso!',
                code: ResponseHttp::HTTP_OK,
            );
            return $jsonResponse->getResponse();
        } catch (ValidationException $ex) {
            $jsonResponse = new ResponseJson(
                type: false,
                message: 'Ops... , não foi possível atualizar o nome do Pokémon',
                code: ResponseHttp::HTTP_ACCEPTED,
                result: $ex->errors()
            );
            return $jsonResponse->getResponse();
        }
    }

    public function generate(Request $request)
    {
        try {
            $pokemon = $this->business->getRandonPokemon();
            $this->business->savePokemonInPokedex($pokemon);
            $jsonResponse = new ResponseJson(
                type: true,
                message: 'Um Pokémon misterioso foi encontrado!',
                code: ResponseHttp::HTTP_OK,
                result: [
                    'reloadPage' => true,
                    'pokemon' => $pokemon,
                    'btnText' => 'Adicionar à PokeDex'
                ],
            );
            return $jsonResponse->getResponse();
        } catch (ValidationException  $ex) {
            $jsonResponse = new ResponseJson(
                type: false,
                message: 'Ops... , não foi possível encontrar nenhum Pokémon nessa região',
                code: ResponseHttp::HTTP_ACCEPTED,
                result: $ex->errors()
            );
            return $jsonResponse->getResponse();
        }
    }

    private function setDefaultRoutes()
    {
        $data = [
            'parametersJs' => [
                'routes' => [
                    'create' => route('pokemon.create'),
                    'update' => route('pokemon.update', ['pokemon' => '[POKEMON_ID]']),
                    'generate' => route('pokemon.generate')
                ]
            ]
        ];
        return $data;
    }
}
