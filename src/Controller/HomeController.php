<?php

namespace App\Controller;

use App\Entity\Fighters;
use App\Entity\Discussion;
use App\Repository\FightersRepository;
use App\Repository\DiscussionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    


    /**
    * @Route("/", name="home")
    * @Route("/fighters", name="tale")
    */
    public function index(EntityManagerInterface $manager, FightersRepository $repo, DiscussionRepository $repository,Request $request): Response
    

    {
        $f1 = $request->request->get('admin_tale')['name'];
        $f2 = $request->request->get('admin_tale')['id'];

       
        $redcorner = $repo->find($f1);
        $bluecorner = $repo->find($f2);

        $fighters = $manager->getClassMetadata(Fighters::class)->getFieldNames();
        $name = $repo->findAll();

        $allDiscussion = $repository->findAll();
        $colonnes = $manager->getClassMetadata(Discussion::class)->getFieldNames();

       

        return $this->render('home/index.html.twig', [
            'name' => $name,
            'fighters' => $fighters,
            'allDiscussion' => $allDiscussion,
            'colonnes' => $colonnes,
            'redcorner' => $redcorner,
            'bluecorner' => $bluecorner
        ]);
    }


    /**
     * @Route("/home/fighters_bio/{id}", name="fighters_bio")
     */
    public function fightersBio(EntityManagerInterface $manager, FightersRepository $repo, Fighters $id): Response
    {
        $fighters = $manager->getClassMetadata(Fighters::class)->getFieldNames();


      

        return $this->render('/home/fighters_bio.html.twig', [
            'id' => $id,
            'fighters' =>  $fighters

        ]);
    }

    /**
     * @Route("/home/horaire", name="horaire")
     */
    public function horaire(EntityManagerInterface $manager): Response
    {


        return $this->render('/home/horaire.html.twig');
    }
}
