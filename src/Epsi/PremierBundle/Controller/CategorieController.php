<?php

namespace Epsi\PremierBundle\Controller;
use Epsi\PremierBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CategorieController extends Controller {

    public function categorieAction(Request $request) {
        $categorie = new categorie();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $categorie);
        $formBuilder
                ->add('Libelle', TextType::class)
                ->add('Ajouter', SubmitType::class)
        ;
        $form = $formBuilder->getForm();
        $msg=""; 
        if ($request->isMethod('POST')){            
            $form -> handleRequest ($request);            
            if($form->isValid()){               
                $msg= 'Message bien envoyé'; 
                $em = $this->getDoctrine()->getManager();              
                $em->persist($categorie);               
                $em->flush();
                }else{               
                    $msg = 'Problème';             
            } 
        }


        return $this->render('EpsiPremierBundle:Default:categorie.html.twig', array('form' => $form->createView(),'message'=>$msg)
        );
    }
    
    public function viewAction (Request $resquest){
        
        $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Categorie'); $listeCategorie = $repository->findAll(); 
        
        return $this->render('EpsiPremierBundle:Default:listeCategorie.html.twig',array('listeCategorie'=>$listeCategorie));

        
    }
    
    public function modificationAction(Request $request, $id) {
    $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Categorie');
    $categorie = $repository->find($id);  
    
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $categorie);
        $formBuilder
                ->add('Libelle', TextType::class)
                ->add('Envoyer', SubmitType::class)
        ;
        $msg = '';
        $form = $formBuilder->getForm();
                if ($request->isMethod('POST')) {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $msg = 'Categorie mise à jour';
                $em = $this->getDoctrine()->getManager();
                $em->persist($categorie);
                $em->flush();
                $response = $this ->forward('EpsiPremierBundle:Categorie:view');
                return $response;
            } else {
                $msg = 'Problème';
            }
        }
        return $this->render('EpsiPremierBundle:Default:modifCategorie.html.twig', ['form' => $form->createView(), 'message' => $msg]
        );
    }
    
    public function suppressionAction(Request $request, $id){
        $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Categorie');
        $categorie = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();
        $response = $this ->forward('EpsiPremierBundle:Categorie:view');
        return $response;
    
     }
         
     
     
     
     public function SuppAction(Request $request)
 {
    $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Categorie');


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
     
    }
   
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
    
        public function getCategorieAction(){
     
     $categorie = $this->get('doctrine.orm.entity_manager')  
     ->getRepository('EpsiPremierBundle:Categorie')  
     ->findAll();  
     /* @var $categorie Categorie[] */  
     return $categorie;  
        } 
    }

    


 

    

