<?php

namespace App\Form;

use App\Entity\Secteur;
use App\Entity\Annonces;
use App\Entity\Cryptomonaie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options  )
    {
     $builder
     ->add('titre', TextType::class)
     ->add('secteur', EntityType::class, [
        'class' => Secteur::class, 'choice_label' => 'nom',])
        ->add('crypto', EntityType::class, [
            'class' => Cryptomonaie::class, 'choice_label' => 'nom',])
     ->add('contenu', TextareaType::class)
     ->add('image', TextType::class,['label' => 'Ajouter une image']);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
