<?php


namespace App\Controller;

use App\Entity\Advisor;
use App\Form\AdvisorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvisorController extends AbstractController
{
    /**
     * @Route("/candidature", name="advisor")
     * @return Response
     */

    public function candidature() : Response
    {
        $advisor = new Advisor();



        return $this->render('formAdvisor/formAdvisor.html.twig', [
        ]);
    }
}
