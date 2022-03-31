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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;





class SearchAnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {  
        $builder

        ->add('secteur', EntityType::class, [
            'class' => Secteur::class, 'choice_label' => 'nom',])


     
      ->add('recherche' ,SubmitType::class);
    }

}
