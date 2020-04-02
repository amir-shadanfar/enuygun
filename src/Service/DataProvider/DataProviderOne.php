<?php

namespace App\Service\DataProvider;

class DataProviderOne extends DataProviderFactory
{
    public function __construct()
    {
        //
    }

    public function getDataProvider(): DataProviderConnector
    {
        // TODO: Implement getDataProvider() method.
        return new DataReaderOneConnector();
    }
}