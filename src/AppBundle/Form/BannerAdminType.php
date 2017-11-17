<?php

namespace AppBundle\Form;

use AppBundle\Entity\Oferta;
use AppBundle\Entity\OfertaAuto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BannerAdminType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('imageFile','vich_image',array(
                'required' => true,
                'label' => 'Imagen',
                'required' => $options['image_required'],
                'allow_delete' => false
            ))
            ->add('oferta','entity',array(
                'class' => 'AppBundle\Entity\Oferta',
                'required' => false
            ))
            ->add('tipo')
        ;

        $formModifier = function (FormInterface $form, Oferta $oferta = null ,OfertaAuto $ofertaAuto = null) {
            $ofertaAutos = null === $oferta ? array() : $oferta->getOfertaAutos();

            $form->add('ofertaAuto', 'entity', array(
                'class'       => 'AppBundle:OfertaAuto',
                'choices'     => $ofertaAutos,
                'data' => $ofertaAuto
            ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getOferta(),$data->getOfertaAuto());
            }
        );

        $builder->get('oferta')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $oferta = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $oferta);
            }
        );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Banner',
            'image_required' =>  true,
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
