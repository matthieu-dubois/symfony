<?php

namespace Epsi\PremierBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EpsiPremierBundle:Default:index.html.twig');
    }
    
     public function categorieAction()
    {
        return $this->render('EpsiPremierBundle:Default:categorie.html.twig');
    }
      public function motAction()
    {
        return $this->render('EpsiPremierBundle:Default:categorie.html.twig');
    }
    public function entrepriseAction()
    {
        return $this->render('EpsiPremierBundle:Default:entreprise.html.twig');
    }
 
}

