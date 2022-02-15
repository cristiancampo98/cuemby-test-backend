<?php

namespace App\Services;

use App\Repositories\PlayerRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class PlayerService
{

    protected $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function getTeam($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
        return $this->playerRepository->getTeam($request->name);
    }

    public function getPlayers($request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $this->playerRepository->getPlayers($request);
    }
}
