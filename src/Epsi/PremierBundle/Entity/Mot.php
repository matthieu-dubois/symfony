<?php

namespace Epsi\PremierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mot
 *
 * @ORM\Table(name="mot")
 * @ORM\Entity(repositoryClass="Epsi\PremierBundle\Repository\MotRepository")
 */
class Mot
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
     * @ORM\Column(name="libelle", type="string", length=50)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="traduction", type="string", length=50)
     */
    private $traduction;
    
    /** 
     * @ORM\ManyToMany(targetEntity="Epsi\PremierBundle\Entity\ListeMot",cascade={"persist"})
    */ 
    private $listeMots;

    /**     
     * @ORM\ManyToOne(targetEntity="Epsi\PremierBundle\Entity\Categorie") 
    * @ORM\JoinColumn(nullable=false,onDelete="CASCADE") 
   */ private $categorie;
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Mot
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }
    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set traduction
     *
     * @param string $traduction
     *
     * @return Mot
     */
    public function setTraduction($traduction)
    {
        $this->traduction = $traduction;

        return $this;
    }
    /**
     * Get traduction
     *
     * @return string
     */
    public function getTraduction()
    {
        return $this->traduction;
    }
    
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->listeMots = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add listeMot
     *
     * @param \Epsi\PremierBundle\Entity\listeMot $listeMot
     *
     * @return Mot
     */
    public function addListeMot(\Epsi\PremierBundle\Entity\listeMot $listeMot)
    {
        $this->listeMots[] = $listeMot;

        return $this;
    }

    /**
     * Remove listeMot
     *
     * @param \Epsi\PremierBundle\Entity\listeMot $listeMot
     */
    public function removeListeMot(\Epsi\PremierBundle\Entity\listeMot $listeMot)
    {
        $this->listeMots->removeElement($listeMot);
    }

    /**
     * Get listeMots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListeMots()
    {
        return $this->listeMots;
    }

    /**
     * Set categorie
     *
     * @param \Epsi\PremierBundle\Entity\Categorie $categorie
     *
     * @return Mot
     */
    public function setCategorie(\Epsi\PremierBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Epsi\PremierBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
