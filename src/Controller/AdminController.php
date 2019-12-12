<?php

namespace App\Controller;

use App\Repository\AdvisorRepository;
use App\Repository\DemandRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @param AdvisorRepository $advisorRepository
     * @param DemandRepository $demandRepository
     * @param TagRepository $tagRepository
     * @return Response
     */
    public function index(
        AdvisorRepository $advisorRepository,
        DemandRepository $demandRepository,
        TagRepository $tagRepository
    ) {
        $demands = $demandRepository ->findAll();
        $advisors = $advisorRepository->findAll();
        $tags = $tagRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'advisors' => $advisors,
            'demands'=>$demands,
            'tags' => $tags,

        ]);
    }
}
