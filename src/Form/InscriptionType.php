<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenoms',TextType::class,[
                'label'=>'Prenom',
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>30
                ]),
                'attr'=>['placeholder'=>'Merci de saisir votre prénom'


                ]])
            ->add('nom' ,TextType::class,['label'=>'Nom',
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>20
                ]),
                'attr'=>['placeholder'=>'Merci de saisir votre nom']])
            ->add('email',EmailType::class,['label'=>'Email',
                'attr'=>['placeholder'=>'Merci de saisir votre email']])
            //->add('roles')
             ->add('password', RepeatedType::class, [
             'type' => PasswordType::class,
                'constraints'=>new Length(6),
             'invalid_message' => 'Les mots de passe ne correspondent pas.',
             'label' => 'Mot de passe',
             'required' => true,
             'first_options' => ['label' => 'Mot de passe',
                 'attr'=>['placeholder'=>'Merci de saisir votre mot de passe']
             ],
             'second_options' => ['label' => 'Confirmation du mot de passe'
             ,'attr'=>['placeholder'=>'Merci de confirmer votre mot de passe']],
         ])


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
