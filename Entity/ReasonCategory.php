<?php

namespace CL\Chill\AppointmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ReasonCategory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ReasonCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IsActive", type="boolean")
     */
    private $isActive;


    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Reason", mappedBy="category")
     */
    private $reasons;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ReasonCategory
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return ReasonCategory
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reasons = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add reasons
     *
     * @param \CL\Chill\AppointmentBundle\Entity\Reason $reasons
     * @return ReasonCategory
     */
    public function addReason(\CL\Chill\AppointmentBundle\Entity\Reason $aReason)
    {
        if(! $this->reasons->contains($aReason)) {
            $this->reasons[] = $aReason;
            $aReason->setCategory($this);
        }
        return $this;
    }

    /**
     * Remove reasons
     *
     * @param \CL\Chill\AppointmentBundle\Entity\Reason $reasons
     */
    public function removeReason(\CL\Chill\AppointmentBundle\Entity\Reason $reasons)
    {
        $this->reasons->removeElement($reasons);
    }

    /**
     * Get reasons
     *
     * @return \Doctrine\Common\Collections\ArrayCollection 
     */
    public function getReasons()
    {
        return $this->reasons;
    }


    /**
     * Get the string representation of the ReasionCategory
     *
     * @return String
     */
    public function __toString()
    {
        return $this->name;
    }
}