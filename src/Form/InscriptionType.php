<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenoms',TextType::class,['label'=>'Prenom','attr'=>['placeholder'=>'Merci de saisir votre prénom']])
            ->add('nom' ,TextType::class,['label'=>'Nom','attr'=>['placeholder'=>'Merci de saisir votre nom']])
            ->add('email',EmailType::class,['label'=>'Email','attr'=>['placeholder'=>'Merci de saisir votre email']])
            //->add('roles')
            ->add('password',PasswordType::class,['label'=>'Mot de passe','attr'=>['placeholder'=>'Merci de saisir votre mot de passe']])
            ->add('password_confirm',PasswordType::class,[
                'label'=>'Confirmation Mot de passe',
                'mapped'=>false,
                'attr'=>['placeholder'=>'Merci de confirmer votre mot de passe'
                ]])

            ->add('submit',SubmitType::class,['label'=>"S'inscrire"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
