<?php

namespace App\Controller;

use App\Entity\Resume;
use App\Entity\Advisor;
use App\Entity\Board;
use App\Form\BoardType;
use App\Entity\Demand;
use App\Form\DemandType;
use App\Repository\AdvisorRepository;
use App\Repository\DemandRepository;
use App\Repository\ResumeRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */

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
                    $demands = $demandRepository->findBy(['status' => 1], ['deadline' => 'ASC']);
                    break;
                case 'modifier':
                    $demands = $demandRepository->findBy(['status' => 0], ['deadline' => 'ASC']);
                    break;
                case 'accepté':
                    $demands = $demandRepository->findBy(['status' => 2], ['deadline' => 'ASC']);
                    break;
                default:
                    $demands = $demandRepository->findBy(['status' => [0, 1]], ['deadline' => 'ASC']);
                    break;
            }
        } else {
            $demands = $demandRepository->findBy(['status' => [0, 1]], ['deadline' => 'ASC']);
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
            'demands' => $demands,
            'tags' => $tags,
            'formDemand' => $form->createView(),

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

        if (isset($_GET['filter'])) {
            switch ($_GET['filter']) {
                case 'encours':
                    $advisors = $advisorRepository->findBy(array('status' => 0));
                    break;
                case 'accepté':
                    $advisors = $advisorRepository->findBy(array('status' => 1));
                    break;
                case 'ensuspens':
                    $advisors = $advisorRepository->findBy(array('status' => 2));
                    break;
                default:
                    $advisors = $advisorRepository->findAll();
                    break;
            }
        } else {
            $advisors = $advisorRepository->findAll();
        }
        return $this->render('admin/advisors.html.twig', [
            'advisors' => $advisors,
            'pageAdvisor' => 'page advisor'
        ]);
    }

    /**
     * @Route("admin/board/{id}", name="board")
     * @param AdvisorRepository $advisorRepository
     * @param Board $board
     * @param Request $request
     * @param ResumeRepository $resumeRepository
     * @param EntityManagerInterface $entityManager
     * @param DemandRepository $demandRepository
     * @param ResumeRepository $resumeRepository
     * @return Response
     */
    public function board(
        AdvisorRepository $advisorRepository,
        Board $board,
        Request $request,
        ResumeRepository $resumeRepository,
        EntityManagerInterface $entityManager
        DemandRepository $demandRepository
        ResumeRepository $resumeRepository
    ): Response {

        if (isset($_POST['commentChanged'])) {
            $advisor = $advisorRepository->findOneBy(['id' => $_POST['advisorId']]);
            $advisor->setCommentary($_POST['commentaryAdvisor']);
            $entityManager->flush();
        }

        $advisor = $advisorRepository->findAll();
        $demand = $board->getDemand();
        $resumes = $resumeRepository->findBy(['demand'=>$demand]);

        $advisor = $advisorRepository->findAll();
        $demand = $demandRepository->findOneBy(['id' => $board->getDemand()]);
        $tags = $demand->getTags()->getValues();

        $advisorsArray = [];
        $totalAdvisors = count($advisor);
        for ($i = 0; $i < $totalAdvisors; $i++) {
            $matches = 0;
            $advisorsTags = $advisor[$i]->getTags()->getValues();
            $totalTags = count($tags);
            for ($j = 0; $j < $totalTags; $j++) {
                $totalTags2 = count($advisorsTags);
                for ($k = 0; $k < $totalTags2; $k++) {
                    if ($advisorsTags[$k] === $tags[$j]) {
                        $matches++;
                    }
                }
            }
            $advisorAndSum = [$matches => $advisor[$i]];
            array_push($advisorsArray, $advisorAndSum);
        }

        $total = count($advisorsArray);
        for ($i = 0; $i < $total; $i++) {
            $total2 = count($advisorsArray);
            for ($j = 0 + $i; $j < $total2; $j++) {
                if (key($advisorsArray[$i]) < key($advisorsArray[$j])) {
                    $temporary = $advisorsArray[$j];
                    $advisorsArray[$j] = $advisorsArray[$i];
                    $advisorsArray[$i] = $temporary;
                }
            }
        }


        $allAdvisorsSorted = [];
        foreach ($advisorsArray as $advisor => $data) {
            foreach ($data as $matches => $advisor) {
                array_push($allAdvisorsSorted, $advisor);
            }
        }



        $form = $this->createForm(BoardType::class, $board);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('demands');
        }
        $demand = $board->getDemand();
        $resume = $resumeRepository->findBy(['demand'=>$demand]);

        return $this->render('admin/constructBoard.html.twig', [
            'advisors' => $allAdvisorsSorted,
            'formBoard' => $form->createView(),
            'board' => $board,
            'resumes' => $resumes,
        ]);
    }

    /**
     * @Route("admin/boardform/{board}/{advisor}", name="formBoard")
     * @param Board $board
     * @param Advisor $advisor
     * @param EntityManagerInterface $entityManager
     * @param ResumeRepository $resumeRepository
     * @return Response
     */
    public function formBoard(
        Board $board,
        Advisor $advisor,
        EntityManagerInterface $entityManager,
        ResumeRepository $resumeRepository
    ): Response {
        $demand = $board->getDemand();
        $resumeForm = $resumeRepository->findOneBy(['demand'=>$demand, 'advisor'=>$advisor]);
        if ($resumeForm === null) {
            $resume = new Resume();
            $resume->setDemand($demand);
            $resume->setAdvisor($advisor);
            $resume->setContent($_POST['resume']);
            $board->addAdvisor($advisor);
            $entityManager->persist($resume);
            $entityManager->flush();
        } else {
            $resumeForm->setContent($_POST['resume']);
            $board->addAdvisor($advisor);
            $entityManager->persist($resumeForm);
            $entityManager->flush();
        }
        $boardId = $board->getId();
        return $this->redirectToRoute('board', [
            'id' => $boardId
        ]);
    }

    /**
     * @Route("admin/deleteAdvisorFromBoard/{board}/{advisor}", name="deleteAdvisorFromBoard")
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
