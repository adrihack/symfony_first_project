<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Created by PhpStorm.
 * User: adri
 * Date: 20/11/17
 * Time: 13:59
 */

class ProductAdmin extends AbstractAdmin {
    protected function ConfigureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', 'text');
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
    }
}