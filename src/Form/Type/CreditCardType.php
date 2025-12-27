<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreditCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cardNumber', TextType::class, [
                'label' => 'Card Number :',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '1234 5678 9012 3456',
                    'pattern' => '[0-9\s]{13,19}',
                    'title' => 'Enter a valid credit card number'
                ]
            ])
            ->add('expirationDate', ExpirationDateType::class, [
                'label' => 'Expiration Date :',
            ])
            ->add('cvv', TextType::class, [
                'label' => 'CVV :',
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 4,
                    'minlength' => 3,
                    'pattern' => '[0-9]{3,4}',
                    'placeholder' => '123',
                    'title' => '3 or 4 digit security code'
                ],
                'help' => 'The 3 or 4 digit code on the back of your card'
            ])
            ->add('billingAddress', BillingAddressType::class, [
                'label' => false,
            ])
            ->add('shippingAddress', ShippingAddressType::class, [
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => false,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'credit_card_form',
            'validation_groups' => ['Default', 'payment'],
        ]);
    }
}
