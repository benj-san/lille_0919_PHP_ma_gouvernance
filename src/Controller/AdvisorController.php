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
