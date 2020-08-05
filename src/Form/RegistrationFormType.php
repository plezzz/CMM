<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,['attr' => ['class' => 'textColor']])
            ->add('email', EmailType::class,['attr' => ['class' => 'textColor']])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('firstName', TextType::class,['attr' => ['class' => 'textColor']])
            ->add('lastName', TextType::class,['attr' => ['class' => 'textColor']])
            ->add('cmAppToken', TextType::class,['attr' => ['class' => 'textColor']])
            ->add('cmAppSecret', TextType::class,['attr' => ['class' => 'textColor']])
            ->add('cmAccessToken', TextType::class,['attr' => ['class' => 'textColor']])
            ->add('cmAccessSecret', TextType::class,['attr' => ['class' => 'textColor']])
            ->add('password', RepeatedType::class, [
                'attr' => ['class' => 'textColor'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                "type" => PasswordType::class,
                "first_options" => ["label" => 'Password'],
                'second_options' => ["label" => 'Repeat Password']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
