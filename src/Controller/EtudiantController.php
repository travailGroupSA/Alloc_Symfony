<?php
namespace App\Controller; 
use App\traitement;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\functions\GenereMatricule;
use Doctrine\DBAL\Types\DateTimeType;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/** 
 *  @IsGranted("ROLE_USER")
 * */
class EtudiantController extends AbstractController
{

    public function generateMat($nom,$prenom){
        $annee = date('Y');
        // echo $annee;
        $aleat=rand();
        $aleat=substr($aleat,0,4);
        //deux premierr lettres du nom
        $twoFirstLetters = strtoupper(substr($nom,0,2));
        //deux derniers lettres du prenom
        $twoLastLetters =  strtoupper(substr($prenom,-2));
    
        return $matricule = $annee.$twoFirstLetters.$twoLastLetters.$aleat;
    }

    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function index(EtudiantRepository $etudiantRepository)
    {
        // $etudiants = $etudiantRepository->findAll();
        // dd($etudiants);
        // return $this->render('etudiant/index.html.twig',compact('etudiants'));
        return $this->render('etudiant/index.html.twig');
    }

    /**
     * @Route("/etudiant/create", name="createEtudiant")
     */
    public function create(Request $requete,EntityManagerInterface $manager)
    {
        //$requete=>la soumission
        //creation d'1 objet Etudiant
        $etudiant = new Etudiant();
        $etudiant->setDateInscription(new \DateTime("now"));
        //creation du formulaire
        //on cree en mm temps un objet Etudiant=>hydrate
        $form = $this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($requete);
        if($etudiant->getBoursier()=="demi"){
            $etudiant->setMontantBourse("20000");
        }
        else if($etudiant->getBoursier()=="entiere"){
            $etudiant->setMontantBourse("40000");
        }
        $etudiant->setMatricule($this->generateMat($etudiant->getNom(),$etudiant->getPrenom()));
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($etudiant);
            $manager->flush();
            return $this->redirectToRoute('etudiant');
        }
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
