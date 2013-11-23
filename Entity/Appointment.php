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
     * @var Reason
     */
    private $reason;


    /**
     * Set reason
     *
     * @param \Reason $reason
     * @return Appointment
     */
    public function setReason(\Reason $reason)
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
     * @var \CL\Chill\AppointmentBundle\Entity\Reason
     */
    private $notation;


    /**
     * Set notation
     *
     * @param \CL\Chill\AppointmentBundle\Entity\Reason $notation
     * @return Appointment
     */
    public function setNotation(\CL\Chill\AppointmentBundle\Entity\Reason $notation = null)
    {
        $this->notation = $notation;
    
        return $this;
    }

    /**
     * Get notation
     *
     * @return \CL\Chill\AppointmentBundle\Entity\Reason 
     */
    public function getNotation()
    {
        return $this->notation;
    }
}