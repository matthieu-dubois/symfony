<?php

namespace Epsi\PremierBundle\Controller;
use Epsi\PremierBundle\Entity\Theme;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;


//use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ThemeController extends Controller {
    
    public function themeAction(Request $request) {
        $theme = new Theme();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $theme);
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
                $em->persist($theme);               
                $em->flush();
                }else{               
                    $msg = 'Problème';             
            } 
        }

return $this->render('EpsiPremierBundle:Default:theme.html.twig',
        array('form'=>$form->createView(),'message'=>$msg)               
        );                     
 }
 public function viewAction (Request $resquest){
        
        $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Theme'); $listeTheme = $repository->findAll(); 
        
        return $this->render('EpsiPremierBundle:Default:listeTheme.html.twig',array('listeTheme'=>$listeTheme));

        
    }
    
    public function modificationAction(Request $request, $id) {
    $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Theme');
    $theme = $repository->find($id);  
    
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $theme);
        $formBuilder
                ->add('Libelle', TextType::class)
                ->add('Envoyer', SubmitType::class)
        ;
        $msg = '';
        $form = $formBuilder->getForm();
                if ($request->isMethod('POST')) {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $msg = 'Thème mis à jour';
                $em = $this->getDoctrine()->getManager();
                $em->persist($theme);
                $em->flush();
                $response = $this ->forward('EpsiPremierBundle:Theme:view');
                return $response;
            } else {
                $msg = 'Problème';
            }
        }
        return $this->render('EpsiPremierBundle:Default:modifTheme.html.twig', ['form' => $form->createView(), 'message' => $msg]
        );
    }
    
    public function suppressionAction(Request $request, $id){
        $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Theme');
        $theme = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($theme);
        $em->flush();
        $response = $this ->forward('EpsiPremierBundle:Theme:view');
        return $response;
    
     }
    /** 
    * @ApiDoc(     
    * description="Récupère la liste des thèmes"    
    *)   
    * @Rest\View()
    * @Rest\Get("/wsthemes")     
    *    
    *      
    */    
    public function getThemesAction()    
    {       
      $themes = $this->get('doctrine.orm.entity_manager')       
      ->getRepository('EpsiPremierBundle:Theme')       
      ->findAll();       
      /* @var $themes Theme[] */       
      return $themes;    
      
    }
 
}