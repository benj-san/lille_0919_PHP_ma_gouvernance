<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use LinkedIn\Client;
use LinkedIn\Scope;

class AdvisorController extends AbstractController
{
    /**
     * @Route("/advisor", name="advisor")
     * @return Response
     * @throws \LinkedIn\Exception
     */
    public function index(): Response
    {
        $client = new Client(
            $_ENV['OAUTH_LINKEDIN_ID'],
            $_ENV['OAUTH_LINKEDIN_SECRET']
        );
        $client->setRedirectUrl('https://127.0.0.1:8000/advisor');
        $scopes = [
            'r_liteprofile',
            SCOPE::READ_EMAIL_ADDRESS,
        ];


        $loginUrl = $client->getLoginUrl($scopes);
        if (isset($_GET['code'])) {
            $client->setApiRoot('https://api.linkedin.com/v2/');
            $accessToken = $client->getAccessToken($_GET['code']);
            $client->setAccessToken($accessToken);
            $imageArray = $client->get('me?projection=(profilePicture(displayImage~:playableStreams))');
            $profile = $client->get('me');
            $emailArray = $client->get('emailAddress?q=members&projection=(elements*(handle~))');
            $email = ($emailArray['elements'][0]['handle~']['emailAddress']);
            $firstname = $profile['localizedFirstName'];
            $lastName = $profile['localizedLastName'];
            $profilePicture = $imageArray['profilePicture']['displayImage~']['elements'][3]['identifiers'][0]['identifier'];
            dd($email,$firstname,$lastName,$profilePicture);
        }
        return $this->render('advisor/advisor.html.twig', [
            'login_url' => $loginUrl
        ]);

        // instantiate the Linkedin client
    }
}
