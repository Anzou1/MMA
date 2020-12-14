<?php

namespace App\Controller;

use App\Entity\Discussion;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte")
     */
    public function index(): Response
    {
        $discussion = new Discussion;
        return $this->render('compte/index.html.twig', [
            'discussion' => $discussion
        ]);
    }
}
