<?php

namespace App\Service\Operation;

use App\Entity\Developer;
use App\Entity\Task;
use App\Service\Algorithm\Algorithm;
use App\Service\Algorithm\StrategyA;
use App\Service\DataProvider\DataProviderFactory;
use Symfony\Component\Console\Helper\ProgressBar;

class ApiFetchFacade
{
    protected $doctrine;
    protected $dataProvider;
    protected $algorithm;
    protected $progressBar;

    /**
     * ApiFetchFacade constructor.
     * @param $doctrine
     * @param DataProviderFactory $dataProvider
     * @param ProgressBar $progressBar
     */
    public function __construct($doctrine, DataProviderFactory $dataProvider, ProgressBar $progressBar)
    {
        $this->doctrine = $doctrine;
        $this->dataProvider = $dataProvider;
        $this->progressBar = $progressBar;
    }

    public function doSteps()
    {
        // 1.read data------------------------------------
        $this->progressBar->advance();
        $tasks = $this->dataProvider->getData();
        // 2.save tasks on database-----------------------
        $this->progressBar->advance();
        foreach ($tasks as $row) {
            $task = new Task();
            $task->setTitle($row['title']);
            $task->setDifficulty($row['difficulty']);
            $task->setDuration($row['duration']);
            $this->doctrine->getManager()->persist($task);
        }
        $this->doctrine->getManager()->flush();
        // 3.solve algorithm with strategyA---------------
        $this->progressBar->advance();
        $developers = $this->doctrine->getRepository(Developer::class)->findAll();
        $tasks = $this->doctrine->getRepository(Task::class)->findAll();
        $strategy = new StrategyA($developers, $tasks);
        $this->algorithm = new Algorithm($strategy);
        $result = $this->algorithm->solve();
        // 4.save data on pivot table---------------------
        $this->progressBar->advance();
        foreach ($result as $devId => $tasks) {
            $developer = $this->doctrine->getRepository(Developer::class)->find($devId);
            foreach ($tasks as $task) {
                $developer->addTask($task);
            }
            $this->doctrine->getManager()->flush();
        }
    }
}