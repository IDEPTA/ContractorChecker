<?php

namespace App\Contractors\Http\Builders\Sorts;

use App\Shared\Http\Builders\QuerySort;

class CounterpartySort extends QuerySort
{
    public function inn(string $inn): void
    {
        $this->builder->orderBy('inn', $inn);
    }

    public function ogrn(string $ogrn): void
    {
        $this->builder->orderBy('ogrn', $ogrn);
    }

    public function kpp(string $kpp): void
    {
        $this->builder->orderBy('kpp', $kpp);
    }

    public function full_name(string $full_name): void
    {
        $this->builder->orderBy('full_name', $full_name);
    }

    public function short_name(string $short_name): void
    {
        $this->builder->orderBy('short_name', $short_name);
    }

    public function status(string $status): void
    {
        $this->builder->orderBy('status', $status);
    }

    public function registration_date(string $registration_date): void
    {
        $this->builder->orderBy('registration_date', $registration_date);
    }

    public function liquidation_date(string $liquidation_date): void
    {
        $this->builder->orderBy('liquidation_date', $liquidation_date);
    }

    public function okved_main_code(string $okved_main_code): void
    {
        $this->builder->orderBy('okved_main_code', $okved_main_code);
    }
}
