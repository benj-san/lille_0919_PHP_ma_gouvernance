<?php

namespace App\Controller;

use App\Entity\Board;
use App\Repository\ResumeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @param Board $board
     * @param ResumeRepository $resumeRepository
     * @return Response
     * * @Route("suggestion/{uuid}", name="client_board")
     */

    public function board(Board $board, ResumeRepository $resumeRepository): Response
    {
        $demand = $board->getDemand();
        $resumes = $resumeRepository->findBy(['demand'=>$demand]);
        return $this->render('client/show.html.twig', [
            'board' => $board,
            'clientBoard' => 'clientBoard',
            'resumes' => $resumes
        ]);
    }
}
