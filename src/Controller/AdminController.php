<?php

namespace App\Controller;

use App\Entity\Resume;
use App\Entity\Advisor;
use App\Entity\Board;
use App\Form\AdvisorEditType;
use App\Form\AdvisorType;
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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Profiler\Profiler;

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
     * @param Profiler|null $profiler
     * @return Response
     */
    public function index(
        DemandRepository $demandRepository,
        TagRepository $tagRepository,
        Request $request,
        EntityManagerInterface $entityManager,
        ?Profiler $profiler
    ): Response {
        if (null !== $profiler) {
            $profiler->disable();
        }        /* Changement de statut de la demande */
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
            $demand->setStatus(0);
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
     * @param Profiler|null $profiler
     * @return Response
     */
    public function advisor(
        AdvisorRepository $advisorRepository,
        EntityManagerInterface $entityManager,
        ?Profiler $profiler
    ): Response {
        if (null !== $profiler) {
            $profiler->disable();
        }
        if (isset($_POST['commentChanged'])) {
            $advisor = $advisorRepository->findOneBy(['id' => $_POST['advisorId']]);
            $advisor->setCommentary($_POST['commentaryAdvisor']);
            $entityManager->flush();
        }
        if (isset($_POST['statusChange'])) {
            $values = explode('-', $_POST['radio']);
            $advisor = $advisorRepository->findOneBy(['id' => $values[1]]);
            $advisor->setStatus($values[0]);
            $entityManager->flush();
            return $this->redirectToRoute('advisors');
        }

        if (isset($_GET['filter'])) {
            switch ($_GET['filter']) {
                case 'inscription':
                    $advisors = $advisorRepository->findBy(array('status' => 0), array('name' => 'ASC'));
                    break;
                case 'validation':
                    $advisors = $advisorRepository->findBy(array('status' => 1), array('name' => 'ASC'));
                    break;
                case 'valide':
                    $advisors = $advisorRepository->findBy(array('status' => 2), array('name' => 'ASC'));
                    break;
                case 'ensuspens':
                    $advisors = $advisorRepository->findBy(array('status' => 3), array('name' => 'ASC'));
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
            'commentary' => 'commentary'
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
     * @param Profiler|null $profiler
     * @return Response
     */
    public function board(
        AdvisorRepository $advisorRepository,
        Board $board,
        Request $request,
        ResumeRepository $resumeRepository,
        EntityManagerInterface $entityManager,
        DemandRepository $demandRepository,
        ?Profiler $profiler
    ): Response {
        if (null !== $profiler) {
            $profiler->disable();
        }        if (isset($_POST['commentChanged'])) {
            $advisor = $advisorRepository->findOneBy(['id' => $_POST['advisorId']]);
            $advisor->setCommentary($_POST['commentaryAdvisor']);
            $entityManager->flush();
        }

        $demand = $board->getDemand();
        $resumes = $resumeRepository->findBy(['demand'=>$demand]);
        $advisor = $advisorRepository->findBy(['status' => 2]);
        $demand = $demandRepository->findOneBy(['id' => $board->getDemand()]);
        $tags = $demand->getTags()->getValues();

        $advisorsArray = [];
        foreach ($advisor as $i => $iValue) {
            $matches = 0;
            $advisorsTags = $iValue->getTags()->getValues();
            foreach ($tags as $jValue) {
                foreach ($advisorsTags as $kValue) {
                    if ($kValue === $jValue) {
                        $matches++;
                    }
                }
            }
            $advisorAndSum = [$matches => $advisor[$i]];
            $advisorsArray[] = $advisorAndSum;
        }

        foreach ($advisorsArray as $i => $iValue) {
            $total2 = count($advisorsArray);
            for ($j = 0 + $i; $j < $total2; $j++) {
                if (key($iValue) < key($advisorsArray[$j])) {
                    $temporary = $advisorsArray[$j];
                    $advisorsArray[$j] = $advisorsArray[$i];
                    $advisorsArray[$i] = $temporary;
                }
            }
        }

        $allAdvisorsSorted = [];
        $limit = 0;
        foreach ($advisorsArray as $advisor => $data) {
            foreach ($data as $matches => $advisor) {
                $limit ++;
                if ($limit < 10) {
                    $allAdvisorsSorted[] = $advisor;
                }
            }
        }

        $allAdvisorsRest = [];
        $limit = 0;
        foreach ($advisorsArray as $advisor => $data) {
            foreach ($data as $matches => $advisor) {
                $limit ++;
                if ($limit >= 10) {
                    $allAdvisorsRest[] = $advisor;
                }
            }
        }

        $form = $this->createForm(BoardType::class, $board);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('demands');
        }
        $totalAdvisorsRest = count($allAdvisorsRest);
        $advisors = $allAdvisorsSorted;
        for ($i = 0; $i< $totalAdvisorsRest; $i++) {
            $advisors[] = $allAdvisorsRest[$i];
        }
        return $this->render('admin/constructBoard.html.twig', [
            'advisorsSorted' => $allAdvisorsSorted,
            'formBoard' => $form->createView(),
            'board' => $board,
            'resumes' => $resumes,
            'advisors' => $advisors,
            'commentary' => 'commentary',
            'advisorsRest' => $allAdvisorsRest
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

    /**
     * @Route("admin/editAdvisor/{uuid}", name="editAdvisor")
     * @param Advisor $advisor
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Profiler|null $profiler
     * @return Response
     */
    public function editAdvisor(
        Advisor $advisor,
        Request $request,
        EntityManagerInterface $em,
        ?Profiler $profiler
    ) {
        if (null !== $profiler) {
            $profiler->disable();
        }
        $form = $this->createForm(AdvisorEditType::class, $advisor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tagsForm = $form->getData()->getTags()->getValues();
            $tagsAdvisor = $advisor->getTags();
            $totalForm = count($tagsForm);
            $totalAdvisor = count($tagsAdvisor);

            for ($i = 0; $i < $totalForm; $i++) {
                $tagsAdvisor = $advisor->getTags();
                $state = false;
                for ($j = 0; $j < $totalAdvisor; $j++) {
                    if ($tagsForm[$i] === $tagsAdvisor[$j]) {
                        $state = true;
                    }
                }
                if ($state === false) {
                    $advisor->addTag($tagsForm[$i]);
                }
            }

            for ($i = 0; $i < $totalAdvisor; $i++) {
                $state = true;
                for ($j = 0; $j < $totalForm; $j++) {
                    if ($tagsForm[$j] === $tagsAdvisor[$i]) {
                        $state = false;
                    }
                }
                if ($state === true) {
                    $advisor->removeTag($tagsAdvisor[$i]);
                }
            }


            $em->flush();
            return $this->redirectToRoute('advisors');
        }
        return $this->render(
            'admin/editAdvisor.html.twig',
            [
                'advisor' => $advisor,
                'form' => $form->createView()
            ]
        );
    }
      
    /**
     * @Route("admin/deleteDemand/{id}", name="deleteDemand")
     * @param Demand $demand
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function deleteDemand(Demand $demand, EntityManagerInterface $em) : Response
    {
        $tags = $demand->getTags()->getValues();
        $boards = $demand->getBoards()->getValues();

        $totalTags = count($tags);
        for ($i = 0; $i<$totalTags; $i++) {
            $demand->removeTag($tags[$i]);
        }

        $resumes = $demand->getResumes();
        $totalResumes = count($resumes);

        for ($i = 0; $i<$totalResumes; $i++) {
            $em->remove($resumes[$i]);
        }

        $totalBoards = count($boards);

        for ($i = 0; $i<$totalBoards; $i++) {
            $advisors = $boards[$i]->getAdvisors()->getValues();
            $totalAdvisors = count($advisors);

            for ($j = 0; $j<$totalAdvisors; $j++) {
                $boards[$i]->removeAdvisor($advisors[$j]);
            }
            $em->remove($boards[$i]);
        }
        $em->remove($demand);
        $em->flush();
        return $this->redirectToRoute('demands');
    }
}
