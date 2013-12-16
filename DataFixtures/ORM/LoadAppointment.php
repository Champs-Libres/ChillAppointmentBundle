<?php

namespace CL\Chill\AppointmentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CL\Chill\PersonBundle\Entity\Person;
use CL\Chill\AppointmentBundle\Entity\Appointment;

/**
 * Load appointment into database
 */
class LoadAppointment extends AbstractFixture implements OrderedFixtureInterface  {

    public function getOrder() {
        return 2600;
    }

	public function load(ObjectManager $manager) {
        echo "loading appointment...\n";

        $persons = $manager->getRepository('CLChillPersonBundle:Person')->findAll();
        $persons_nbr = count($persons);

        $reasons = $manager->getRepository('CLChillAppointmentBundle:Reason')->findAll();
        $reasons_nbr = count($reasons);
        
        $i = 0;
        
        do {
        	echo "a{$i} ";
            $i++;

            $appointment = array(
                'Agent' => 'TODO',
                'Date' => "1960-10-12",
                'DurationTime' => "2:00",
                'Attendee' => TRUE,
                'Person' => ($persons[rand(0,$persons_nbr-1)]),
                'Reason' => ($reasons[rand(0,$reasons_nbr-1)])
            );
            $a = new Appointment();

            foreach ($appointment as $key => $value) {
            	if($key == 'Date') {
            		$value = new \DateTime($value);
            	}
            	elseif ($key == 'DurationTime') {
            		$value = new \DateTime($value);
            	}
            	call_user_func(array($a, 'set'.$key), $value);
            }


            $manager->persist($a);

        } while ($i <= 500);     
        $manager->flush();  
    }
}