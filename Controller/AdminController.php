<?php

namespace CL\Chill\AppointmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * 
 *
 * @author julien.fastre@champs-libres.coop
 */
class AdminController extends Controller {
    
    public function indexAction() {
        return $this->forward('CLChillMainBundle:Admin:index',  
                array(
                    'menu' => 'admin_appointment',
                    'page_title' => 'menu.appointment.admin.index',
                    'header_title' => 'menu.appointment.header_index'
                    )
                );
    }
    
}
