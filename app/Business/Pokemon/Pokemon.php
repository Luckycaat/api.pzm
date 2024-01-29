<?php

namespace App\Business\Pokemon;

use App\Models\Pokemon\Pokemon as PokemonModel;
use Illuminate\Support\Facades\Http;

class Pokemon
{
    use \App\Business\Business;

    private $urlPokeApi = 'https://pokeapi.co/api/v2/pokemon/';

    public function __construct()
    {
        $this->repository = new PokemonModel();
    }

    public function getRandonPokemon(): array
    {
        $randonPokemonId = rand(1, 151);
        $response = Http::get($this->urlPokeApi . "/{$randonPokemonId}");
        return json_decode($response->body(), true);
    }

    public function update($request, $pokemonId)
    {
        $pokemon = $this->repository::find($pokemonId);
        $pokemon->name = $request->get('name');
        $pokemon->save();
    }

    public function savePokemonInPokedex($data)
    {
        $pokemonData = $this->prepareForDatabase($data);
        $newPokemon = $this->repository::create($pokemonData);
        $this->setPokemonTypes($newPokemon, $data['types']);
        $this->setPokemonStatus($newPokemon, $data['stats']);
        return $newPokemon;
    }

    private function prepareForDatabase($data)
    {
        return [
            'name' => $data['name'],
            'code' => $data['id'],
            'category' => 'Seed Pokemon',
            'main_ability' => $data['abilities'][0]['ability']['name'],
            'icon_link' => $data['sprites']['front_default'],
        ];
    }

    private function setPokemonTypes(PokemonModel $pokemon, array $types)
    {
        foreach ($types as $type) {
            $pokemon->types()->create(
                [
                    'name' => $type['type']['name']
                ]
            );
        }
    }

    private function setPokemonStatus(PokemonModel $pokemon, array $status)
    {
        $databaseStatus = [
            $status[0]['stat']['name'] => $status[0]['base_stat'],
            $status[1]['stat']['name'] => $status[1]['base_stat'],
            $status[2]['stat']['name'] => $status[2]['base_stat'],
            $status[5]['stat']['name'] => $status[5]['base_stat']
        ];
        $pokemon->status()->create($databaseStatus);
    }
}
