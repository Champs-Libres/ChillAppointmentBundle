<?php

namespace CL\Chill\AppointmentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AppointmentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('agent')
            ->add('date', 'date', array('required' => false, 'widget' => 'single_text'))
            ->add('durationTime', 'time')
            ->add('remark', 'textarea', array('required' => false))
            ->add('attendee', 'checkbox', array('required' => false))
            ->add('reason')
            ->add('person', 'entity', array(
                'class' => 'CL\Chill\PersonBundle\Entity\Person',
                'read_only' => TRUE,
                'disabled' => TRUE
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CL\Chill\AppointmentBundle\Entity\Appointment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cl_chill_appointmentbundle_appointment';
    }
}
