<?php

namespace Workshop\LessonTwoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		// http://symfony.com/doc/current/book/forms.html#built-in-field-types

        $builder
            ->add('title', null, array('label' => 'Titel'))
            // ->add('slug')										wird automatisch gesetzt
            ->add('subtitle', null, array('label' => 'Untertitel', 'required' => false))
            ->add('abstract', 'textarea', array('label' => 'Zusammenfassung'))
            ->add('content', 'textarea', array('label' => 'Inhalt'))
            ->add('author', null, array('label' => 'Autor'))
            ->add('email', 'email', array('label' => 'E-Mail'))
            // ->add('createdAt')									wird automatisch gesetzt!
            // ->add('updatedAt')									dito
            ->add('isOnline', null, array('label' => 'Online?')) // gehört eigentlich in das Admin-Tool
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Workshop\LessonTwoBundle\Entity\BlogPost'
        ));
    }

    public function getName()
    {
        return 'workshop_lessontwobundle_blogposttype';
    }
}
