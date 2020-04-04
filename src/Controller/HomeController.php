<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Entity\Task;
use App\Service\Algorithm\StrategyA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $developers = $this->getDoctrine()->getRepository(Developer::class)->findAll();
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findAll();
        if (!$developers || !$tasks)
            throw new \Exception('You should run console command to continue!');

        $estimated_time = StrategyA::getMinimumDuration($developers, $tasks);

        return $this->render('home/index.html.twig', [
            'developers'       => $developers,
            'minimum_duration' => [
                'weeks' => round($estimated_time, 2),
                'days'  => round($estimated_time * 7, 2),
                'hours' => round($estimated_time * 7 * 24, 2),
            ],
        ]);
    }
}

