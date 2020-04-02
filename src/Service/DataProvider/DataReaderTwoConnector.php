<?php

namespace App\Service\DataProvider;

class DataReaderTwoConnector extends DataFormat implements DataProviderConnector
{
    /**
     * @return array
     */
    public function readDataFromApi(): array
    {
        // TODO: Implement readDataFromApi() method.
        $json = file_get_contents('http://www.mocky.io/v2/5d47f235330000623fa3ebf7');
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
            foreach ($row as $title => $value) {
                $result[] = [
                    'title'      => $title,
                    'difficulty' => $value['level'],
                    'duration'   => $value['estimated_duration'],
                ];
            }
        }
        return $result;
    }
}