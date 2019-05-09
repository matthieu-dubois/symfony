<?php

namespace Epsi\PremierBundle\Controller;

use Epsi\PremierBundle\Entity\Entreprise;
use Epsi\PremierBundle\Entity\Utilisateur;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EntrepriseController extends Controller {
    
    public function entrepriseAction(Request $request) {
        
$entreprise = new Entreprise();
$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $entreprise);
$formBuilder                
        ->add('nom', TextType::class)                
        ->add('adresse', TextType::class)                
        ->add('ville', TextType::class)                
        ->add('cp', TextType::class) 
        ->add('numTel', TextType::class)
        ->add('utilisateur', EntityType::class,
                        array('class'=>'EpsiPremierBundle:Utilisateur','choice_label'=> 'nom')
                     )
        ->add('Ajouter', SubmitType::class)
        ; 
$form = $formBuilder->getForm();
        $msg=""; 
        if ($request->isMethod('POST')){            
            $form -> handleRequest ($request);            
            if($form->isValid()){               
                $msg= 'Message bien envoyé'; 
                $em = $this->getDoctrine()->getManager();              
                $em->persist($entreprise);               
                $em->flush();
                }else{               
                    $msg = 'Problème';             
            } 
        }

return $this->render('EpsiPremierBundle:Default:entreprise.html.twig',
        array('form'=>$form->createView(),'message'=>$msg)               
        );                     
 }
 public function viewAction (Request $resquest){
        $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Entreprise'); $listeEntreprise = $repository->findAll(); 
        return $this->render('EpsiPremierBundle:Default:listeEntreprise.html.twig',array('listeEntreprise'=>$listeEntreprise));  
    }
    
public function modificationAction(Request $request, $id){        
        $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Entreprise'); 
        $entreprise = $repository->find($id);
$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $entreprise);
$formBuilder                
        ->add('nom', TextType::class)                
        ->add('adresse', TextType::class)                
        ->add('ville', TextType::class)                
        ->add('cp', TextType::class) 
        ->add('numTel', TextType::class)
        ->add('utilisateur', EntityType::class,
                        array('class'=>'EpsiPremierBundle:Utilisateur','choice_label'=> 'nom')
                     )
        ->add('Envoyer', SubmitType::class)
        ; 
$form = $formBuilder->getForm();
$msg= "";
if ($request->isMethod('POST')){            
            $form -> handleRequest ($request);            
            if($form->isValid()){               
                $msg= 'Message bien envoyé'; 
                $em = $this->getDoctrine()->getManager();              
                $em->persist($entreprise);               
                $em->flush();
                }else{               
                    $msg = 'Problème';             
            } 
        }
return $this->render('EpsiPremierBundle:Default:modifEntreprise.html.twig', ['form' => $form->createView(), 'message' => $msg]);        
    }
    
public function suppressionAction(Request $request, $id){
        $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Entreprise');
        $mot = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($mot);
        $em->flush();
        $response = $this ->forward('EpsiPremierBundle:Entreprise:view');
        return $response;
    
     }    
    /* public function SuppAction(Request $request)
 {
    $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Entreprise');


    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class);
    $formBuilder->add('save', SubmitType::class,
    array('attr'=>array('class'=>'save'),'label'=>'Supprimer'));

    $form = $formBuilder->getForm();
    if ($request->isMethod('POST')){
    $form -> handleRequest($request);

    if($form->isValid()){

    $cocher = $request->request->get('cocher');
    foreach($cocher as $id){
    $listeContacts = $repository->deleteContact($id);
 }
 }
 }
    $listeContacts = $repository->findAll();
    return $this->render('EpsiPremierBundle:Default:suppCategorie.html.twig',array('listeContacts'=>$listeContacts,'form'=>$form->createView()));
     
    }*/
   
        /**   
         * 
         *@ApiDoc( 
         * description="Récupère la liste des catégories"  
         *)   
         * @Rest\View()  
         * @Rest\Get("/wscategorie")  
         *  
         * 
         */
    
        /*public function getCategorieAction(){
     
     $categorie = $this->get('doctrine.orm.entity_manager')  
     ->getRepository('EpsiPremierBundle:Categorie')  
     ->findAll(); */ 
     /* @var $categorie Categorie[] */  
     /*return $categorie;  
        } */
}
