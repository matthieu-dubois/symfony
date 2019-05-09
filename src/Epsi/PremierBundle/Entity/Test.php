<?php

namespace Epsi\PremierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="Epsi\PremierBundle\Repository\TestRepository")
 */
class Test
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
     * @var int
     *
     * @ORM\Column(name="niveau", type="integer")
     */
    private $niveau;


    /**     
     * @ORM\ManyToOne(targetEntity="Epsi\PremierBundle\Entity\Theme") 
     * @ORM\JoinColumn(nullable=false) 
     */ 
    private $Theme;
    
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
     * Set niveau
     *
     * @param integer $niveau
     *
     * @return Test
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return int
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set theme
     *
     * @param \Epsi\PremierBundle\Entity\Theme $theme
     *
     * @return Test
     */
    public function setTheme(\Epsi\PremierBundle\Entity\Theme $theme)
    {
        $this->Theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \Epsi\PremierBundle\Entity\Theme
     */
    public function getTheme()
    {
        return $this->Theme;
    }
}
