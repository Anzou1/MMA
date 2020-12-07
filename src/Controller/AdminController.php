<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\AdminRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

















    
}



