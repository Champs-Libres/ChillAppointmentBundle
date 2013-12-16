<?php

namespace CL\Chill\AppointmentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CL\Chill\AppointmentBundle\Entity\ReasonCategory;
use CL\Chill\AppointmentBundle\Entity\Reason;

/**
 * Load reason into database
 */
class LoadReason extends AbstractFixture implements OrderedFixtureInterface  {

    public function getOrder() {
        return 1500;
    }

    public function load(ObjectManager $manager) {
        echo "loading reason...\n";

        $reasonCategories = $manager->getRepository('CLChillAppointmentBundle:ReasonCategory')->findAll();
        $reasonCategories_nbr = count($reasonCategories);
        echo $reasonCategories_nbr;
        
        $i = 0;
        do {
            echo "r{$i} ";
            $i++;

            $length = rand(1, 2);
            $name = 'Reaso';
            for ($j = 0; $j <= $length; $j++) {
                $name .= $this->names_trigrams[array_rand($this->names_trigrams)];
            }

            $new = new Reason();
            $new->setName($name);
            $new->setIsActive(TRUE);
            $new->setCategory($reasonCategories[rand(0,$reasonCategories_nbr -1)]);
            $manager->persist($new);

            $aReasonCategory = $reasonCategories[rand(0,$reasonCategories_nbr -1)];
            $aReasonCategory->addReason($new);
            $manager->persist($aReasonCategory);
        } while ($i <= 25);     
        $manager->flush();  
    }

    private $names_trigrams = array('blo', 'bla', 'pop', 'pil', 'lou', 'ba', 'bop', 'bip',
        'tat', 'tot', 'gna', 'gno', 'cas', 'tor', 'rob', 'pip', 'car', 'cha');
}