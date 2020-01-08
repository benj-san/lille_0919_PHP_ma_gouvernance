<?php

namespace App\Controller;

use App\Entity\Advisor;
use App\Entity\Board;
use App\Entity\Demand;
use App\Form\DemandType;
use App\Repository\AdvisorRepository;
use App\Repository\DemandRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/demands/", name="demands")
     * @param DemandRepository $demandRepository
     * @param TagRepository $tagRepository
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(
        DemandRepository $demandRepository,
        TagRepository $tagRepository,
        Request $request,
        EntityManagerInterface $entityManager
    ) {
        /* Changement de statut de la demande */
        if (isset($_POST['statutSubmitted'])) {
            $values = explode("-", $_POST['radio']);
            $demand = $demandRepository->findOneBy(['id' => $values[1]]);
            $demand->setStatus($values[0]);
            $entityManager->flush();
            return $this->redirectToRoute('demands');
        }
        $demands = $demandRepository ->findAll();
        $tags = $tagRepository->findAll();

        /* Création d'une demande */
        $demand = new Demand();
        $form = $this->createForm(DemandType::class, $demand);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $demand->setStatus(1);
            $board = new Board();
            $board->setDemand($demand);
            $entityManager->persist($demand);
            $entityManager->persist($board);
            $entityManager->flush();

            return $this->redirectToRoute('demands');
        }
        return $this->render('admin/demands.html.twig', [
            'demands'=>$demands,
            'tags' => $tags,
            'formDemand' =>$form->createView(),
        ]);
    }


    /**
     * @Route("/admin/advisors", name="advisors")
     * @param AdvisorRepository $advisorRepository
     * @return Response
     */
    public function advisor(AdvisorRepository $advisorRepository)
    {
        $advisors = $advisorRepository->findAll();
        return $this->render('admin/advisors.html.twig', [
            'advisors' => $advisors
        ]);
    }

    /**
     * @Route("/board", name="board")
     */
    public function board()
    {
        return $this->render('admin/constructBoard.html.twig');
    }
}
