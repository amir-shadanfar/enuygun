<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeveloperRepository")
 */
class Developer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Task", inversedBy="developers")
     */
    private $tasks;

    /**
     * @ORM\Column(type="smallint")
     */
    private $task_difficulty;

    /**
     * @ORM\Column(type="smallint")
     */
    private $task_duration;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->contains($task)) {
            $this->tasks->removeElement($task);
        }

        return $this;
    }

    public function getTaskDifficulty(): ?int
    {
        return $this->task_difficulty;
    }

    public function setTaskDifficulty(int $task_difficulty): self
    {
        $this->task_difficulty = $task_difficulty;

        return $this;
    }

    public function getTaskDuration(): ?int
    {
        return $this->task_duration;
    }

    public function setTaskDuration(int $task_duration): self
    {
        $this->task_duration = $task_duration;

        return $this;
    }
}
