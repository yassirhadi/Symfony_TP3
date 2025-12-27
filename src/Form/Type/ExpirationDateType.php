<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpirationDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $currentYear = (int) date('Y');
        $years = array_combine(
            range($currentYear, $currentYear + 10),
            range($currentYear, $currentYear + 10)
        );
        
        $months = [
            '01 - January' => '01',
            '02 - February' => '02',
            '03 - March' => '03',
            '04 - April' => '04',
            '05 - May' => '05',
            '06 - June' => '06',
            '07 - July' => '07',
            '08 - August' => '08',
            '09 - September' => '09',
            '10 - October' => '10',
            '11 - November' => '11',
            '12 - December' => '12',
        ];

        $builder
            ->add('month', ChoiceType::class, [
                'label' => 'Month',
                'choices' => $months,
                'attr' => [
                    'class' => 'form-control',
                ],
                'placeholder' => 'Select month',
            ])
            ->add('year', ChoiceType::class, [
                'label' => 'Year',
                'choices' => $years,
                'attr' => [
                    'class' => 'form-control',
                ],
                'placeholder' => 'Select year',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => false,
            'error_bubbling' => true,
        ]);
    }
}
