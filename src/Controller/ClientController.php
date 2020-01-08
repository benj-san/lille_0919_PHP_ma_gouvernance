<?php

namespace App\Controller;

use App\Entity\Board;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     * @param Board $board
     * @return Response
     */
    public function index(Board $board): Response
    {

        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
            'board' => $board,
                    ]);
    }

    /**
     * @param Board $board
     * @return Response
     * * @Route("/client/board/{uuid}", name="client_board")
     */

    public function board(Board $board): Response
    {
        return $this->render('client/show.html.twig', ['board' => $board,
        'clientBoard' => 'clientBoard']);
    }
}
