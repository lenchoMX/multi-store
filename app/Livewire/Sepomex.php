<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Sepomex extends Component
{
    public $posts;
    public $states;
    public $searchTerm;

    public function render()
    {
        return view('livewire.sepomex');
    }

    public function mount()
    {
        /* $response = Http::retry(10, 500)
            ->withToken(env('UC_API_TOKEN'))
            ->withOptions(['verify' => true])
            ->get(env('UC_API_SM_URL') . '09850')
            ->json(); */
        $this->posts = ['status' => 404];
    }

    public function search()
    {
        if (strlen($this->searchTerm) == 5) {
            $response = Http::retry(10, 500)
                ->withToken(env('API_SEPOMEX_TOKEN'))
                ->withOptions(['verify' => true])
                ->get(env('API_SEPOMEX_URL') . $this->searchTerm)
                ->json();

            // dd($response);

            if ($response['status'] == 200) {

                $townships = [];
                $cities = [];
                $states = [];
                $status = ['status' => 200];

                foreach ($response['data'] as $data) {
                    array_push($townships, ['township' => $data['township'], 'township_id' =>  $data['id']]);
                    array_push($cities, ['city' => $data['city'], 'city_id' => $data['city_id']]);
                    array_push($states, ['state' => $data['state'], 'state_id' => $data['state_id']]);
                }

                if (count($townships) > 0) {
                    $townships_array = ['townships' => $townships];
                    $cities_array = ['cities' => array_unique($cities, SORT_REGULAR)];
                    $states_array = ['states' => array_unique($states, SORT_REGULAR)];
                }

                $resultado = array_merge($status, $states_array, $cities_array, $townships_array);
                // dd($resultado);
                $this->posts = $resultado;

            } else {

                $this->posts = ['status' => 404];

            }
        }
    }
}
