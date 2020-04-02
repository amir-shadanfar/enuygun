<?php

namespace App\Service\DataProvider;

class DataProviderTwo extends DataProviderFactory
{
    public function __construct()
    {
        //
    }

    public function getDataProvider(): DataProviderConnector
    {
        // TODO: Implement getDataProvider() method.
        return new DataReaderTwoConnector();
    }
}