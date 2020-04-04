<?php

namespace App\Service\Algorithm;

class Algorithm
{
    private $strategy;

    /**
     * Algorithm constructor.
     * @param Strategy $strategy
     */
    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param Strategy $strategy
     */
    public function setStrategy(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @return array
     */
    public function solve(): array
    {
        return $this->strategy->doAlgorithm();
    }
}