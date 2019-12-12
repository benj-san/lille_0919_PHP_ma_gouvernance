<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/board", name="board")
     */
    public function board()
    {
        return $this->render('admin/constructBoard.html.twig');
    }

    /**
     * @Route("/cvAdvisor", name="cvAdvisor")
     */
    public function cvAdvisor()
    {
        return $this->render('cvAdvisor.html.twig');
    }
}
