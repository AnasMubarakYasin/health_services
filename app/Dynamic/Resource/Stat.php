<?php

namespace App\Dynamic\Resource;

class Stat extends Resource
{
    public string $name = "";
    public string $icon = "";

    public int $count_all = 0;
    public int $count_today = 0;
    public int $count_yesterday = 0;

    public function init(
        string $name,
        string $icon,
    ) {
        $this->name = $name;
        $this->icon = $icon;

        return $this;
    }

    public function resourcing(): Stat
    {
        $today = today()->setTime(0, 0);
        $yesterday = $today->subDay();
        $tomorrow = $today ->addDay();

        $this->count_today = $this->model::whereBetween('created_at', [$today, $tomorrow])->get()->count();
        $this->count_yesterday = $this->model::whereBetween('created_at', [$yesterday, $today])->get()->count();
        $this->count_all = $this->model::all()->count();

        return $this;
    }
}
