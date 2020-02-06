<?php

namespace App\Controller;

use App\Entity\Board;
use App\Repository\AdvisorRepository;
use App\Repository\ResumeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Profiler\Profiler;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @param Board $board
     * @param ResumeRepository $resumeRepository
     * @param AdvisorRepository $advisorRepository
     * @param Profiler $profiler
     * @return Response
     * * @Route("suggestion/{uuid}", name="client_board")
     */

    public function board(
        Board $board,
        ResumeRepository $resumeRepository,
        AdvisorRepository $advisorRepository,
        Profiler $profiler
    ): Response {
        if (null !== $profiler) {
            $profiler->disable();
        }
        $demand = $board->getDemand();
        $advisors = $advisorRepository->findByBoard($board);
        $resumes = $resumeRepository->findBy(['demand'=>$demand]);
        return $this->render('client/show.html.twig', [
            'board' => $board,
            'clientBoard' => 'clientBoard',
            'resumes' => $resumes,
            'advisors' => $advisors

        ]);
    }
}
