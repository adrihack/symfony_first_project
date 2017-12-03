<?php

use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Created by PhpStorm.
 * User: adri
 * Date: 20/11/17
 * Time: 13:59
 */

class ProductAdmin extends \Sonata\AdminBundle\Admin\AbstractAdmin {

    protected function configureFormFields(\Sonata\AdminBundle\Form\FormMapper $formMapper)
    {
            $formMapper->add('title', 'description', 'price');
    }
}
