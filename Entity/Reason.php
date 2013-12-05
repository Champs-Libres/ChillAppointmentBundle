<?php

namespace CL\Chill\AppointmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reason
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Reason
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
      * @var CL\Chill\AppointmentBundle\ReasonCategory
      *
      * @ORM\ManyToOne(targetEntity="ReasonCategory",inversedBy="reasons")
      * @ORM\JoinColumn(nullable=false)
     */
    private $category;

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
     * @return Reason
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
     * @return Reason
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
     * Set category
     *
     * @param \CL\Chill\AppointmentBundle\Entity\ReasonCategory $category
     * @return Reason
     */
    public function setCategory(\CL\Chill\AppointmentBundle\Entity\ReasonCategory $category)
    {
        $this->category = $category;
        $category->addReason($this);
        return $this;
    }

    /**
     * Get category
     *
     * @return \CL\Chill\AppointmentBundle\Entity\ReasonCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get the string representation of the Reason
     *
     * @return String
     */
    public function __toString()
    {
        return $this->name;
    }
}