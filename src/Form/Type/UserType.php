<?php

namespace HomeBurger\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder->add('mail', 'email')
              ->add('lastname', 'text')
              ->add('firstname', 'text')
              ->add('address', 'text')
              ->add('postalcode', 'integer')
              ->add('town', 'text')
              ->add('password', 'password');
      
    }

    public function getName()
    {
        return 'user';
    }
}
