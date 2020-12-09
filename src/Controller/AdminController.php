<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Fighters;
use App\Form\AdminFighterType;
use App\Repository\UserRepository;
use App\Form\AdminRegistrationType;
use App\Repository\FightersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
     * @Route("/admin/membres", name="admin_membres")
     */
    public function adminMembres(EntityManagerInterface $manager, UserRepository $repo): Response
    {

        $colonnes = $manager->getClassMetadata(User::class)->getFieldNames();
        dump($colonnes);

        $membres = $repo->findAll();
        dump($membres);

        return $this->render('admin/admin_table_user.html.twig', [
            'colonnes' => $colonnes,
            'membres' => $membres
        ]);
    }

    /**
     * @Route("/admin/membres/{id}/edit", name="admin_edit_membre")
     */
    public function adminFormMembres(EntityManagerInterface $manager, User $user, Request $request): Response
    {

        $form = $this->createForm(AdminRegistrationType::class, $user);
        $form->handleRequest($request);

        dump($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash('success', "Le membre a bien été modifié");

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('admin_membres');
        }

        return $this->render('admin/admin_edit_user.html.twig', [
            'formMembre'  => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}/delete-membre", name="admin_delete_membre")
     */
    public function deletemembre(EntityManagerInterface $manager, User $user)
    {
        $manager->remove($user);
        $manager->flush();

        $this->addFlash('success', "L'utilisateur a bien été supprimé");

        return $this->redirectToRoute('admin_membres');
    }





    /**
     * @Route("/admin/fighters", name="admin_fighters")
     */
    public function fighters(EntityManagerInterface $manager, FightersRepository $repo): Response
    {
        $colonnes = $manager->getClassMetadata(Fighters::class)->getFieldNames();
        dump($colonnes);

        $fighters = $repo->findAll();
        dump($fighters);


        return $this->render('admin/admin_table_fighters.html.twig', [
            'colonnes' => $colonnes,
            'fighters' => $fighters
        ]);
    }
    /**
     * @Route("/admin/fighter/new", name="admin_new_fighter")
     * @Route("/admin/{id}/edit_fighter", name="admin_edit_fighter")
     */
    public function editFighter(EntityManagerInterface $manager, Fighters $fighters = null, Request $request, SluggerInterface $slugger): Response
    {
        if (!$fighters) {
            $fighters = new Fighters;
        }
        $form = $this->createForm(AdminFighterType::class, $fighters);
        $form->handleRequest($request);

        dump($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $PhotoFile */
            $PhotoFile = $form->get('photo')->getData();




            if ($PhotoFile) {
                $originalFilename = pathinfo($PhotoFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $PhotoFile->guessExtension();


                try {
                    $PhotoFile->move(
                        $this->getParameter('combattant_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                $fighters->setPhoto($newFilename);
            }



            $this->addFlash('success', "Le combatant a bien été modifié");

            $manager->persist($fighters);
            $manager->flush();

            return $this->redirectToRoute('admin_fighters');
        }

        return $this->render('admin/admin_edit_fighter.html.twig', [
            'formFighters'  => $form->createView(),
            'editMode' => $fighters->getId()
        ]);
    }


    /**
     * @Route("/admin/{id}/delete_fighter", name="admin_delete_fighters")
     */
    public function deleteFighter(EntityManagerInterface $manager, Fighters $fighter)
    {
        $manager->remove($fighter);
        $manager->flush();

        $this->addFlash('success', "Le combattant a bien été supprimé");

        return $this->redirectToRoute('admin_fighters');
    }
}
