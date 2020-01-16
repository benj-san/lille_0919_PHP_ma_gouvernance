<?php


namespace App\Controller;

use App\Entity\Advisor;
use App\Form\AdvisorType;
use App\Repository\TagRepository;
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
     * @param TagRepository $tagRepository
     * @return Response
     * @throws \Exception
     */

    public function candidature(EntityManagerInterface $em, Request $request, TagRepository $tagRepository) : Response
    {
        $advisor = new Advisor();
        $form = $this->createForm(AdvisorType::class, $advisor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($advisor->getGouvernanceExperience() === true) {
                if ($form['tagsStatut']->getData()) {
                    for ($i = 0; $i < count($form['tagsStatut']->getData()); $i++) {
                        $tag = $form['tagsStatut']->getData()[$i];
                        $advisor->addTag($tag);
                    }
                }
            }

            if ($form['tagsActualFunction']->getData()) {
                for ($i = 0; $i < count($form['tagsActualFunction']->getData()); $i++) {
                    $tag = $form['tagsActualFunction']->getData()[$i];
                    $advisor->addTag($tag);
                }
            }

            if ($form['tagsCertificate']->getData()) {
                for ($i = 0; $i < count($form['tagsCertificate']->getData()); $i++) {
                    $tag = $form['tagsCertificate']->getData()[$i];
                    $advisor->addTag($tag);
                }
            }

            if ($form['tagsExpertises']->getData()) {
                for ($i = 0; $i < count($form['tagsExpertises']->getData()); $i++) {
                    $tag = $form['tagsExpertises']->getData()[$i];
                    $advisor->addTag($tag);
                }
            }

            if ($form['tagsCompetences']->getData()) {
                for ($i = 0; $i < count($form['tagsCompetences']->getData()); $i++) {
                    $tag = $form['tagsCompetences']->getData()[$i];
                    $advisor->addTag($tag);
                }
            }

            if ($form['tagsContexts']->getData()) {
                for ($i = 0; $i < count($form['tagsContexts']->getData()); $i++) {
                    $tag = $form['tagsContexts']->getData()[$i];
                    $advisor->addTag($tag);
                }
            }


            $date = new DateTime('now');
            $advisor->setSubmissionDate($date);
            $em->persist($advisor);
            $em->flush();
        }
        return $this->render('formAdvisor/formAdvisor.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
