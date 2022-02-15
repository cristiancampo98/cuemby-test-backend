<?php

namespace App\Services;

use App\Repositories\PlayerRepository;
use Illuminate\Support\Facades\Http;

class SportService
{
    private $url;
    protected $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->url = 'https://www.easports.com/fifa/ultimate-team/api/fut/item';
        $this->playerRepository = $playerRepository;
    }

    public function handler($page = null)
    {
        $path = $this->url;
        if ($page) {
            $path = $path . '?page=' . $page;
        }
        $response = Http::get($path);
        return $response;
    }

    public function getDataSport($page = null, $key = null)
    {
        $response = $this->handler($page);
        return $response->json($key);
    }

    public function getTotalPages()
    {
        $response = $this->handler();
        return $response->json('totalPages');
    }

    public function formatResponse($items)
    {
        foreach ($items as $player) {
            $data = [
                'name' => $player['name'],
                'position' => $player['positionFull'],
                'nation' => $player['nation']['name'],
                'club' => $player['club']['name']
            ];
            $this->playerRepository->updateOrCreate($data);
        }
    }

    public function getAllDataSportAndFormat()
    {
        /***
         * La variable $totalPages es la n página del api pero
         * hacer toda esa iteración tomaria demasiado tiempo
         * var $totalPages = $this->getTotalPages();
         */
        for ($i = 1; $i <= 25; $i++) {
            $items = $this->getDataSport($i, 'items');
            $this->formatResponse($items);
        }
        return $this->playerRepository->getAll();
    }
}
