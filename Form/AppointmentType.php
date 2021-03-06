<?php

namespace CL\Chill\AppointmentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use CL\Chill\PersonBundle\Form\DataTransformer\PersonToIdTransformer;

class AppointmentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entityManager = $options['em'];
        $transformer = new PersonToIdTransformer($entityManager);

        $builder
            ->add('date', 'date', array('widget' => 'single_text', 'format' => 'dd-MM-yyyy'))
            ->add('durationTime', 'time')
            ->add('reason', 'entity', array(
                'class' => 'CLChillAppointmentBundle:Reason',
                'property' => 'name',
                'group_by'=> 'categoryName',
                'empty_value' => '',
                ))
            ->add('remark', 'textarea', array('required' => false))
            ->add('attendee', 'checkbox', array('required' => false))
            ->add('agent')
            ->add(
                $builder->create('person', 'hidden')
                    ->addModelTransformer($transformer))   
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'CL\Chill\AppointmentBundle\Entity\Appointment'
            ))
            ->setRequired(array(
                'em',
            ))
            ->setAllowedTypes(array(
                'em' => 'Doctrine\Common\Persistence\ObjectManager',
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
