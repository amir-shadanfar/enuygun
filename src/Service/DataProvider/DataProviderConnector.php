<?php

namespace App\Service\DataProvider;

interface DataProviderConnector
{
    public function readDataFromApi(): array;
}