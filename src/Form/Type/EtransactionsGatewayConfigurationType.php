<?php

/**
 * This file was created by the developers from Waaz.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 */

namespace Waaz\U2PayEtransactionsPlugin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


final class EtransactionsGatewayConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sandbox', CheckboxType::class, [
                'label' => 'waaz.etransactions.sandbox'
            ])
            ->add('hmac', TextType::class, [
                'label' => 'waaz.etransactions.hmac',
                'constraints' => [
                    new NotBlank([
                        'message' => 'waaz.etransactions.hmac.not_blank',
                        'groups' => ['sylius']
                    ])
                ],
            ])
            ->add('identifiant', TextType::class, [
                'label' => 'waaz.etransactions.identifiant',
                'constraints' => [
                    new NotBlank([
                        'message' => 'waaz.etransactions.identifiant.not_blank',
                        'groups' => ['sylius']
                    ])
                ],
            ])
            ->add('site', TextType::class, [
                'label' => 'waaz.etransactions.site',
                'constraints' => [
                    new NotBlank([
                        'message' => 'waaz.etransactions.site.not_blank',
                        'groups' => ['sylius']
                    ])
                ],
            ])
            ->add('rang', TextType::class, [
                'label' => 'waaz.etransactions.rang',
                'constraints' => [
                    new NotBlank([
                        'message' => 'waaz.etransactions.rang.not_blank',
                        'groups' => ['sylius']
                    ])
                ],
            ])
        ;
    }
}
