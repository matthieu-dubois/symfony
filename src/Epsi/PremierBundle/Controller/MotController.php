<?php
namespace Epsi\PremierBundle\Controller;

use Epsi\PremierBundle\Entity\Mot;
use Epsi\PremierBundle\Entity\Categorie;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MotController extends Controller {

    public function motAction(Request $request) {
        $mot = new mot();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $mot);
        $formBuilder
                ->add('Libelle', TextType::class)
                ->add('Traduction', TextType::class)
                ->add('categorie', EntityType::class,
                        array('class'=>'EpsiPremierBundle:Categorie','choice_label'=> 'libelle')
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
                $em->persist($mot);               
                $em->flush();
                }else{               
                    $msg = 'Problème';             
            } 
        }


        return $this->render('EpsiPremierBundle:Default:mot.html.twig', array('form' => $form->createView(),'message'=>$msg)
        );
    }
    
    public function viewAction (Request $resquest){
        
        $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Mot'); $listeMot = $repository->findAll(); 
        
        return $this->render('EpsiPremierBundle:Default:listeMot.html.twig',array('ListeMot'=>$listeMot));
        
       
    }
    
    public function modificationAction(Request $request, $id) {
    $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Mot');
    $mot = $repository->find($id);  
    
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $mot);
        $formBuilder
                ->add('Libelle', TextType::class)
                ->add('Traduction', TextType::class)
                ->add('Envoyer', SubmitType::class)
        ;
        $msg = '';
        $form = $formBuilder->getForm();
                if ($request->isMethod('POST')) {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $msg = 'Categorie mise à jour';
                $em = $this->getDoctrine()->getManager();
                $em->persist($mot);
                $em->flush();
                $response = $this ->forward('EpsiPremierBundle:Mot:view');
                return $response;
            } else {
                $msg = 'Problème';
            }
        }
        return $this->render('EpsiPremierBundle:Default:modifMot.html.twig', ['form' => $form->createView(), 'message' => $msg]
        );
    }
    
     public function suppressionAction(Request $request, $id){
        $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Mot');
        $mot = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($mot);
        $em->flush();
        $response = $this ->forward('EpsiPremierBundle:Mot:view');
        return $response;
    
     }
     public function AfficherCategorieAction(Request $request, $id){
        $repository = $this->getDoctrine()->getManager()->getRepository('EpsiPremierBundle:Mot');
        $mot = $repository-> AfficheCategorie($id);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->render('EpsiPremierBundle:Default:listeMot.html.twig',array('ListeMot'=>$mot));
    
     }
     
}


