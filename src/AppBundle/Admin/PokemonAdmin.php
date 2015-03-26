<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PokemonAdmin extends Admin
{
    /**
     * Fields to be shown on create/edit forms
     *
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('hp')
            ->add('level')
            ->add('attack')
            ->add('defense')
            ->add('description')
            ->add('types')
            ->add('trainer')
        ;
    }

    /**
     * Fields to be shown on filter forms
     *
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('level')
            ->add('types')
            ->add('trainer')
        ;
    }

    /**
     * Fields to be shown on lists
     *
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('hp')
            ->add('level')
            ->add('attack')
            ->add('defense')
            ->add('types')
            ->add('trainer')
        ;
    }

    /**
     * Fields to be shown on show action
     *
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('hp')
            ->add('level')
            ->add('attack')
            ->add('defense')
            ->add('description')
            ->add('types')
            ->add('trainer')
        ;
    }
}
