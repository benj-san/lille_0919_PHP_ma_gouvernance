<?php


namespace App\Controller;

use App\Entity\Advisor;
use App\Form\AdvisorType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvisorController extends AbstractController
{
    /**
     * @Route("/candidature", name="advisor")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     * @throws \Exception
     */

    public function candidature(EntityManagerInterface $em, Request $request) : Response
    {
        $advisor = new Advisor();
        $form = $this->createForm(AdvisorType::class, $advisor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new DateTime('now');
            $advisor->setSubmissionDate($date);
            $em->persist($advisor);
            $em->flush();
            return $this->redirect('http://www.magouvernance.com');
        }
        return $this->render('formAdvisor/formAdvisor.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
