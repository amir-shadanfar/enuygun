<?php

namespace App\Service\Algorithm;

class StrategyA implements Strategy
{
    protected $developers;
    protected $tasks;

    /**
     * StrategyA constructor.
     * @param array $developers
     * @param array $tasks
     */
    public function __construct(array $developers, array $tasks)
    {
        $this->developers = $developers;
        $this->tasks = $tasks;
    }

    /**
     * @param array $tasks
     * @param array $developers
     * @return float|int
     */
    public static function getMinimumDuration(array $developers, array $tasks)
    {
        $total_task_power = 0;
        foreach ($tasks as $task) {
            $total_task_power += $task->getDuration() * $task->getDifficulty();
        }
        $weekly_developers_power = 0;
        foreach ($developers as $dev) {
            $weekly_developers_power += $dev->getTaskDifficulty() * $dev->getTaskDuration() * 45;
        }
        $minimum_week = $total_task_power / $weekly_developers_power;
        return $minimum_week;
    }

    /**
     * @return array
     */
    public function doAlgorithm(): array
    {
        $result = [];
        $temp_developers = [];
        $used_tasks_index = [];
        $minimum_week = self::getMinimumDuration($this->developers, $this->tasks);
        $j = 0;
        foreach ($this->developers as $dev) {
            $temp_developers[$j]['info'] = $dev;
            $temp_developers[$j]['total_power'] = $dev->getTaskDifficulty() * $dev->getTaskDuration() * 45 * $minimum_week;
            $j++;
        }
        foreach ($temp_developers as $dev) {
            foreach ($this->tasks as $index => $task) {
                if (!in_array($index, $used_tasks_index)) {
                    if ($dev['total_power'] - $task->getDifficulty() > 0) {
                        $used_tasks_index[] = $index;
                        $result[$dev['info']->getId()][] = $task;
                        $dev['total_power'] -= $task->getDifficulty() * $task->getDuration();
                    }
                }
            }
        }
        return $result;
    }
}