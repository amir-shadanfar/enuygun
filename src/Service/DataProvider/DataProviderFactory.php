<?php

namespace App\Service\DataProvider;

abstract class DataProviderFactory
{
    /**
     * @return DataProviderConnector
     */
    abstract public function getDataProvider(): DataProviderConnector;

    /**
     * @return mixed
     */
    public function getData(): array
    {
        $product = $this->getDataProvider();
        // result
        return $product->readDataFromApi();
    }
}