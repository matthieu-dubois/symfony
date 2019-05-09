<?php

namespace Epsi\PremierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entreprise
 *
 * @ORM\Table(name="entreprise")
 * @ORM\Entity(repositoryClass="Epsi\PremierBundle\Repository\EntrepriseRepository")
 */
class Entreprise
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=50)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50)
     */
    private $ville;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=5)
     */
    private $cp;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numTel", type="string", length=50)
     */
    private $numTel;

    /**     
     * @ORM\ManyToOne(targetEntity="Epsi\PremierBundle\Entity\Utilisateur") 
     * @ORM\JoinColumn(nullable=false) 
     */ private 
    $utilisateur;
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Entreprise
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
    
    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Entreprise
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }
    /**
     * Get Adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
    
    /**
     * Set Ville
     *
     * @param string $ville
     *
     * @return Entreprise
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }
    /**
     * Get Ville
     *
     * @return string
     */
    public function getville()
    {
        return $this->ville;
    }
    
    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return Entreprise
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }
    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }
    
    /**
     * Set numTel
     *
     * @param string $numTel
     *
     * @return string
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }
    /**
     * Get numTel
     *
     * @return string
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * Set utilisateur
     *
     * @param \Epsi\PremierBundle\Entity\Utilisateur $utilisateur
     *
     * @return Entreprise
     */
    public function setUtilisateur(\Epsi\PremierBundle\Entity\Utilisateur $utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Epsi\PremierBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
