<?php

namespace Epsi\PremierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity; 
/** 
* @ORM\Entity
* @UniqueEntity( 
*     fields={"test", "user", "date"}, 
* ) 
*/

/**
 * TestUtilisateur
 *
 * @ORM\Table(name="test_utilisateur")
 * @ORM\Entity(repositoryClass="Epsi\PremierBundle\Repository\TestUtilisateurRepository")
 */
class TestUtilisateur
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**     
     * @ORM\ManyToOne(targetEntity="Epsi\PremierBundle\Entity\Test")     
    * @ORM\JoinColumn(nullable=false)    
   */    private $test;
   
    /**     
     * @ORM\ManyToOne(targetEntity="Epsi\PremierBundle\Entity\Utilisateur")     
    * @ORM\JoinColumn(nullable=false)     
   */    private $user;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return TestUtilisateur
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}

