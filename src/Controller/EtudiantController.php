<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
// use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function index(EtudiantRepository $etudiantRepository)
    {
        $etudiants = $etudiantRepository->findAll();
        // dd($etudiants);
        return $this->render('etudiant/index.html.twig',compact('etudiants'));
    }

    /**
     * @Route("/etudiant/create", name="createEtudiant")
     */
    public function create(Request $requete,EntityManagerInterface $manager)
    {
        //$requete=>la soumission
        //creation d'1 objet Etudiant
        $etudiant = new Etudiant();
        //creation du formulaire
        //on cree en mm temps un objet Etudiant=>hydrate
        $form = $this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($requete);
        if($form->isSubmitted() && $form->isValid()){
            // dd($etudiant);
            // $manager = $this->getDoctrine()->getManager();
            $manager->persist($etudiant);
            $manager->flush();
            return $this->redirectToRoute('etudiant');
        }
        // dd($form);
        return $this->render('etudiant/creerEtudiant.html.twig', [
            //on cree la vue form
            'form' => $form->createView(),
        ]);
    }

        /**
     * @Route("/etudiant/update/{id<[0-9]+>}/", name="updateEtudiant")
     */
    public function update(Request $requete,EntityManagerInterface $manager, Etudiant $etudiant)
    {
        //$requete=>la soumission
        //creation d'1 objet Etudiant 
        // $etudiant = new Etudiant();
        //creation du formulaire
        //on cree en mm temps un objet Etudiant=>hydrate
        $form = $this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($requete);
        if($form->isSubmitted() && $form->isValid()){
            // dd($etudiant);
            // $manager = $this->getDoctrine()->getManager();
            // $manager->persist($etudiant);
            $manager->flush();
            return $this->redirectToRoute('etudiant');
        }
        // dd($form);
        return $this->render('etudiant/creerEtudiant.html.twig', [
            //on retourne l'etudiant
            'etudiant' => $etudiant,
            //on retourne la vue fom
            'form' => $form->createView(),
        ]);
    }

       /**
     * @Route("/etudiant/delete/{id<[0-9]+>}/", name="deleteEtudiant")
     */
    public function delete(EntityManagerInterface $manager, Etudiant $etudiant)
    {
       $manager->remove($etudiant);
       $manager->flush();
       return $this->redirectToRoute('etudiant');
    }


}
