<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email',null,[
            'attr' =>[
                'style'=>'border:2px solid black;'
            ]
        
        ])
        // ->add('agreeTerms', CheckboxType::class, [
        //     'mapped' => false,
        //     'constraints' => [
        //         new IsTrue([
        //             'message' => 'You should agree to our terms.',
        //         ]),
        //     ],
        // ])
        ->add('plainPassword', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'label'=>'Mot de passe',
            'attr' => [
                'autocomplete' => 'new-password',
                'style'=>'border:2px solid black;'

            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Entrez un Mot de passe',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'votre mot de passe doit contenir au moins {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ])
        ->add('roles', ChoiceType::class,[
            'choices' => [
                'enseignant' => 'ROLE_ENSEIGNANT',
                'parent' => 'ROLE_PARENT',
                'administrateur' => 'ROLE_ADMIN'
            ],
            'expanded'=>true,
            'multiple'=>true,
            'label' => 'Roles'
            
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
