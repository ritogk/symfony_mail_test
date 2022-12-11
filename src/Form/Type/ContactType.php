<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

use App\Form\Model\ContactModel;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('contactContent', TextType::class)
      ->add('image', FileType::class, [
        'required' => false,
        'multiple' => true,
      ])
      ->add('save', SubmitType::class);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => ContactModel::class,
    ]);
  }
}
