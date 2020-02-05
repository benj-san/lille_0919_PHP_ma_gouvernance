<?php

namespace App\Controller;

use App\Entity\Advisor;
use App\Form\AdvisorType;
use App\Repository\AdvisorRepository;
use App\Repository\TagRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use LinkedIn\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use LinkedIn\Client;
use LinkedIn\Scope;

/**
 * @Route("/advisor")
 * @return Response
 * @throws Exception
 */


class AdvisorController extends AbstractController
{
    /**
     * @Route("/candidature/{uuid}", name="candidature")
     * @ParamConverter("advisor", options={"mapping": {"uuid" : "uuid"}})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param TagRepository $tagRepository
     * @param MailerInterface $mailer
     * @param Advisor $advisor
     * @return Response
     * @throws TransportExceptionInterface
     */

    public function candidature(
        Advisor $advisor,
        EntityManagerInterface $em,
        Request $request,
        TagRepository $tagRepository,
        MailerInterface $mailer
    ): Response {

        $form = $this->createForm(AdvisorType::class, $advisor);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($advisor->getGouvernanceExperience() === true) {
                if ($form['tagsStatut']->getData()) {
                    $total = count($form['tagsStatut']->getData());
                    for ($i = 0; $i < $total; $i++) {
                        $tag = $form['tagsStatut']->getData()[$i];
                        $advisor->addTag($tag);
                    }
                }
            }

            if ($form['tagsActualFunction']->getData()) {
                $total = count($form['tagsActualFunction']->getData());
                for ($i = 0; $i < $total; $i++) {
                    $tag = $form['tagsActualFunction']->getData()[$i];
                    $advisor->addTag($tag);
                }
            }

            if ($form['tagsCertificate']->getData()) {
                $total = count($form['tagsCertificate']->getData());
                for ($i = 0; $i < $total; $i++) {
                    $tag = $form['tagsCertificate']->getData()[$i];
                    $advisor->addTag($tag);
                }
            }

            if ($form['tagsExpertises']->getData()) {
                $total = count($form['tagsExpertises']->getData());
                for ($i = 0; $i < $total; $i++) {
                    $tag = $form['tagsExpertises']->getData()[$i];
                    $advisor->addTag($tag);
                }
            }

            if ($form['tagsCompetences']->getData()) {
                $total = count($form['tagsCompetences']->getData());
                for ($i = 0; $i < $total; $i++) {
                    $tag = $form['tagsCompetences']->getData()[$i];
                    $advisor->addTag($tag);
                }
            }

            if ($form['tagsContexts']->getData()) {
                $total = count($form['tagsContexts']->getData());
                for ($i = 0; $i < $total; $i++) {
                    $tag = $form['tagsContexts']->getData()[$i];
                    $advisor->addTag($tag);
                }
            }

            $email = (new TemplatedEmail())
                ->from(Address::fromString('MaGouvernance <remimayeux@gmail.com>'))
                ->to('remimayeux@gmail.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Inscription d\'un nouvel advisor')
                ->htmlTemplate('emails/mailAdmin.html.twig')
                ->context([
                    'form' => $form
                ]);


            $mailer->send($email);

            $email2 = (new TemplatedEmail())
                ->from(Address::fromString('MaGouvernance <remimayeux@gmail.com>'))
                ->to($form['email']->getData())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Merci pour votre candidature !')
                ->htmlTemplate('emails/mailAdvisor.html.twig')
                ->context([
                    'advisor' => $advisor
                ]);

            $mailer->send($email2);

            $date = new DateTime('now');
            $advisor->setStatus(1);
            $advisor->setSubmissionDate($date);
            $linkedin = substr($advisor->getLinkedin(), 0, 3);
            if ($linkedin === "www") {
                $advisor->setLinkedin("http://" . $advisor->getLinkedin());
            }

            $em->flush();
            return $this->redirectToRoute('statut', [
                'uuid' => $advisor->getUuid()
            ]);
        }
        return $this->render('formAdvisor/formAdvisor.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/linkedin", name="linkedin_connect")
     * @param EntityManagerInterface $em
     * @param AdvisorRepository $advisorRepository
     * @return Response
     * @throws Exception
     */
    public function index(EntityManagerInterface $em, AdvisorRepository $advisorRepository): Response
    {
        $client = new Client(
            $_ENV['OAUTH_LINKEDIN_ID'],
            $_ENV['OAUTH_LINKEDIN_SECRET']
        );

        $client->setRedirectUrl($_ENV['REDIRECT_URI']);
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
            $profilePicture =
                $imageArray['profilePicture']['displayImage~']['elements'][3]['identifiers'][0]['identifier'];
            $advisor = $advisorRepository->findOneBy(['email'=>$email]);
            if ($advisor === null) {
                $advisor = new Advisor();
                $advisor->setEmail($email);
                $advisor->setFirstname($firstname);
                $advisor->setName($lastName);
                $advisor->setPicture($profilePicture);
                $uuid = uuid_create(UUID_TYPE_RANDOM);
                $advisor->setUuid($uuid);
                $advisor->setStatus(0);
                $em->persist($advisor);
                $em->flush();
                $uuidAdvisor = $advisor->getUuid();
                return $this->redirectToRoute('candidature', ['uuid' => $uuidAdvisor]);
            }
            $uuidAdvisor = $advisor->getUuid();
            if ($advisor->getStatus() !== 0) {
                return $this->redirectToRoute('statut', [
                    'uuid' => $uuidAdvisor
                ]);
            }

            return $this->redirectToRoute('candidature', ['uuid' => $uuidAdvisor]);
        }
        return $this->render('advisor/advisor.html.twig', [
            'login_url' => $loginUrl
        ]);
    }

    /**
     * @Route("/statut/{uuid}", name="statut")
     * @param Advisor $advisor
     * @return Response
     */
    public function advisorStatut(Advisor $advisor)
    {
        return $this->render('advisor/advisorStatut.html.twig', [
            'advisor' => $advisor]);
    }
}
