<?php

namespace App\Controller;

use App\Entity\Demand;
use App\Form\DemandType;
use App\Repository\AdvisorRepository;
use App\Repository\DemandRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @param AdvisorRepository $advisorRepository
     * @param DemandRepository $demandRepository
     * @param TagRepository $tagRepository
     * @param Request $request
     * @return Response
     */
    public function index(
        AdvisorRepository $advisorRepository,
        DemandRepository $demandRepository,
        TagRepository $tagRepository,
        Request $request
    ) {
        $demands = $demandRepository ->findAll();
        $advisors = $advisorRepository->findAll();
        $tags = $tagRepository->findAll();

        $demand = new Demand();
        $form = $this->createForm(DemandType::class, $demand);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($demand);
            $entityManager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'advisors' => $advisors,
            'demands'=>$demands,
            'tags' => $tags,
            'formDemand' =>$form->createView()
        ]);
    }
}
