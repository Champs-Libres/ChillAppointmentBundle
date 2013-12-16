<?php

namespace CL\Chill\AppointmentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CL\Chill\AppointmentBundle\Entity\ReasonCategory;

/**
 * Load reason category into database
 */
class LoadReasonCategory extends AbstractFixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 1400;
    }

	public function load(ObjectManager $manager) {
        echo "loading reason category...\n";
        
        $i = 0;
        
        do {
            echo "rc{$i} ";
            $i++;

            $length = rand(1, 2);
            $name = 'Catego';
            for ($j = 0; $j <= $length; $j++) {
                $name .= $this->names_trigrams[array_rand($this->names_trigrams)];
            }

            $new = new ReasonCategory();
            $new->setName($name);
            $new->setIsActive(TRUE);
            $manager->persist($new);
        } while ($i <= 5);     
        $manager->flush();  
    }

    private $names_trigrams = array('blo', 'bla', 'pop', 'pil', 'lou', 'ba', 'bop', 'bip',
        'tat', 'tot', 'gna', 'gno', 'cas', 'tor', 'rob', 'pip', 'car', 'cha');
}