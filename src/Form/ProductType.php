<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantity',
                'data' => 1,
                'attr' => [
                    'min' => 1,
                    'max' => 10,
                    'class' => 'form-control',
                    'style' => 'max-width: 100px;'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Range(['min' => 1, 'max' => 10])
                ]
            ])
            ->add('color', ChoiceType::class, [
                'label' => 'Select Color',
                'choices' => [
                    'Matte Black' => 'black',
                    'Pearl White' => 'white',
                    'Silver' => 'silver',
                ],
                'data' => 'black',
                'attr' => [
                    'class' => 'form-select',
                    'style' => 'max-width: 200px;'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Add to Cart',
                'attr' => ['class' => 'btn btn-primary btn-lg']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
