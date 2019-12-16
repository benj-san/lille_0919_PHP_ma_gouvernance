<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FromAdvisorController extends AbstractController
{
    /**
     * @Route("/formAdvisor", name="advisor")
     * @return Response
     */

    public function advisor() : Response
    {
        return $this->render('formAdvisor/formAdvisor.html.twig', [
        ]);
    }
}
