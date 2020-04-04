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

        return $this->render('home/index.html.twig', [
            'developers'       => $developers,
            'minimum_duration' => StrategyA::getMinimumDuration($developers, $tasks),
        ]);
    }
}

