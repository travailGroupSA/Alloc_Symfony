<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\ChambreType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @IsGranted("ROLE_USER")
 * @Route("/chambre")
 */
class ChambreController extends AbstractController
{
    /**
     * @Route("/", name="chambre_index", methods={"GET"})
     */
    public function index(Request $request, ChambreRepository $chambreRepository): Response
    {
        $limit = 3;
        $allChambres = $chambreRepository->findAll();
        $nbre_total_chambres = count($allChambres);
        $debulimit = ($request->query->getInt('page', 1) - 1) * $limit;
        $total_page = ceil($nbre_total_chambres / $limit);
        $page = $request->query->getInt('page', 1);
        $chambres = $chambreRepository->findBy([],  $orderBy = [], $limit = $limit, $offset = $debulimit);
        if ($request->isXmlHttpRequest()) {
            $chambres = $chambreRepository->findBy([],  $orderBy = [], $limit = $limit, $offset = 3);
            $page = $request->query->getInt('page', 1);
            return $this->render('chambre/_chambrePaginator.html.twig', compact('chambres', 'page', 'total_page'));
        }
        return $this->render('chambre/index.html.twig', compact('chambres', 'page', 'total_page'));
    }

    /**
     * @Route("/create", name="chambre_new", methods={"GET","POST"})
     */
    public function new(Request $request,  EntityManagerInterface $em): Response
    {
        $chambre = new Chambre();
        $form = $this->createForm(ChambreType::class, $chambre, [
            'attr' => ['id' => "add_chambre", 'class' => "col-10 offset-1"]
        ]);
        $form->handleRequest($request);
        //verife si la requete est en ajax
        if ($request->isXmlHttpRequest()) {
            $data = $request->request->all();
            $numChambre = $this->generateNumChambre($data['numBatiment']);
            $chambre->setNumChambre($numChambre);
            $chambre->setNumBatiment($data['numBatiment']);
            $chambre->setType($data['type']);
            $em->persist($chambre);
            $em->flush();
            return $this->json(['response' => 'envoyé']);
        } else if ($form->isSubmitted() && $form->isValid()) {
            // $data = $form->getData();
            // $numBatiment = $data->getNumBatiment();
            $numChambre = $this->generateNumChambre($chambre->getNumBatiment());
            $chambre->setNumChambre($numChambre);
            $em->persist($chambre);
            $em->flush();
            return $this->redirectToRoute('chambre_index');
        }
        return $this->render('chambre/new.html.twig', [
            'chambre' => $chambre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chambre_show", methods={"GET"})
     */
    public function show(Chambre $chambre): Response
    {
        return $this->render('chambre/show.html.twig', [
            'chambre' => $chambre,
        ]);
    }

    /**
     * @Route("/{id}/update", name="chambre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chambre $chambre, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ChambreType::class, $chambre, [
            'attr' => ['id' => "update_chambre", 'class' => "col-10 offset-1"]
        ]);
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            $data = $request->request->all();
            $chambre->setNumBatiment($data['numBatiment']);
            $chambre->setType($data['type']);
            $em->flush();
            return $this->json(['response' => 'envoyé']);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chambre_index');
        }

        return $this->render('chambre/edit.html.twig', [
            'chambre' => $chambre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chambre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Chambre $chambre): Response
    {
        if ($this->isCsrfTokenValid('delete' . $chambre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chambre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chambre_index');
    }

    //function génére le num chambre suivant ce Format​, Annee CC LL 0000
    private function generateNumChambre($numBat)
    {


        $numBatStr = (string) ($numBat);
        $lennumB = strlen($numBatStr);
        $numfinal = '';
        if ($lennumB == 1) {
            $numfinal = '00' . $numBatStr;
        } elseif ($lennumB == 2) {
            $numfinal = '0' . $numBatStr;
        } elseif ($lennumB == 3) {
            $numfinal = $numBatStr;
        } else {
            return false;
        }

        //genere une série de quatre chiffre qui est distinct
        $randomnum = rand();
        $strnum = (string) ($randomnum);
        $serieNum = substr($strnum, 0, 4);
        $numeroChambre =  $numfinal . $serieNum;
        return $numeroChambre;
    }
}