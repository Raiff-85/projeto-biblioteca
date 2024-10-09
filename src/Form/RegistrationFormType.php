<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use function Sodium\add;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('email')
            ->add('cpf',
                TextType::class,
            [
                'label' => 'CPF',
                'constraints' => [
                    new NotBlank([
                        'message' => 'O CPF não pode estar em branco.',
                    ]),
                    new Length([
                        'min' => 11,
                        'max' => 11,
                        'exactMessage' => 'O CPF deve ter exatamente {{ limit }} dígitos.',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]+$/',
                        'message' => 'O CPF deve conter apenas números.',
                    ]),
                ],
                'attr' => [
                    'maxlength' => 11,
                    'placeholder' => 'Somente números, ex: 12345678901',
                ]
            ])
            ->add('telefone', TextType::class, [])
            ->add('tipo', ChoiceType::class, [
                'choices' => [
                    'Bibliotecário' => 1, // int
                    'Cliente' => 2, // int
                ],
                'choice_value' => function ($choice) {
                    // Isso permite armazenar o valor do choice corretamente como string ou integer
                    return (string) $choice;
                },
                'label' => 'Tipo de Usuário',
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Termos de uso',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Você deve aceitar nossos termos.',
                    ]),
                ],
            ])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, insira uma senha',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Sua senha deve ter, no mínimo, {{ limit }} caracteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 8,
                    ]),
                ],
            ])
            ->add('confirmePassword', PasswordType::class, [
                'mapped' => false,
                'label' => 'Confirme sua senha',
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [new NotBlank([
                    'message' => 'Por favor, insira novamente sua senha',
                ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Sua senha deve ter, no mínimo, {{ limit }} caracteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 8,
                    ]),]
            ])
            ->add('Enviar', SubmitType::class, [])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
