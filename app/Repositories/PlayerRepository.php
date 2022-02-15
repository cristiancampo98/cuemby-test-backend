<?php

namespace App\Repositories;

use App\Models\Player;

class PlayerRepository
{

    protected $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function updateOrCreate($data)
    {
        $result = $this->player::updateOrCreate(
            ['name' => $data['name'], 'nation' => $data['nation']],
            ['position' => $data['position'], 'club' => $data['club']]
        );

        return $result->fresh();
    }

    public function getAll()
    {
        return $this->player::all();
    }

    public function getTeam($value)
    {
        return $this->player::where('club', 'like', $value)->paginate(10);
    }

    public function getPlayers($request)
    {
        $result = $this->player::where('name', 'like', '%' . $request->search . '%');

        if ($request->filled('order')) {
            $result->orderBy('name', $request->order);
        } else {
            $result->orderBy('name', 'asc');
        }

        return $result->paginate(10);
    }
}
