<?php

namespace App\Controller;

use App\Repository\AdvisorRepository;
use App\Repository\BoardRepository;
use App\Repository\DemandRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @return Response
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
        ]);
    }

    /**
     * @Route("/board", name="board")
     * @param AdvisorRepository $advisorRepository
     * @return Response
     */
    public function board(AdvisorRepository $advisorRepository)
    {
        $advisor = $advisorRepository->findAll();
        return $this->render('admin/constructBoard.html.twig', [
            'advisors' => $advisor,
        ]);
    }
}
