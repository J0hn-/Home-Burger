<?php

namespace HomeBurger\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder->add('quantity', 'integer');
    }

    public function getName()
    {
        return 'cart';
    }
}
