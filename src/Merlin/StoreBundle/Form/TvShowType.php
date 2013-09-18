<?php

namespace Merlin\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TvShowType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'hidden')
            ->add('title')
            ->add('season')
            ->add('episode')
            ->setErrorBubbling(true)
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Merlin\StoreBundle\Entity\TvShow'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'merlin_storebundle_tvshow';
    }
}
