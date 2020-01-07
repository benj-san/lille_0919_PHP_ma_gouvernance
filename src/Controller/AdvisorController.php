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
     * @Route("/formAdvisor", name="advisor")
     * @return Response
     */

    public function advisor() : Response
    {
        $advisor = new Advisor();
        $form = $this->createForm(AdvisorType::class, $advisor);


        return $this->render('formAdvisor/formAdvisor.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
