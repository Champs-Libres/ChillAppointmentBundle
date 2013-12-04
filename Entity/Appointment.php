<?php

namespace CL\Chill\AppointmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appointment
 */
class Appointment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $agent;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \DateTime
     */
    private $durationTime;

    /**
     * @var string
     */
    private $remark;

    /**
     * @var boolean
     */
    private $attendee;


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
     * Set agent
     *
     * @param string $agent
     * @return Appointment
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;
    
        return $this;
    }

    /**
     * Get agent
     *
     * @return string 
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Appointment
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

    /**
     * Set durationTime
     *
     * @param \DateTime $durationTime
     * @return Appointment
     */
    public function setDurationTime($durationTime)
    {
        $this->durationTime = $durationTime;
    
        return $this;
    }

    /**
     * Get durationTime
     *
     * @return \DateTime 
     */
    public function getDurationTime()
    {
        return $this->durationTime;
    }

    /**
     * Set remark
     *
     * @param string $remark
     * @return Appointment
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    
        return $this;
    }

    /**
     * Get remark
     *
     * @return string 
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Set attendee
     *
     * @param boolean $attendee
     * @return Appointment
     */
    public function setAttendee($attendee)
    {
        $this->attendee = $attendee;
    
        return $this;
    }

    /**
     * Get attendee
     *
     * @return boolean 
     */
    public function getAttendee()
    {
        return $this->attendee;
    }
    /**
     * @var \CL\Chill\AppointmentBundle\Entity\Reason
     */
    private $reason;


    /**
     * Set reason
     *
     * @var \CL\Chill\AppointmentBundle\Entity\Reason
     * @return Appointment
     */
    public function setReason(\CL\Chill\AppointmentBundle\Entity\Reason $reason)
    {
        $this->reason = $reason;
    
        return $this;
    }

    /**
     * Get reason
     *
     * @return \Reason 
     */
    public function getReason()
    {
        return $this->reason;
    }
    /**
     * @var \CL\Chill\PersonBundle\Entity\Person
     */
    private $person;


    /**
     * Set person
     *
     * @param \CL\Chill\PersonBundle\Entity\Person $person
     * @return Appointment
     */
    public function setPerson(\CL\Chill\PersonBundle\Entity\Person $person = null)
    {
        $this->person = $person;
    
        return $this;
    }

    /**
     * Get person
     *
     * @return \CL\Chill\PersonBundle\Entity\Person 
     */
    public function getPerson()
    {
        return $this->person;
    }
}