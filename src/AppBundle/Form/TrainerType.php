<?php

namespace AppBundle\Form;

use AppBundle\Entity\Trainer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TrainerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('birthday', 'birthday')
            ->add('sex', 'choice', [
                'choices' => [
                    Trainer::SEX_MALE   => 'Boy',
                    Trainer::SEX_FEMALE => 'Girl',
                ],
                //'preferred_choices' => [],
                'data' => Trainer::SEX_FEMALE,
            ])
            ->add('picture', null, [
                'required' => false,
            ])
            ->add('description')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Trainer',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_trainer';
    }
}
