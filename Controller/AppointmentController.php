<?php

namespace CL\Chill\AppointmentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CL\Chill\AppointmentBundle\Entity\Appointment;
use CL\Chill\AppointmentBundle\Form\AppointmentType;

/**
 * Appointment controller.
 *
 */
class AppointmentController extends Controller
{
    /**
     * Lists all Appointment entities for a given Person.
     *
     */
    public function listForPersonAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('CLChillPersonBundle:Person')->find($id);

        $entities = $em->getRepository('CLChillAppointmentBundle:Appointment')->findByPerson($person);

        return $this->render('CLChillAppointmentBundle:Appointment:listForPerson.html.twig', array(
            'person' => $person,
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Appointment entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Appointment();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this
                ->get('session')
                ->getFlashBag()
                ->add('success', 
                    $this
                        ->get('translator')
                        ->trans('views.appointment.form.create.success')
                    );

            return $this->redirect($this->generateUrl('appointment_show', array('id' => $entity->getId())));
        }
        else {
            $this
                ->get('session')
                ->getFlashBag()
                ->add('danger', 
                    $this
                        ->get('translator')
                        ->trans('views.appointment.form.create.error')
                    );
        }

        return $this->render('CLChillAppointmentBundle:Appointment:newForPerson.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'person' => $entity->getPerson(),
        ));
    }

    /**
    * Creates a form to create a Appointment entity.
    *
    * @param Appointment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Appointment $entity)
    {
        $form = $this->createForm(new AppointmentType(), $entity, array(
            'action' => $this->generateUrl('appointment_create'),
            'method' => 'POST',
            'em' => $this->getDoctrine()->getManager(),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Appointment entity.
     *
     */
    public function newForPersonAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('CLChillPersonBundle:Person')->find($id);

        $entity = new Appointment();
        $entity->setAttendee(true);
        $entity->setPerson($person);
        $form   = $this->createCreateForm($entity);

        return $this->render('CLChillAppointmentBundle:Appointment:newForPerson.html.twig', array(
            'person' => $person,
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Appointment entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $appointment = $em->getRepository('CLChillAppointmentBundle:Appointment')->find($id);
        $person = $appointment->getPerson();

        if (!$appointment) {
            throw $this->createNotFoundException('Unable to find Appointment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CLChillAppointmentBundle:Appointment:show.html.twig', array(
            'appointment' => $appointment,
            'person' => $person,
            'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing Appointment entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $appointment = $em->getRepository('CLChillAppointmentBundle:Appointment')->find($id);
        $person = $appointment->getPerson();

        if (!$appointment) {
            throw $this->createNotFoundException('Unable to find Appointment entity.');
        }

        $editForm = $this->createEditForm($appointment);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CLChillAppointmentBundle:Appointment:edit.html.twig', array(
            'appointment' => $appointment,
            'person' => $person,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Appointment entity.
    *
    * @param Appointment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Appointment $entity)
    {
        $form = $this->createForm(new AppointmentType(), $entity, array(
            'action' => $this->generateUrl('appointment_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'em' => $this->getDoctrine()->getManager(),
        ));

        return $form;
    }
    /**
     * Edits an existing Appointment entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CLChillAppointmentBundle:Appointment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Appointment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this
                ->get('session')
                ->getFlashBag()
                ->add('success', 
                    $this
                        ->get('translator')
                        ->trans('views.appointment.form.edit.success')
                    );
            return $this->redirect($this->generateUrl('appointment_show', array('id' => $id)));
        }
        else {
            $this
                ->get('session')
                ->getFlashBag()
                ->add('danger', 
                    $this
                        ->get('translator')
                        ->trans('views.appointment.form.edit.error')
                    );
        }

        return $this->render('CLChillAppointmentBundle:Appointment:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'person' => $entity->getPerson(),
        ));
    }
    /**
     * Deletes a Appointment entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $appointment = $em->getRepository('CLChillAppointmentBundle:Appointment')->find($id);

        if (!$appointment) {
            throw $this->createNotFoundException('Unable to find Appointment entity.');
        }

        $person = $appointment->getPerson();
        $idPerson = $person->getId();

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->remove($appointment);
            $em->flush();

            $this
                ->get('session')
                ->getFlashBag()
                ->add('success', 
                    $this
                        ->get('translator')
                        ->trans('views.appointment.form.delete.success')
                    );
        }
        else {
            $this
            ->get('session')
                ->getFlashBag()
                ->add('success', 
                    $this
                        ->get('translator')
                        ->trans('views.appointment.form.delete.error')
                    );
        }

        return $this->redirect($this->generateUrl('appointment_list_for_person', array('id' => $idPerson)));
    }

    /**
     * Creates a form to delete a Appointment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appointment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
