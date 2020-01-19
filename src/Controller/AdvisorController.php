<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// import client class
use LinkedIn\Client;

class AdvisorController extends AbstractController
{
    /**
     * @Route("/advisor", name="advisor")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('advisor/advisor.html.twig', [
        ]);

        // instantiate the Linkedin client
        $client = new Client(
            '86z6naqd76gryg',
            'rTQu4n1L70glQ78d'
        );
        $redirectUrl = $client->getRedirectUrl();
        $client->setRedirectUrl('http://magouvernance.fr/');
    }
}
