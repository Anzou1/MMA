<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Discussion;
use App\Entity\User;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\DiscussionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
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
     * @Route("/forum/debat/new", name="forum_forum")
     */
    public function home(DiscussionRepository $repo): Response
    {
        $allDiscussion = $repo->findAll();

        return $this->render('forum/ForumDiscussion.html.twig', [
            'allDiscussion' => $allDiscussion

        ]);
    }



    /**
     * @Route("/forum/home/{id}", name="forum_home")
     * @Route("/forum/post/{id}", name="forum_post")
     */
    public function homeMessage(Discussion $discussion, CommentaireRepository $repo, Request $request, EntityManagerInterface $manager): Response
    {

        $allComment = $repo->findAll();
        dump($allComment);

        $comment = new Commentaire;



        $formComment = $this->createForm(CommentaireType::class, $comment);


        $formComment->handleRequest($request);
        dump($request);


        if ($formComment->isSubmitted() && $formComment->isvalid()) {
            $user = $this->getUser();


            // $userComment = $this->getUser()->getId();


            $comment->setUser($user);
            $comment->setdiscussion($discussion);
            $comment->setDate(new \DateTime());

            $manager->persist($comment);
            $manager->flush();

            $message =  "Le commentaire a été ajouté";
            $this->addflash('info', $message);


            return $this->redirectToRoute('forum_home', [
                'id' => $discussion->getId()
            ]);
        }

        return $this->render('forum/ForumHome.html.twig', [
            'discussion' => $discussion,
            'allComment' => $allComment,
            'formulaire' =>  $formComment->createView()
        ]);
    }
}
