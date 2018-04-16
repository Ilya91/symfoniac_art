<?php

namespace BlogBundle\Form;

use BlogBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', ChoiceType::class, array(
                'choices'  => $options['categories'],
                'choice_label' => function($category, $key, $index) {
                    return $category->getName();
                },
                'choice_attr' => function($category, $key, $index) {
                    return ['class' => 'category_'.strtolower($category->getName())];
                },
                'choice_value' => function ($category = null) {
                    return $category ? $category->getId() : '';
                },
            ))
	        ->add('title')
	        ->add('description')
	        ->add('content')
	        ->add('createdAt')
	        ->add('updatedAt');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Post',
            'categories'  => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'blogbundle_post';
    }


}
