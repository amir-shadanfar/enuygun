<?php

namespace App\Service\DataProvider;

abstract class DataFormat
{
    abstract public function output(array $data): array;
}