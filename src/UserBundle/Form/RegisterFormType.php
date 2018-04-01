<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;

class RegisterFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('username', TextType::class)
			->add('email', EmailType::class, array(
				'label' => 'Email Address',
				'attr'    => array('class' => 'C-3PO')
			))
			->add('plainPassword', RepeatedType::class, array(
				'type' => PasswordType::class,
			));
	}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => ['Default', 'Registration']
        ]);
    }

	public function getName()
	{
		return 'user_register';
	}
}