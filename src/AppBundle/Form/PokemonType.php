<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PokemonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('hp')
            ->add('level')
            ->add('attack')
            ->add('defense')
            ->add('description')
            ->add('types', null, [
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('trainer')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pokemon',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_pokemon';
    }
}
