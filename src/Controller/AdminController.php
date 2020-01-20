<?php

namespace App\Controller;

use App\Entity\Resume;
use App\Entity\Advisor;
use App\Entity\Board;
use App\Entity\Demand;
use App\Form\BoardType;
use App\Form\DemandType;
use App\Repository\AdvisorRepository;
use App\Repository\DemandRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
    ): Response {
        /* Changement de statut de la demande */
        if (isset($_POST['statutSubmitted'])) {
            $values = explode('-', $_POST['radio']);
            $demand = $demandRepository->findOneBy(['id' => $values[1]]);
            $demand->setStatus($values[0]);
            $entityManager->flush();
            return $this->redirectToRoute('demands');
        }

        if (isset($_GET['filter'])) {
            switch ($_GET['filter']) {
                case 'proposé':
                    $demands = $demandRepository->findBy(array('status' => 1), array('deadline' => 'ASC'));
                    break;
                case 'modifier':
                    $demands = $demandRepository->findBy(array('status' => 0), array('deadline' => 'ASC'));
                    break;
                case 'accepté':
                    $demands = $demandRepository->findBy(array('status' => 2), array('deadline' => 'ASC'));
                    break;
                default:
                    $demands = $demandRepository->findBy(array('status' => array(0, 1)), array('deadline' => 'ASC'));
                    break;
            }
        } else {
            $demands = $demandRepository ->findBy(array('status' => array(0, 1)), array('deadline' => 'ASC'));
        }

        $tags = $tagRepository->findAll();
        /* Création d'une demande */
        $demand = new Demand();
        $form = $this->createForm(DemandType::class, $demand);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $demand->setStatus(1);
            $board = new Board();
            $board->setDemand($demand);
            $uuid = uuid_create(UUID_TYPE_RANDOM);
            $board->setUuid($uuid);
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
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function advisor(AdvisorRepository $advisorRepository, EntityManagerInterface $entityManager): Response
    {
        if (isset($_POST['commentChanged'])) {
            $advisor = $advisorRepository->findOneBy(['id' => $_POST['advisorId']]);
            $advisor->setCommentary($_POST['commentaryAdvisor']);
            $entityManager->flush();
        }
        $advisors = $advisorRepository->findAll();
        return $this->render('admin/advisors.html.twig', [
            'advisors' => $advisors,
            'pageAdvisor' => 'page advisor'
        ]);
    }

    /**
     * @Route("/board/{id}", name="board")
     * @param AdvisorRepository $advisorRepository
     * @param Board $board
     * @param Request $request
     * @return Response
     */
    public function board(AdvisorRepository $advisorRepository, Board $board, Request $request): Response
    {
        $advisor = $advisorRepository->findAll();
        $form = $this->createForm(BoardType::class, $board);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('demands');
        }
        return $this->render('admin/constructBoard.html.twig', [
            'advisors' => $advisor,
            'formBoard' => $form->createView(),
            'board' => $board,
        ]);
    }

    /**
     * @Route("/boardform/{board}/{advisor}", name="formBoard")
     * @param Advisor $advisor
     * @param Board $board
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function formBoard(Board $board, Advisor $advisor, EntityManagerInterface $entityManager): Response
    {
        $demand = $board->getDemand();
        $board->addAdvisor($advisor);
        $resume = new Resume();
        $boardId = $board->getId();
        $resume->setDemand($demand);
        $resume->setAdvisor($advisor);
        $resume->setContent($_POST['resume']);
        $entityManager->persist($resume);
        $entityManager->flush();
        return $this->redirectToRoute('board', [
            'id' => $boardId
        ]);
    }

    /**
     * @Route("deleteAdvisorFromBoard/{board}/{advisor}", name="deleteAdvisorFromBoard")
     * @param Board $board
     * @param Advisor $advisor
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function deleteAdvisorFromBoard(
        Board $board,
        Advisor $advisor,
        EntityManagerInterface $entityManager
    ): Response {
        $board->removeAdvisor($advisor);
        $boardId = $board->getId();
        $entityManager->flush();
        return $this->redirectToRoute('board', [
            'id' => $boardId
        ]);
    }
}
