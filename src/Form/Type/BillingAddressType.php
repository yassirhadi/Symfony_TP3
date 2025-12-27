<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BillingAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'First Name',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'John',
                ],
                'row_attr' => [
                    'class' => 'form-group',
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Doe',
                ],
                'row_attr' => [
                    'class' => 'form-group',
                ],
            ])
            ->add('country', CountryType::class, [
                'label' => 'Country',
                'attr' => [
                    'class' => 'form-control',
                ],
                'placeholder' => 'Select a country',
                'preferred_choices' => ['US', 'FR', 'DE', 'GB', 'CA'],
                'row_attr' => [
                    'class' => 'form-group',
                ],
            ])
            ->add('addressLine1', TextType::class, [
                'label' => 'Address Line 1',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '123 Main St',
                ],
                'help' => 'If your billing address is a PO Box, please enter the number first. Example: PO Box 123 would be entered as 123 PO Box.',
                'row_attr' => [
                    'class' => 'form-group',
                ],
            ])
            ->add('addressLine2', TextType::class, [
                'label' => 'Address Line 2',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Apt 4B',
                ],
                'row_attr' => [
                    'class' => 'form-group',
                ],
            ])
            ->add('city', TextType::class, [
                'label' => 'City',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'New York',
                ],
                'row_attr' => [
                    'class' => 'form-group',
                ],
            ])
            ->add('state', TextType::class, [
                'label' => 'State/Province',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'NY',
                ],
                'row_attr' => [
                    'class' => 'form-group',
                ],
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'ZIP/Postal Code',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '10001',
                ],
                'row_attr' => [
                    'class' => 'form-group',
                ],
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Phone Number',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '+1 (555) 123-4567',
                ],
                'row_attr' => [
                    'class' => 'form-group',
                ],
            ])
            ->add('emailAddress', EmailType::class, [
                'label' => 'Email Address',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'john.doe@example.com',
                ],
                'row_attr' => [
                    'class' => 'form-group',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => false,
            'data_class' => null,
        ]);
    }
}
