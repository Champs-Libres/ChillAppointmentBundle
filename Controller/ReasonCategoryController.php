<?php

namespace CL\Chill\AppointmentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CL\Chill\AppointmentBundle\Entity\ReasonCategory;
use CL\Chill\AppointmentBundle\Form\ReasonCategoryType;

/**
 * ReasonCategory controller.
 *
 * @Route("/reasoncategory")
 */
class ReasonCategoryController extends Controller
{

    /**
     * Lists all ReasonCategory entities.
     *
     * @Route("/", name="reasoncategory")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CLChillAppointmentBundle:ReasonCategory')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new ReasonCategory entity.
     *
     * @Route("/", name="reasoncategory_create")
     * @Method("POST")
     * @Template("CLChillAppointmentBundle:ReasonCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ReasonCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            echo 'form is valid';
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('reasoncategory_show', array('id' => $entity->getId())));
        }
        else {
            $errors = $form->getErrorsAsString();
            echo($errors);
            echo 'form is not valid';
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a ReasonCategory entity.
    *
    * @param ReasonCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ReasonCategory $entity)
    {
        $form = $this->createForm(new ReasonCategoryType(), $entity, array(
            'action' => $this->generateUrl('reasoncategory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ReasonCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new ReasonCategory();
        $form   = $this->createCreateForm($entity);

        return $this->render('CLChillAppointmentBundle:ReasonCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ReasonCategory entity.
     *
     * @Route("/{id}", name="reasoncategory_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CLChillAppointmentBundle:ReasonCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReasonCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ReasonCategory entity.
     *
     * @Route("/{id}/edit", name="reasoncategory_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CLChillAppointmentBundle:ReasonCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReasonCategory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a ReasonCategory entity.
    *
    * @param ReasonCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ReasonCategory $entity)
    {
        $form = $this->createForm(new ReasonCategoryType(), $entity, array(
            'action' => $this->generateUrl('reasoncategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ReasonCategory entity.
     *
     * @Route("/{id}", name="reasoncategory_update")
     * @Method("PUT")
     * @Template("CLChillAppointmentBundle:ReasonCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CLChillAppointmentBundle:ReasonCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ReasonCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('reasoncategory_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ReasonCategory entity.
     *
     * @Route("/{id}", name="reasoncategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CLChillAppointmentBundle:ReasonCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ReasonCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('reasoncategory'));
    }

    /**
     * Creates a form to delete a ReasonCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reasoncategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
