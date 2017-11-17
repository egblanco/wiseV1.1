<?php

namespace AppBundle\Form;

use AppBundle\Entity\Oferta;
use AppBundle\Form\Type\AutoType;
use AppBundle\Form\Type\OfertaAutoType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OfertaAjaxType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();

                $data = $event->getData();

                $form->add('ofertaAuto','entity', array(
                    'class' => 'AppBundle\Entity\OfertaAuto',
                    'attr' => array(
                        'data-widget'=>'select2',
                    ),
                    'property' => 'toStringFull',
                    'query_builder' => function(EntityRepository $er) use ($data){
                        return $er->createQueryBuilder('a')
                            ->join('a.oferta', 'o')
                            ->where('o.id = :id')
                            ->setParameter('id', $data->getId());
                    },
                    'mapped' => false
                    //'choices' => $data->getOfertaAutos()
                ));
            }
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Oferta',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_admin_banner';
    }
}
