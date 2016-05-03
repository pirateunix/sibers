<?php
/**
 * Created by PhpStorm.
 * User: pirate
 * Date: 02.05.16
 * Time: 10:53
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class)
            ->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'мужской' => "male",
                    'женский' => "female",
                ),
            ))
            ->add('birthday', BirthdayType::class)
            ->add('role', ChoiceType::class, array(
                'choices' => array(
                    'user' => "ROLE_USER",
                    'admin' => "ROLE_ADMIN",
                ),
            ))
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Users',
        ));
    }


}