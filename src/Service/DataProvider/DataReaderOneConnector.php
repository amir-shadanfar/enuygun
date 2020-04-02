<?php

namespace App\Service\DataProvider;

class DataReaderOneConnector extends DataFormat implements DataProviderConnector
{
    /**
     * @return array
     */
    public function readDataFromApi(): array
    {
        // TODO: Implement readDataFromApi() method.
        $json = file_get_contents('http://www.mocky.io/v2/5d47f24c330000623fa3ebfa');
        $data = json_decode($json, true);
        return $this->output($data);
    }

    /**
     * @param array $data
     * @return array
     */
    public function output(array $data): array
    {
        // TODO: Implement output() method.
        $result = [];
        foreach ($data as $row) {
            $result[] = [
                'title'      => $row['id'],
                'difficulty' => $row['zorluk'],
                'duration'   => $row['sure'],
            ];
        }
        return $result;
    }
}