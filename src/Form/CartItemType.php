<?php
namespace App\Form;

use App\Entity\CartItem;
use App\Service\ProductRepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CartItemType extends AbstractType
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $product = $this->productRepository->findProductById(1);

        $builder
            ->add('quantity', NumberType::class, [
                'label' => 'Quantity',
                'html5' => true,
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'max-width: 100px;',
                    'min' => 1,
                    'max' => 10,
                ],
                'help' => 'Between 1 and 10 units',
            ])
            ->add('color', ChoiceType::class, [
                'label' => 'Select Color',
                'choices' => $this->getColorChoices(),
                'attr' => [
                    'class' => 'form-select',
                    'style' => 'max-width: 200px;',
                ],
            ])
            ->add('productId', HiddenType::class, [
                'data' => 1,
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Add to Cart',
                'attr' => [
                    'class' => 'btn btn-primary btn-lg',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CartItem::class,
            'action' => '/appareil/add-to-cart',
            'method' => 'POST',
            'attr' => [
                'class' => 'needs-validation',
                'novalidate' => true,
                'id' => 'cart-item-form',
            ],
        ]);
    }

    private function getColorChoices(): array
    {
        return [
            'Matte Black' => 'black',
            'Pearl White' => 'white',
            'Silver' => 'silver',
        ];
    }
}
