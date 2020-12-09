<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Discussion;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\DiscussionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends AbstractController
{
    /**
     * @Route("/forum", name="forum")
     */
    public function index(): Response
    {
        return $this->render('forum/index.html.twig', [
            'controller_name' => 'ForumController',
        ]);
    }

    /**
     * @Route("/forum/debat/{id}", name="forum_debat")
     */
    public function home(Discussion $discussion, DiscussionRepository $repo): Response
    {
        $allDiscussion = $repo->findAll();
        
        return $this->render('forum/ForumDiscussion.html.twig', [
            'allDiscussion' => $allDiscussion,
            'discussion' => $discussion
        ]);
    }

    

    /**
     * @Route("/forum/home/{id}", name="forum_home")
     */
    public function homeMessage(Commentaire $comment): Response
    {
        
        return $this->render('forum/ForumHome.html.twig', [
            'comment' => $comment
        ]);
    }
    

    /**
     * @Route("/forum/post", name="forum_post")
     */
    public function FormHome(Request $request, EntityManagerInterface $manager): Response
    {
        
        
            $comment = new Commentaire;
        
        
        $formComment = $this->createForm(CommentaireType::class, $comment);

      
         $formComment->handleRequest($request);
         dump($formComment);
        if($formComment->isSubmitted() && $formComment->isvalid()){

            $manager->persist($request);
            $manager->flush();

            

        }   

        return $this->render('forum/FormulaireHome.html.twig', [
            'formulaire' =>  $formComment->createView()
        ]);
    }
    

    
}
