<?php

namespace App\Controller;

use App\Entity\Advisor;
use App\Repository\AdvisorRepository;
use App\Repository\BoardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    /**
     * @param $id
     * @param BoardRepository $boardRepository
     * @param AdvisorRepository $advisorRepository
     * @return Response
     * * @Route("/client/board/{id}", name="client_board")
     */

    public function board($id, BoardRepository $boardRepository): Response
    {
        $board = $boardRepository->findOneBy(['id' => $id]);
        return $this->render('client/show.html.twig', ['board' => $board]);
    }
}
